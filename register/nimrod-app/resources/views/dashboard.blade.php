 <x-app-layout>

     <!DOCTYPE html>
     <html lang="en">

     <head>

         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <meta name="description" content="">
         <meta name="author" content="">

         <title>SB Admin 2 - Dashboard</title>

     </head>

     @role('admin')


     @php
         $reportController = new App\Http\Controllers\DashboardController();
         $totalCompletedReports = $reportController->getTotalCompletedReports();
     @endphp


     @php
         $reportController = new App\Http\Controllers\DashboardController();
         $totalPublicVehicle = $reportController->getTotalPublicVehicle();
     @endphp


     @php
         $reportController = new App\Http\Controllers\DashboardController();
         $totalPrivateVehicle = $reportController->getTotalPrivateVehicle();
     @endphp

     @php
    $reportController = new App\Http\Controllers\DashboardController();
    $totalReports = $reportController->getTotalCompletedReportsByTimestamp();
@endphp


     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">

         <!-- Trigger modal -->

     
     </div>

     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> <a href="" id="openModalTrigger" data-toggle="modal"
             data-target="#myModal">
             <!-- <img width="40" height="30" src="https://img.icons8.com/ios/50/alarm--v1.png" alt="alarm--v1"/> -->
         </a>
         <a href="/dashboardreport" target="_blank" class="btn btn-primary" id="registerReport" style="margin-right: 5px"><i class="fas fa-download fa-sm text-white-70"></i> Generate Report</a>
        

     </div>
     



     <!-- Modal -->
     <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

         <div class="modal-dialog " role="document">
             <div class="modal-content ">
                 <div class="modal-header ">
                     <h5 class="modal-title" id="exampleModalLabel">Your Modal Title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Open">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class=" modal-content">
                     <i class="fa-solid fa-triangle-exclamation"></i>
                     <p class="font-modalcontent">Lorem ipsum dolor sit amet consectetur,
                         adipisicing elit. Eius, ea quaerat! Nostrum quaerat voluptate animi
                         ab nemo placeat iure cum nisi eaqu molestiae similique, accusamus, est
                         odit iusto aliquid neque.</p>
                 </div>
                 <div>

                     <a href="/reporting"> <button type="button" class="btn btn-secondary">Proceed to
                             Reporting</button></a>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                 </div>
             </div>
         </div>
     </div>

     <div class="row">

         @php
             $registerController = new App\Http\Controllers\DashboardController();
             $totalRegistered = $registerController->getTotalRegistered();
         @endphp

         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-primary shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                 Total Registered Driver</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRegistered) }}
                             </div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-users  fa-2x text-gray-300"></i>
                             
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>




         @php
             $reportController = new App\Http\Controllers\DashboardController();
             $totalReported = $reportController->getTotalReported(); 
         @endphp



         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-success shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Total Report</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalReported) }}
                             </div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-file fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>









         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-info shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Completed Report
                             </div>
                             <div class="row no-gutters align-items-center">
                                 <div class="col-auto">
                                     <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                         {{ $totalCompletedReports }} </div>
                                 </div>

                             </div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-list fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>


         @php
             $reportController = new App\Http\Controllers\DashboardController();
             $totalVehicle = $reportController->getTotalVehicle();
         @endphp

         <!-- Pending Requests Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-warning shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                 Total Vehicle</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalVehicle) }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas  fa-car  fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Content Row -->




     <div class="row">

         <!-- Area Chart -->
         <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Total Reports</h6>
                <div class="dropdown no-arrow">
                    <select id="monthDropdown" class="form-control">
                        <option value="0">All Time</option>
                        <option value="1">This Week</option>
                        <option value="2">This Month</option>
                        <option value="3">Last Month</option>
                        <option value="4">This Year</option>
                        <option value="5">Last Year</option>
                    </select>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area" style="height: 300px;">
                    <center><div id="loadingSpinner" style="display: none;">
                        <h4>Loading...</h4>
                    </div></center>
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
















<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <h6 class="m-0 font-weight-bold text-primary">Recently Added Users</h6>
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="table-responsive tablename" style="max-height: 390px; overflow-y: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Driver's Status</th>
                    </tr>
                </thead>
                <tbody>
