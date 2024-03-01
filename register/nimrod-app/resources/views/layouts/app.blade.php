<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reporting.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('css/map.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>   
</head>

</head>
<body class="font-sans antialiased">
<script>
                        const socket = io('ws://192.168.1.239:8765');

                        socket.on('connect', function() {
                            // Emit a message after the connection is established
                            socket.emit('send_message', 'Hello from client');
                        });

                        socket.on('receive_message', function(message) {
                            // Add the received message to the DOM
                            console.log(message);
                            accident = "Sender: " + message.sender + "\nDate: " + message.date + "\nMessage: " + message.content
                            alert(accident);
                        });

                    </script>

    <div id="wrapper">

        <!-- Sidebar -->
        
        <ul class="navbar-nav sidecolor sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}" :class="{ 'active': request()->routeIs('dashboard') }">
                <div class="sidebar-brand-text mx-3"> CDRRMO</div>
                <div class="sidebar-brand-text mx-3">  <img src="{{ asset('img/register/logo.png') }}" alt="Description of the image" ></div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="/reporting">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Reporting</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="/registerpage">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Register</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

    

        </ul>
        <!-- End of Sidebar -->
    

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            

                <!-- Page Content -->
                <main class="container-fluid">
                    {{ $slot }}

                    

</main>

                
            

            </div>
        </div>
    </div>
</body>


</html>
