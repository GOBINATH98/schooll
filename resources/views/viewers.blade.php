<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  
                    <li class="nav-item">
                        <form action="{{ route('logout1') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="d-flex flex-column align-items-start p-3">
                    <h4 class="mb-4">Menu</h4>
                    <a href="#" class="btn btn-link">Dashboard</a>
                    <a href="#" class="btn btn-link">Student List</a>
                    <a href="#" class="btn btn-link">Settings</a>
                </div>
            </div>

     
            <div class="col-md-9 col-lg-10 p-4">
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        text: 'You have successfully logged in.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>

                <div class="container mt-5">
                    <h1 class="mb-4">Search Student Details</h1>

                  
                    <div class="mb-4">
                        <label for="search-id" class="form-label">Enter  Student Roll number:</label>
                        <input type="text" id="search-id" class="form-control w-50" placeholder="Enter your roll number">
                        <button id="search-btn" class="btn btn-primary mt-3">Search</button>
                    </div>

                   
                    <div id="record-details" style="margin-top: 20px; display: none;">
                        <h3>Record Details</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td id="record-id"></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td id="record-name"></td>
                                </tr>
                                <tr>
                                    <td>Social</td>
                                    <td id="record-marks-soc"></td>
                                </tr>
                                <tr>
                                    <td>English</td>
                                    <td id="record-marks-eng"></td>
                                </tr>
                                <tr>
                                    <td>Tamil</td>
                                    <td id="record-marks-tam"></td>
                                </tr>
                                <tr>
                                    <td>Math</td>
                                    <td id="record-marks-mat"></td>
                                </tr>
                                <tr>
                                    <td>Science</td>
                                    <td id="record-marks-sci"></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td id="record-marks-total"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td id="record-marks-status"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-btn').on('click', function () {
                const id = $('#search-id').val();

                if (!id) {
                    alert('Please enter a Sudent Roll number.');
                    return;
                }

                $.ajax({
                    url: '{{ url("/viewers") }}/' + id,
                    method: 'GET',
                    success: function (response) {
                        if (response.record) {
                            $('#record-id').text(response.record.id);
                            $('#record-name').text(response.record.name);
                            $('#record-email').text(response.record.email);
                            $('#record-marks-eng').text(response.record.marks.eng);
                            $('#record-marks-tam').text(response.record.marks.tam);
                            $('#record-marks-mat').text(response.record.marks.mat);
                            $('#record-marks-sci').text(response.record.marks.sci);
                            $('#record-marks-soc').text(response.record.marks.soc);
                            $('#record-marks-total').text(response.record.marks.total);
                            $('#record-marks-status').text(response.record.marks.status);
                            $('#record-details').show();
                        }
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON.error || 'Record not found.');
                        $('#record-details').hide();
                    }
                });
            });
        });
    </script>
</body>

</html>