@if(isset($recentRegisters))
@foreach($recentRegisters as $register)
<tr>
    <th scope="row">{{ $register->id }}</th>
    <td>{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</td>
    <td>{{ $register->contactnumber }}</td>
    <td>{{ $register->type }}</td>
</tr>
@endforeach
@endif
</tbody>

            </table>
        </div>
    </div>
</div>






         

         


         <!-- Pie Chart -->
         <div class="col-xl-4 col-lg-5">
             <div class="card shadow mb-4" style="width: auto; height: 430px;">
                 <!-- Card Header - Dropdown -->
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">CrashWatch Chart</h6>
                     <div class="dropdown no-arrow">
                         <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                             aria-labelledby="dropdownMenuLink">
                             <div class="dropdown-header">Dropdown Header:</div>
                             <a class="dropdown-item" href="#">Action</a>
                             <a class="dropdown-item" href="#">Another action</a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="#">Something else here</a>
                         </div>
                     </div>
                 </div>
                 <!-- Card Body -->
                 <div class="card-body">
                     <div class="chart-pie pt-4 pb-2" ">
                         <canvas id="myPieChart1"></canvas>
                     </div>

                 </div>
             </div>
         </div>




         <!-- Bar Chart -->

         <div class="col-xl-4 col-lg-7">
             <div class="card shadow mb-4" >
                 <canvas id="barChart" style="height: 420px;" ></canvas>
             </div>
         </div>




         
         <div class="col-xl-4 col-lg-4">
            <h6 class="m-0 font-weight-bold text-primary">Recent Accident</h6>

             <div class="card shadow mb-4"  style="height: 400px;">
             <!--Google map-->
                        {{-- <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                        <iframe src="https://maps.google.com/maps?q=malaybalay&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                            style="border:0" allowfullscreen></iframe>
                        </div> --}}
                        <!--Google Maps-->
                        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height:500px; border-radius: 1vh; box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);"></div>
            </div>
             
         </div>









         

         <!-- Scroll to Top Button-->
         <a class="scroll-to-top rounded" href="#page-top">
             <i class="fas fa-angle-up"></i>
         </a>
         <!-- Bootstrap core JavaScript-->
         <script src="vendor/jquery/jquery.min.js"></script>
         <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

         <!-- Core plugin JavaScript-->
         <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

         <!-- Custom scripts for all pages-->
         <script src="js/sb-admin-2.min.js"></script>



         <!-- Include Chart.js library -->
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

         <script>
           $(document).ready(function() {
            $('#loadingSpinner').show();

            function getReports(reportURL){
                 $.ajax({
                    url: reportURL,
                    type: 'GET',
                    success: function(response) {
                        $('#loadingSpinner').hide();
                        // Response should contain labels and counts arrays
                        createChart(response.labels, response.counts);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#loadingSpinner').hide();
                    }
                });
            }

            function updateChart(select){
                switch (select) {
                    case 0:
                        getReports('/all-time-report-dashboard')
                        break;
                    case 1:
                        getReports('/this-week-report-dashboard')
                        break;
                    case 2:
                        getReports('/this-month-report-dashboard')
                        break;
                    case 3:
                        getReports('/last-month-report-dashboard')
                        break;
                    case 4:
                        getReports('/this-year-report-dashboard')
                        break;
                    case 5:
                        getReports('/last-year-report-dashboard')
                        break;
                
                    default:
                        break;
                }
            }

            document.getElementById('monthDropdown').addEventListener('change', function() {
                var select = parseInt(this.value);
                updateChart(select);
            });

            getReports('/all-time-report-dashboard')

            });

            function createChart(labels, counts) {
                var ctx = document.getElementById('myAreaChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Reports',
                            data: counts,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value) {
                                        return value; // Display as it is
                                    }
                                }
                            }]
                        }
                    }
                });
            }
            
        </script>
        







        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.font.family = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.font.color = '#858796';


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart1");
    var totalRegistered = {{ $totalRegistered }};
    var totalReported = {{ $totalReported }};
    var totalCompletedReports = {{ $totalCompletedReports }};
    var totalVehicle = {{ $totalVehicle }};
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Total Registered', 'Total Reported', 'Total Completed Reports', 'Total Vehicle'],
            datasets: [{
                data: [totalRegistered, totalReported, totalCompletedReports, totalVehicle],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#cc3675'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#cc3675'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            var value = context.parsed;
                            if (value !== null) {
                                label += value.toLocaleString();
                            }
                            return label;
                        }
                    }
                }
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>








