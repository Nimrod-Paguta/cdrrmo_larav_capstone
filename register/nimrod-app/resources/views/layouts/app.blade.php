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

            let userid = message.content.split('&%&')[0];
            let coordinates = message.content.split('&%&')[1];
            let gforce = message.content.split('&%&')[2];
            let key = message.content.split('&%&')[3];
            let intValue = parseInt(userid);
            let latitude = coordinates.split('///')[0];
            let longitude = coordinates.split('///')[1];

            // Send the accident data to a Laravel route using AJAX
            const accidentData = {
                id: intValue,
                sender: sender,
                date: message.date,
                content: message.content,
                key: key
            };

            console.log(accidentData)
            console.log(coordinates)
            console.log(gforce)
            console.log(key)

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

                const initialLocation = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

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

                    const currentDate = new Date();
                    const currentMonth = currentDate.getMonth() + 1;
                    const barangay = accidentLocation.address.quarter
                    const city = accidentLocation.address.city
                    const CRASHWATCH_CITY = accidentLocation.crashwatch_city;

                    if (city === CRASHWATCH_CITY) {
                        console.log('City is defined');
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
                                                        <tr>
                                                            <td>Medical Condition</td>
                                                            <td><b>${data.medicalcondition ? data.medicalcondition : "None"}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time & Date</td>
                                                            <td><b>${message.date} ${currentDate.getHours()}:${currentDate.getMinutes()}</b></td>
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

                        const report = {
                            registereduserid: data.id,
                            latitude: parseFloat(latitude),
                            longitude: parseFloat(longitude),
                            time: message.time,
                            gforce: gforce,
                            status: "unread",
                            month: currentMonth,
                            barangay: barangay,
                            city: city,
                            address: accidentLocation.display_name,
                        }

                        console.log(report)

                        storeReport(report)
                    } else {
                        console.log('City is undefined');
                    }

                    
                
                }) // Handle the response if needed
                .catch(error => console.error('Error:', error));  
            }

            function storeReport(report){
                fetch('/post_report', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // If CSRF protection is enabled
                },
                body: JSON.stringify(report)
                })
                // .then(response => response.json())
                .then(verify => {console.log(verify)})
            }
        }); 

        function sendReport(id, userid) {
            console.log(id);

            let report = {
                userid: userid,
                id: id
            }

            fetch('{{ route('reporting.send')}}',  {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // If CSRF protection is enabled
                },
                body: JSON.stringify(report)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                const stringNumbers = data.contactNumbers.map(number => `+63${number}`);
                const address = data.report.barangay + ", " + data.report.city
                console.log(address)
                socket.emit('send_on', stringNumbers, address);
            })

        }

    </script>


    <div id="wrapper">










    
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white sidecolor" style="width: 240px; height: auto; ">
  <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <div class="sidebar-brand-text mx-3"><img src="{{ asset('img/register/logo_cdrrmo-new.png') }}" alt="Description of the image"></div>
  </a>
  <h2 style="text-align: center;"><b>CDRRMO</b></h2>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li style="padding-top: 5px;">
      <a  href="/dashboard" class="nav-link text-white {{ Request::is('dashboard') ? 'active' : '' }}" >
        <svg class="bi me-2" width="16" height="9"><use xlink:href="#speedometer2"/></svg>
        <i class="fa-solid fa-house" style="padding-right: 16px;"></i>
        Dashboard
      </a>
    </li>
    <li style="padding-top: 10px;">
      <a href="/reporting" class="nav-link text-white {{ Request::is('reporting') ? 'active' : '' }}">
        <svg class="bi me-2" width="16" height="9"><use xlink:href="#table"/></svg>
        <i class="fa-solid fa-phone" style="padding-right: 16px;"></i>
        Reporting
      </a>
    </li>
    <li style="padding-top: 10px;">
      <a href="/registerpage" class="nav-link text-white {{ Request::is('registerpage') ? 'active' : '' }}">
        <svg class="bi me-2" width="16" height="9""><use xlink:href="#grid"/></svg>
        <i class="fa-regular fa-user" style="padding-right: 16px;"></i>
        Register
      </a>
    </li>
    <li style="padding-top: 10px;">
      <a href="/barangay" class="nav-link text-white {{ Request::is('barangay') ? 'active' : '' }}">
        <svg class="bi me-2" width="16" height="9"><use xlink:href="#grid"/></svg>
        <i class="fa-regular fa-user" style="padding-right: 16px;"></i>
        Barangay
      </a>
    </li>
  </ul>
</div>







        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">




                   <!-- Topbar -->
                   <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="ml-auto">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div> 
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

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
