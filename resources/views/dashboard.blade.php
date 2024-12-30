<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- SweetAlert2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    
</script>


   
</head>
<body style="background-image:url('{{ asset('storage/students/glass.avif') }}');">

    
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="color: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(244,214,37,1) 1%, rgba(180,213,94,1) 70%, rgba(0,212,255,0.9816296147365196) 92%);;">
        <div class="container-fluid" >
          
            <a class="navbar-brand" href="/dashboard">School admin </a>
            
      
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

   
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                 title: 'Success',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    timer: 2000,
                });
            </script>
        @endif
    </div>
 

<div class="container mt-5">    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentFormModal">
        Add Student
    </button>

  
    <div class="modal fade" id="studentFormModal" tabindex="-1" aria-labelledby="studentFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentFormModalLabel">Add Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('insert')}}" method="POST"  id="formval" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                              
                                <div class="mb-3">
                                    <label for="name" class="form-label">Student Name</label>
                                    <input type="text" id="name" name="name" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="std" class="form-label">Standard</label>
                                    <select id="std" name="std" class="form-select" >
                                    <option value=" ">Select your section</option>
                                        <option value="1">1st Standard</option>
                                        <option value="2">2nd Standard</option>
                                        <option value="3">3rd Standard</option>
                                        <option value="4">4th Standard</option>
                <option value="5">5th Standard</option>
                <option value="6">6th Standard</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="section" class="form-label">Section</label>
                                    <select id="section" name="section" class="form-select" >
                                        <option value=" ">Select your section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-select" >
                                    <option value=" ">Select your gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Parent's Email(Family or gaurdian or warden)</label>
                                    <input type="email" id="email" name="email" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Student Image(optional)</label>
                                    <input type="file" id="image" name="image" accept="image/*" class="form-control" >
                                        @if ($errors->has('image'))
       <span class="alert alert-danger">
          {{ $errors->first('image') }}
       </span>
    @endif
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="eng" class="form-label">English Marks/100</label>
                                    <input type="number" id="eng" name="eng" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="tam" class="form-label">Tamil Marks/100</label>
                                    <input type="number" id="tam" name="tam" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="mat" class="form-label">Maths Marks/100</label>
                                    <input type="number" id="mat" name="mat" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="sci" class="form-label">Science Marks/100</label>
                                    <input type="number" id="sci" name="sci" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="soc" class="form-label">Social Marks/100</label>
                                    <input type="number" id="soc" name="soc" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-3">
    <form id="filter-form" style="display: flex; flex-wrap: wrap; gap: 10px;">
  
        <div class="d-flex flex-column">
            <label for="std" class="form-label text-white">Filter by Standard:</label>
            <select name="std" id="filter-std" class="form-select" style="width: 200px;">
                <option value=" ">All Standard</option>
                <option value="1">1st Standard</option>
                <option value="2">2nd Standard</option>
                <option value="3">3rd Standard</option>
                <option value="4">4th Standard</option>
                <option value="5">5th Standard</option>
                <option value="6">6th Standard</option>
            </select>
        </div>

        <div class="d-flex flex-column">
            <label for="section" class="form-label text-light">Filter by Section:</label>
            <select name="section" id="filter-section" class="form-select" style="width: 200px;">
                <option value=" ">All Sections</option>
                <option value="A">A Section</option>
                <option value="B">B Section</option>
                <option value="C">C Section</option>
            </select>
        </div>

      
        <div class="d-flex flex-column">
            <label for="gender" class="form-label text-light">Filter by Gender:</label>
            <select name="gender" id="filter-gender" class="form-select" style="width: 200px;">
                <option value="">All Genders</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

   
        <div class="d-flex align-items-end mt-3">
            <button type="button" id="filter-button" class="btn btn-primary">Apply Filter</button>
            <button type="button" class="btn btn-secondary ms-2" onclick="location.reload()">Reset</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {

        if ($("#formval").length) {
            $("#formval").validate({
                rules: {    
                    name: { required: true },
                    std: { required: true, notEqualTo: " " },
                    section: { required: true, notEqualTo: " " },
                    gender: { required: true, notEqualTo: " " },
                    email: { required: true, email: true },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        image: true
                    },
                    eng: { required: true, digits: true, min: 0, max: 100 },
                    tam: { required: true, digits: true, min: 0, max: 100 },
                    mat: { required: true, digits: true, min: 0, max: 100 },
                    sci: { required: true, digits: true, min: 0, max: 100 },
                    soc: { required: true, digits: true, min: 0, max: 100 }
                },
                messages: {
                    name: "Please enter the student's name",
                    std: "Please select the student's standard",
                    section: "Please select the student's section",
                    gender: "Please select the student's gender",
                    email: "Please enter a valid email address",
                    image: {
                        required: "Please upload an image.",
                        extension: "Only JPG, JPEG, PNG, and GIF files are allowed."
                    },
                    eng: "Please enter valid English marks (between 0 and 100)",
                    tam: "Please enter valid Tamil marks (between 0 and 100)",
                    mat: "Please enter valid Maths marks (between 0 and 100)",
                    sci: "Please enter valid Science marks (between 0 and 100)",
                    soc: "Please enter valid Social marks (between 0 and 100)"
                },
                errorClass: 'text-danger',
                submitHandler: function (form) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Form has been successfully submitted.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        } else {
            console.error("Form with ID 'formval' not found.");
        }
    });


    $.validator.addMethod("notEqualTo", function (value, element, param) {
        return value !== param;
    }, "Please select a valid option.");
