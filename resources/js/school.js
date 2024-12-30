
    $(document).ready(function () {

        if ($("#formin").length) {
            $("#formin").validate({
                rules: {
                    name: { required: true },
                    std: { required: true,notEqualTo: " " },
                    section: { required: true,notEqualTo: " "},
                    gender: { required: true,notEqualTo: " " },
                    email: { required: true, email: true },
                    image: {
            required: true,
            extension: "jpg|jpeg|png|gif",image:true
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
                    image:"please select your image",
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
            console.error("Form with ID 'formin' not found.");
        }
    });
    $.validator.addMethod("notEqualTo", function (value, element, param) {
            return value !== param;
        }, "Please select a valid option.");

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
