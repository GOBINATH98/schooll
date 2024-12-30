<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <!-- Include SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>
<body>
    
    
  
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 1500,
        });
    </script>
@endif
<style>
    @import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap");


#bubb {
	font-family: "Bebas Neue", Arial Helvetica, serif;
	font-size: 8vmin;
	-webkit-text-stroke: 0pxrgba(130, 99, 99, 0.31);
	-webkit-text-fill-color: #ffffff1c;
	text-shadow: -3px -3px 3pxrgba(201, 178, 178, 0.25);
	background-repeat: repeat;
	background-position: center center;
	background-size: contain;
	-webkit-text-fill-color:rgba(128, 160, 174, 0.18);
	-webkit-background-clip: text;
	letter-spacing: 1px;
	display: inline-flex;
	width: 100vw;
	height: 20vh;
	text-align: center;
	align-items: center;
	justify-content: center;
	font-weight: bold;
}



.bubbles {
	width: 100vw;
	height: 24vh;
	background-image: url(https://c.tenor.com/OPMJAHXKIU0AAAAd/looking-water.gif);
	-webkit-text-fill-color:rgba(169, 119, 178, 0.15);
	text-shadow: -3px -3px 10pxrgba(140, 105, 147, 0.19), 3px 3px 10px #0000004f;
}



</style>
<body>
    

<div class="bubbles" id="bubb">welcome to glory school</div>
    <div id="kc-container-wrapper">
   
       
        <h2 class="text-center " >School mangement Admin</h2>
        <form action="{{ route('login') }}" method="POST" id="login-form">
            @csrf
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="email">Username or Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
        

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input type="hidden" name="role" value="0">
            <div>
            <button type="submit">Log in</button>
            </div>
           
            <div>
                <p><a href="{{route('show.login')}}">student</a>
                </div></p>
        

            <div class="text-center">
                <p>Not registered? <a href="{{ route('register') }}">Register now</a></p>
            </div>
           
                
        </form>
    </div>
    <style>
     html, body {
    height: 100%;
    margin: 0;
    font-family: 'Roboto Condensed', sans-serif;
    background: url('{{ asset('storage/students/school-classroom-blur-background_744112-703.avif') }}') no-repeat center center/cover;
}

        #kc-container-wrapper {
            position: fixed;
            width: 365px;
            height: 379px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(180deg, rgba(80, 18, 83, 0.6) 0%, rgba(175, 160, 189, 0.8) 100%);
            border-radius: 10px;
            box-shadow: 0 4px 15px 2px rgba(18, 2, 23, 0.5);
            padding: 60px;
            color: white;
        }

        label {
            font-size: 14px;
        }

        input.form-control {
            width: 100%;
            height: 42px;
            margin: 10px 0;
            border: 1px solid #fe7d68;
            border-radius: 20px;
            background: rgba(54, 25, 81, 0.61);
            padding: 0 10px;
            color: #fbcf0a;
        }

        button {
            background: linear-gradient(180deg, #f9d502 0%, #f92391 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 10px;
        }

        .forgotpwd a {
            color: white;
            text-decoration: none;
        }

        .text-center a {
            color: #f92391;
        }

        @media (max-width: 767px) {
            #kc-container-wrapper {
                width: 320px;
            }

            input.form-control {
                height: 36px;
                font-size: 14px;
            }

            button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
    <script>
       
        $(document).ready(function() {
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please provide your password.",
                        minlength: "Password must be at least 6 characters long."
                    }
                },
                submitHandler: function(form) {
                    form.submit(); 
                }
            });
        });
    </script>
</body>
</html>
