<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
      body {
            background-image: url('img/register/login-background.jpg'); /* Specify the path to your image */
            background-size: cover; /* Cover the entire background */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-position: center center; /* Center the image */
            font-family: Arial, sans-serif; /* Specify the font family */
            color: #ffffff; /* Text color */
        }
       
        .modal-body {
            padding: 40px;
        }
        .login-logo {
            margin-bottom: 30px;
            .login-logo img {
                width: 50px; /* Set the width as needed */
                height: auto; /* Let the height adjust automatically to maintain aspect ratio */
            }
        }
        .login-heading {
            margin-bottom: 20px;
        }
        .login-form {
            margin-bottom: 30px;
        }
        .forgot-password-link,
        .create-account-link {
            margin-top: 10px;
        }

        .primary-button {
            background-color: #C74B3B; /* Primary color */
            color: #fff; /* Text color */
            padding: 10px 20px; /* Adjust padding as needed */
            border: none;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
            font-size: 16px; /* Adjust font size as needed */
            width: 410px;
        }

        /* Custom styling for alternative buttons */
        .custom-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 410px;
        }
        .clickable-heading {
            color: white;
         
            padding: 10px 20px;
          
            cursor: pointer;
            font-size: 20px;
            width: 200px;
            text-align: center;
            display: inline-block;
            margin-bottom: 10px; /* Adjust margin as needed */
            text-decoration: none; /* Remove underline */
        }

    </style>
</head>
<body>






















        





    <div>
        
    <img src="{{ asset('img/register/new-logo-black.png') }}" class="img-fluid" alt="Logo" style="width: 480px; height: auto; padding-left:20px; padding-top: 5px;">
    
    <img src="{{ asset('img/register/Logo_of_Bukidnon_State_University.png') }}" class="img-fluid" alt="Logo" style="width: 105px; height: auto; padding-left:20px; padding-top: 5px;">
    


    <h1 class="clickable-heading">
       About Us
    </h1>
    <h1 class="clickable-heading" >
        Contact Us
    </h1>
    <h1 class="clickable-heading" id="loginButton">
        Log in
    </h1>
    <h1 class="clickable-heading" id="registerButton">
        Register
    </h1>
</div>




<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center login-logo">
                    <img src="{{ asset('img/register/logo.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="text-center login-heading">
                    <h1 class="h4 text-gray-900"><b>City Disaster Risk Reduction Management Office</b></h1>
                </div>
               
        <form class="user login-form" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"  class="block mt-1 w-full form-control form-control-user"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            class="block mt-1 w-full form-control form-control-user"  />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

           
        </div>
        <button class="primary-button">
    {{ __('Log in') }}
</button>

    </form>


            </div>
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center login-logo">
                    <img src="{{ asset('img/register/logo.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="text-center login-heading">
                    <h1 class="h4 text-gray-900"><b>City Disaster Risk Reduction Management Office</b></h1>
                </div>
               
        <form method="POST" action="{{ route('register') }}" >
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input class="block mt-1 w-full block mt-1 w-full form-control form-control-user" id="name"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="block mt-1 w-full form-control mt-1 w-full form-control form-control-user" id="email"  type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full block mt-1 w-full form-control form-control-user"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                          />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class=" form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full block mt-1 w-full form-control form-control-user"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <button class="primary-button">
    {{ __('Register') }}
</button>
    </form>
   
              
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $("#loginButton").click(function(){
            $("#loginModal").modal('show');
        });

        $("#registerButton").click(function(){
            $("#registerModal").modal('show');
        });
    });
</script>

</body>
</html>
