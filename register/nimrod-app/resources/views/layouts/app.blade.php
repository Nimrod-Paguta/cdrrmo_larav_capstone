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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> 

    <!-- Custom styles for this template-->
    <link href="css/map.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
    
    <style>
        .modal-content p {
            font-size: 18px; /* You can adjust the font size accordingly */
        }

        .pop {
            height: 670px;
        }

        .register-modal {
            height: 800px;
        }

        #mudil {
            display: flex;
        }

        #mark {
            color: #C74B3B;
        }

        #table-accident, #info-accident{
            width: 450px;
        }
    </style>
</head>

</head>
<body class="font-sans antialiased">

    <script>
        const socket = io('ws://192.168.1.240:8765');

        socket.on('connect', function() {
            // Emit a message after the connection is established
            socket.emit('send_message', 'Hello from client');
        });

        socket.on('receive_message', function(message) {
            // Add the received message to the DOM
            accident = "Sender: " + message.sender + "\nDate: " + message.date + "\nMessage: " + message.content;
            sender = message.sender.replace('+63', '0');
            // Send the accident data to a Laravel route using AJAX
            const accidentData = {
                sender: sender,
                date: message.date,
                content: message.content
            };

            // Send the accident data to Laravel route for debugging
            fetch('/accident', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // If CSRF protection is enabled
                },
                body: JSON.stringify(accidentData)
            })
            .then(response => response.json())
            .then(data => proceed(data, accidentData)) // Handle the response if needed
            .catch(error => console.error('Error:', error));

            // Alert the accident data
            function proceed(data, accidentData){

                const initialLocation = { lat: 8.149849666666666, lng: 125.13129416666666 };

                fetch('/location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // If CSRF protection is enabled
                },
                body: JSON.stringify(initialLocation)
                })
                .then(response => response.json())
                .then(accidentLocation => {
                    console.log(accidentLocation)

                    // Create a modal element
                    const modal = document.createElement('div');
                    modal.className = 'modal';
                    
                    // Create modal content
                    const modalContent = document.createElement('div');

                    modalContent.innerHTML = `
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" >
                            <div class="modal-dialog modal-content modal-xl pop" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                </div>
                                <div class="modal-body" id="mudil">
                                    <div style="margin-right: 50px;">
                                        <div id="info-accident">
                                            <i class="fa-solid fa-triangle-exclamation fa-5x" id="mark"></i>
                                            <h2><b>ACCIDENT ALERT!</b></h2>
                                            <h5><b>${accidentLocation.display_name}</b></h5>
                                        </div>
                                        <div>
                                            <table id="table-accident" style="margin-top: 30px;">
                                                <tbody>
                                                    <tr>
                                                        <td>Driver</td>
                                                        <td><b>${data.name} ${data.middlename} ${data.lastname}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td><b>${data.barangay}, ${data.municipality} ${data.province}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Car</td>
                                                        <td><b>${data.color} ${data.brand} ${data.model}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="modal-map" style="height:400px; width: 700px; border-radius: 1vh; box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);" class="my-3">
                                    </div>                                    
                                </div>
                               
                                <div class="modal-footer">
                                    <a href="/reporting">
                                        <button type="button" class="btn btn-danger">Proceed to Reporting</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `                 

                    // Append content to the modal
                    modal.appendChild(modalContent);
                    // Append the modal to the document body
                    document.body.appendChild(modal);
                    // Show the modal
                    modal.style.display = 'block';

                    let map;
                    let marker;
                    map = new google.maps.Map(document.getElementById("modal-map"), {
                        center: initialLocation,
                        zoom: 18,
                        scrollwheel: true,
                    });

                    marker = new google.maps.Marker({
                        position: initialLocation,
                        map: map,
                        draggable: true
                    });

                    // Close the modal when clicked outside the content
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                            document.body.removeChild(modal); // Remove the modal from the DOM
                        }
                    };
                
                }) // Handle the response if needed
                .catch(error => console.error('Error:', error));

                    
            } 
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
                   <!-- Topbar -->

                        
                   
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                     
                      
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                <a class="dropdown-item" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Page Content -->
                <main class="container-fluid">
                    {{ $slot }}
                </main>

                
            

            </div>
        </div>
    </div>
    
    
</body>


</html>