</script>


@if(session('message'))
    <h3>{{ session('message') }}</h3>
@endif



<div class="container-fluid mt-3">
  
    <table id="students-table" class="display table table-bordered table-striped">
        <thead>
            <tr>
                <!-- <th>id</th> -->
                <th>Name</th>
                <th>Image</th>
                <th>Standard</th>
                <th>Section</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="exportPdf">Export as PDF</button>
            @if(session('message'))
    <h3>{{ session('message') }}</h3>
@endif

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
   


<script>
    $(document).ready(function() {
        const table = $('#students-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip', 
            buttons: [
                 'excel','pdf',
            ],
            ajax: {
                url: '{{ route('dashboard') }}',  
                data: function(d) {
                    d.section = $('#filter-section').val();  
                    d.gender = $('#filter-gender').val();    
                    d.std = $('#filter-std').val(); 
                    console.log(d.std);
                    console.log(d.gender);
                    
                  
                }
                
            },
            columns: [
                // { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'image', name: 'image', },
                { data: 'std', name: 'std' ,
                render: function(data, type, row) {
               
                if (data == 1) {
                    return '1st Standard';
                } else if (data == 2) {
                    return '2nd Standard';
                } else if (data == 3) {
                    return '3rd Standard';
                } else {
                    return data + 'th Standard';  
                }
            }   },
                { data: 'section', name: 'section' },
                { data: 'gender', name: 'gender' },
                { 
                    data: 'id', 
                    name: 'id', 
                    orderable: false, 
                    searchable: true,
                    render: function(data, type, row) {
                        return `<button class="btn btn-info view-btn" data-id="${data}">View Result</button>`;
                        console.log(data);
                    }
                }
            ]
        });



            $('#students-table').on('click', '.view-btn', function() {
                var studentId = $(this).data('id');
                console.log(studentId);
             
                $.ajax({
                    url: '{{ url("students") }}/' + studentId,
                    
                    method: 'GET',
              
                    success: function(data) {
                    
                        let marksTable = `
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Marks</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>English</td>
                                        <td>${data.marks.eng}</td>
                                        <td class="${data.marks.eng < 50 ? 'text-danger' : 'text-success'}">${data.marks.eng < 50 ? 'Fail' : 'Pass'}</td>
                                    </tr>
                                    <tr>
                                        <td>Tamil</td>
                                        <td>${data.marks.tam}</td>
                                        <td class="${data.marks.tam < 50 ? 'text-danger' : 'text-success'}">${data.marks.tam < 50 ? 'Fail' : 'Pass'}</td>
                                    </tr>
                                    <tr>
                                        <td>Maths</td>
                                        <td>${data.marks.mat}</td>
                                        <td class="${data.marks.mat < 50 ? 'text-danger' : 'text-success'}">${data.marks.mat < 50 ? 'Fail' : 'Pass'}</td>
                                    </tr>
                                    <tr>
                                        <td>Science</td>
                                        <td>${data.marks.sci}</td>
                                        <td class="${data.marks.sci < 50 ? 'text-danger' : 'text-success'}">${data.marks.sci < 50 ? 'Fail' : 'Pass'}</td>
                                    </tr>
                                    <tr>
                                        <td>Social</td>
                                        <td>${data.marks.soc}</td>
                                        <td class="${data.marks.soc < 50 ? 'text-danger' : 'text-success'}">${data.marks.soc < 50 ? 'Fail' : 'Pass'}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>${data.totalMarks}/500</strong></td>
                       <td class="${data.marks.status == 'pass' ? 'text-success' : 'text-danger'}">
    <strong>${data.marks.status == 'pass' ? 'Pass' : 'Fail'}</strong>
</td>

                                    </tr>
                                </tbody>
                            </table>
                        `;

                        $('#viewModal .modal-body').html(`
                        <div style=" display:flex;justify-content: space-evenly;align-items: center">  <h3 style="color:green"><span style="color:black">Name:</span> ${data.student.name}</h3> <img id="studentImage" alt="Student Image" style="width:100px; height:80px;"> </div>
       
        <p>Standard: ${data.student.std} standard</p>
        <p>Section: ${data.student.section}</p>
        <p>Gender: ${data.student.gender}</p>
      




     

        
        
        <p><strong>Marks:</strong></p>
        ${marksTable}
        <a href="/send-email/${data.student.id}" class="btn btn-primary">Send Email ->${data.student.parent_email} </a>
    `);

    document.getElementById('studentImage').src = '/storage/' + data.student.image;

    $('#exportPdf').on('click', function() {
                const { jsPDF } = window.jspdf;
                const modalContent = document.querySelector('#viewModal .modal-body');

                html2canvas(modalContent).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF();

                   
                    const imgWidth = 190; 
                    const imgHeight = (canvas.height * imgWidth) / canvas.width;

                    pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                    pdf.save('student-details.pdf');
                });
            });
                    
                        $('#viewModal').modal('show');
                    },
                error: function() {
                    alert('Error fetching student details');
                }
            });
        });

        $('#filter-button').click(function() {
            table.draw();
        });
    });
</script>
@if(session('message'))
    <h3>{{ session('message') }}</h3>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
