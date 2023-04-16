<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- TAILWINDCSS -->
    @vite('resources/css/app.css')
    <!-- Inline CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla {
            font-family: karla;
        }
        .error{
            padding-left: 5px;
            color: red;
        }
    </style>
</head>
<body class="">
    <div class="w-screen h-screen bg-slate-50">
        <!-- Register Section -->
        <div class="w-full h-full flex justify-center items-center py-10 overflow-auto">
            <div class="flex flex-col bg-slate-200 rounded-xl justify-center md:justify-start my-auto pt-8 md:pt-0 shadow-xl w-register-box">
                <!-- <span class="left-10 m-5"><i class="bi bi-x-lg cursor-pointer"></i></span> -->
                <p class="text-center text-green-800 text-4xl mt-10">Join Us.</p>
                <form id="register_form" class="flex flex-col p-10 md:pt-8" action="{{ route('register') }}" method="POST">@csrf
                    @if ($errors->any())
                    <div class="flex flex-col pt-4 border-2 border-red-600 text-red-600 p-2 md:hiden lg:hidden xl:hidden">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="py-2 px-3 text-lg">{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif
                    
                    <div class="flex flex-col w-full">
                        <label for="id_number" class="text-base text-zinc-800 px-1">ID number</label>
                        <input type="text" id="id_number" name="id_number" placeholder="your school ID number" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50"/>
                    </div>
                    
                    <div class="flex flex-col pt-4 w-full">
                        <label for="first_name" class="text-base text-zinc-800 px-1">First name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="your first name" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50"/>
                    </div>

                    <div class="flex flex-col pt-4 w-full">
                        <label for="middle_name" class="text-base text-zinc-800 px-1">Middle initial</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="your middle name" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>

                    <div class="flex flex-col pt-4 w-full">
                        <label for="last_name" class="text-base text-zinc-800 px-1">Last name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="your last name" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>

                    <div class="flex flex-col pt-4 w-full">
                        <label for="username" class="text-base text-zinc-800 px-1">Username</label>
                        <input type="text" id="username" placeholder="your username" name="username" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>

                    <div class="flex flex-col pt-4 w-full">
                        <label for="email" class="text-base text-zinc-800 px-1">Email</label>
                        <input type="email" id="email" placeholder="your@email.com" name="email" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>
    
                    <div class="flex flex-col pt-4 w-full">
                        <label for="password" class="text-base text-zinc-800 px-1">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>
                    <!-- Show Password | Password -->
                    <div class="flex justify-between pt-4">
                        <div></div>
                        <div>
                            <input type="checkbox" id="password_showPassword" class="cursor-pointer" onclick="passwordFunction()">
                            <label for="password_showPassword" class="cursor-pointer">Show Password</label>
                        </div>
                    </div>

                    <div class="flex flex-col pt-4 w-full">
                        <label for="confirm_password" class="text-base text-zinc-800 px-1">Confirm Password</label>
                        <input type="password" id="confirm_password" name="password" placeholder="Password" class="shadow border rounded w-full py-3 px-3 text-gray-700 mt-1 focus:outline-green-900 bg-slate-50" />
                    </div>
                    <!-- Show Password | Confirm Password-->
                    <div class="flex justify-between pt-4">
                        <div></div>
                        <div>
                            <input type="checkbox" id="confirmPassword_showPassword" class="cursor-pointer" onclick="confirmPasswordFunction()">
                            <label for="confirmPassword_showPassword" class="cursor-pointer">Show Password</label>
                        </div>
                    </div>
    
                    <input type="submit" value="Register" name="register" class="bg-green-800  text-slate-50 text-xl hover:bg-green-900 p-3 mt-10 rounded cursor-pointer"/>

                    <div class="text-center text-lg p-5">
                        @if(Session::has('message'))
                            <p class="text-green-800">{{Session::get('message')}}<a class='font-semibold text-blue-800 hover:text-blue-900 hover:underline' href="{{ '/' }}">here </a>to login</p>
                        @else
                        <p>Already have an account? <a href="{{ '/' }}" class="hover:underline font-semibold text-lg text-green-800">Log in here.</a></p>
                        @endif
                    </div>
                </form>
            </div>

        </div>

        <!-- Image Section -->
        <div class="bg-white w-1/2 text-red-600 shadow-2xl bg-no-repeat bg-center hidden px-3 lg:block" style="background-image: url(https://wallpaperaccess.com/full/2932938.jpg)">
            @if ($errors->any())
            <div class="p-8 m-20 mt-64 bg-white border border-red-600 opacity-90 text-center">
            <ul>
            @foreach ($errors->all() as $error)
                <li class="py-2 px-3 text-lg">{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
            {{-- <img class="h-screen w-screen hidden lg:block" src="https://s-media-cache-ak0.pinimg.com/736x/0a/a8/ab/0aa8ab40d84ccdb008f8a2de26946851.jpg" alt="Background" /> --}}
        </div>
    </div>

    <!-- Jquery -->
    <script>
        $(document).ready(function(){
            $("#register_form").validate({
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
                rules : {
                   id_number : {
                        required: true,
                   } ,
                   first_name : {
                        required: true,
                   } ,
                   middle_name : {
                        required: true,
                   } ,
                   last_name : {
                        required: true,
                   } ,
                   username : {
                        required: true,
                   } ,
                   email : {
                        required: true,
                   } ,
                   password : {
                        required: true,
                   } ,
                   confirm_password : {
                        required: true,
                   } ,
                },
                messages : {
                    id_number : {
                        required: "Fill out this field",
                   } ,
                   first_name : {
                        required: "Fill out this field",
                   } ,
                   middle_name : {
                        required: "Fill out this field",
                   } ,
                   last_name : {
                        required: "Fill out this field",
                   } ,
                   username : {
                        required: "Fill out this field",
                   } ,
                   email : {
                        required: "Fill out this field",
                   } ,
                   password : {
                        required: "Fill out this field",
                   } ,
                   confirm_password : {
                        required: "Fill out this field",
                   } ,
                }
            });
        });

        // Hide and Show Password | Password
        function passwordFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        
        // Hide and Show Password | Confirm Password
        function confirmPasswordFunction() {
            var x = document.getElementById("confirm_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</body>
</html>