@php
    $topBarangays = App\Models\Report::select('barangay', \DB::raw('COUNT(*) as total'))
                        ->groupBy('barangay')
                        ->orderByDesc('total')
                        ->limit(10)
                        ->pluck('total', 'barangay');
@endphp


<script>
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topBarangays->keys()) !!},
            datasets: [{
                label: 'Total Reports by Barangay',
                data: {!! json_encode($topBarangays->values()) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

         

         <script>
            const status = { status: 200 };

            fetch('/recentaccident', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // If CSRF protection is enabled
            },
            body: JSON.stringify(status)
            })
            .then(response => response.json())
            .then(accidentLocation => {

            const initialLocassstion = { lat: parseFloat(accidentLocation.report.latitude), lng: parseFloat(accidentLocation.report.longitude) };
            console.log(initialLocassstion)

            let map;
            let marker;
            map = new google.maps.Map(document.getElementById("map-container-google-1"), {
                center: initialLocassstion,
                zoom: 18,
                scrollwheel: true,
            });

            marker = new google.maps.Marker({
                position: initialLocassstion,
                map: map,
                draggable: true
            });


            })
               
         </script>

         



         <!-- Page level plugins -->
         <script src="vendor/chart.js/Chart.min.js"></script>

         <script src="js/demo/chart-pie-demo.js"></script>

         @endrole

         <!-- @role('driver')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Driver's Status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($registers as $register)
                            @if($register->id == auth()->user()->register_id)
                                <tr>
                                    <td>{{ $register->id }}</td>
                                    <td>{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</td>
                                    <td>{{ $register->contactnumber }}</td>
                                    <td>{{ $register->type }}</td>
                                    <td>
                                    <a class="ahhh"  href="{{ route('registerpage.edit', ['id' => $register->id]) }}"><button type="submit" class="btn btn-warning actions-buttons">Edit</button></a>
                                    <a  href="{{ route('registerpage.view', ['id' => $register->id]) }}"><button type="submit" class="btn btn-secondary actions-buttons">View</button></a>
                                </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endrole -->


  
         <!-- create register table here -->


         

 @role('driver')

 
 
@foreach ($registers as $register)
                            @if($register->id == auth()->user()->register_id)
 <div class="row" style="margin-top: 15px;">
   <div class="col-lg-4">
     <div class="card mb-4">
       <div class="card-body text-center">
                       <center>
                            @if($register->gender == 'Male')
                                <img src="{{ asset('img/register/man.png') }}" style="width: 300px; height: 250px;">
                            @elseif($register->gender == 'Female')
                                <img src="{{ asset('img/register/woman.png') }}" style="width: 300px; height: 250px;">
                            @endif
                        </center>

         <h5 class="my-3">{{ $register->name }}</h5>
         <p class="text-muted mb-1">Registered Driver of CDRRMO</p>
         <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
         <div class="d-flex justify-content-center mb-2">
            <a class="ahhh" href="{{ route('registerpage.edit', ['id' => $register->id]) }}" >
    <button style="width: 400px;" type="submit" class="btn btn-success actions-buttons">Edit</button>
     </a>
            
         
         
         </div>
       </div>
       
     </div>
     
   
   </div>

   
   
   <div class="col-lg-8">
   <h3>Owner's Profile</h3>
     <div class="card mb-4">
       <div class="card-body">
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Vehicle Owner:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Email</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->email }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Gender</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->gender }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Address:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->barangay }}, {{ $register->municipality }}, {{ $register->province }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Phone Number:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->contactnumber }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Emergency Number:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->emergencynumber }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Medical Condition:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->medicalcondition ? $register->medicalcondition : "None" }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Brand</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->brand }}</p>
           </div>
         </div>
         
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Model:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->model }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Vehicle License:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->vehiclelicense }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Vehicle Type:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->type }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Color:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->color }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Date Registered:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->created_at }}</p>
           </div>
         </div>
         
       </div>
     </div>
    
   </div>
 </div>
</div>
</section>
@endif
                        @endforeach

</div>


@endrole

 </x-app-layout>
