<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stud;
use App\Models\Mark;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use function Laravel\Prompts\table;

class StudentController extends Controller
{
  
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Stud::query();
    
            if ($request->has('section') && $request->section) {
                $query->where('section', $request->section);
            }    
            if ($request->has('gender') && $request->gender) {
                $query->where('gender', $request->gender);
            }
            if ($request->has('std') && $request->std) {
                $query->where('std', $request->std);
            }
            $query->orderBy('created_at', 'desc');
            return Datatables()->of($query)
                ->addColumn('image', function($student) {
                    return '<img src="' . asset('storage/' . $student->image) . '" style="width:70px; height:80px;">';
                })
                
                ->rawColumns(['image'])
                ->make(true);
        }
    
        return view('dashboard'); 
    }


      
    

    public function home()
    {
        echo('school page');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'std' => 'required|integer',
        'section' => 'required|string|max:100',
        'gender' => 'required|in:male,female',
        'image' => 'nullable',
    ]);
    // dd($request->all());   

    if (!$request->hasFile('image')) {
        return back()->withErrors(['image' => 'No file uploaded!']);
    }

    $imagePath = $request->file('image')->store('students', 'public');

    $student = Stud::create([
        'name' => $request->name,
        'std' => $request->std,
        'section' => $request->section,
        'gender' => $request->gender,
        'parent_email' => $request->email,
        'image' => $imagePath,
    ]);

    $status = 'pass';
    if ($request->eng < 50 || $request->tam < 50 || $request->mat < 50 || $request->sci < 50 || $request->soc < 50) {
        $status = 'fail';
    }

    Mark::create([
        'stud_id' => $student->id,
        'eng' => $request->eng,
        'tam' => $request->tam,
        'mat' => $request->mat,
        'sci' => $request->sci,
        'soc' => $request->soc,
        'total' => $request->eng + $request->tam + $request->mat + $request->sci + $request->soc,
        'status' => $status,
    ]);

    return redirect()->back()->with('success', 'Student and marks added successfully!');
}


    public function sendEmail($id)
    {
        $student = Stud::findOrFail($id);
        // dd($student);
        $email = $student->parent_email;
        $marks = Mark::where('stud_id', $id)->get();
        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '1906nath@gmail.com';
            $mail->Password   = 'tjha pott yndk otzy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom('1906nath@gmail.com', 'School Admin');
            $mail->addAddress($email, 'Parent');
            $mail->isHTML(true);
            $mail->Subject = 'Student Academic Report';
    
          
            $mail->Body = "
            <h1>Student Details</h1>
            <p><strong>Name:</strong> {$student->name}</p>
            <p><strong>Standard:</strong> {$student->std}</p>
            <p><strong>Section:</strong> {$student->section}</p>
            <p><strong>Gender:</strong> {$student->gender}</p>
            <h2>Marks:</h2>
            <table border='1' style='border-collapse: collapse; width: 100%;'>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>";
        
        foreach ($marks as $mark) {
            $mail->Body .= "
                <tr>
                    <td>English</td>
                    <td>{$mark->eng}</td>
                    <td>" . ($mark->eng > 50 ? "pass" : "fail") . "</td>
                </tr>
                <tr>
                    <td>Tamil</td>
                    <td>{$mark->tam}</td>
                    <td>" . ($mark->tam > 50 ? "pass" : "fail") . "</td>
                </tr>
                <tr>
                    <td>Math</td>
                    <td>{$mark->mat}</td>
                    <td>" . ($mark->mat > 50 ? "pass" : "fail") . "</td>
                </tr>
                <tr>
                    <td>Science</td>
                    <td>{$mark->sci}</td>
                    <td>" . ($mark->sci > 50 ? "pass" : "fail") . "</td>
                </tr>
                <tr>
                    <td>Social</td>
                    <td>{$mark->soc}</td>
                    <td>" . ($mark->soc > 50 ? "pass" : "fail") . "</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{$mark->total}</td>
                    <td>{$mark->status}</td>
                </tr>";
        }
        
        $mail->Body .= "
                </tbody>
            </table>";
        
            $mail->send();
    
            return redirect()->route('dashboard')->with('success', 'Email sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
        }
    }
    


    public function show($id)
    {
        
        $student = Stud::findOrFail($id);
        $marks = Mark::where('stud_id', $id)->first();
        $totalMarks = $marks->eng + $marks->tam + $marks->mat + $marks->sci + $marks->soc;
        return response()->json([
            'student' => $student,
            'marks' => $marks,
            'totalMarks' => $totalMarks
        ]);
    }


   
  

 
    public function destroy(string $id)
    {
     
    }
}
