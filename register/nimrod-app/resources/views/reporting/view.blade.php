<x-app-layout>
    <style>
        .hayt {
            height: 100vh;
        }
        #status{
            display: flex;
            margin: 5px;
        }
        #send-modal{
            height: 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spinner {
            /* border-radius: 50%; */
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        #text-loading{
            font-size: 100px;
        }
    </style>
    <div class="hayt">
            <h3>Reporting Details</h3>
                    <button type="submit" class="btn btn-outline-primary ms-1 mb-3" onclick="openModal()" style="background-color: red; border-color: blue; color: white;">Send Notification</button>
                    <a href="{{ route('reports', ['id' => $report->id]) }}" target="_blank" class="btn btn-outline-primary ms-1 mb-3" >
                        <i class="fas fa-download fa-sm text-white-70"></i>
                        Generate Report</a>

                
                    <div id="mySendModal" class="modal">
    <div class="modal-dialog modal-content modal-lg send-modal">

        <div id="sending-display" style="display: none;">
            <center><img src="/img/loading.png" alt="loading..." id="loading-img" style="height: 350px; width: 350px; margin-right: 20px; margin-top: 20px;"></center>
            <h2><b>Sending Notification To All Users...</b></h2>
            <h4>Please Wait</h4>
        </div>

        <div id="sent-display" style="display: none;">
            <center><img src="/img/sent.png" alt="loading..." id="loading-img" style="height: 350px; width: 350px; margin-right: 20px; margin-top: 20px;"></center>
            <h2><b>Notification Sent!</b></h2>
            <button style="margin-top: 70px" onclick="closeModal()">Close</button>
        </div>
        
        <!-- <h1 id="text-loading"><i class="fa-solid fa-spinner spinner" style="padding-right: 16px;"></i></h1> -->
        <!-- <button onclick="closeModal()">Exit</button> -->
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('mySendModal').style.display = 'flex';
        sendReport({{ $report->id }}, {{ $report->registereduserid }});
    }

    function closeModal() {
        document.getElementById('mySendModal').style.display = 'none';
    }
</script>




        <div class="row">
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="mapform">
                            <center><div id="map" style="height:584px; width: auto;" class="my-3"></div></center>
                        </div>
                        <div class="d-flex justify-content-center mb-2"></div>
                    </div>
                </div>
                <!-- <a>
                    <button type="submit" class="btn btn-primary" onclick="sendReport({{ $report->id }}, {{ $report->registereduserid }})">Send Notification</button>
                    <a href="{{ route('reports', ['id' => $report->id]) }}" class="btn btn-primary" style="background-color: red; border-color: blue; color: white;">Generate Report</a>
                </a> -->
            </div>
            <div class="col-lg-7">
            <h3>Driver Information</h3>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$register->name}} {{$register->middlename}} {{$register->lastname}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Emergency Number:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">0{{$register->emergencynumber}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Medical Condition:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$register->medicalcondition ? $register->medicalcondition : 'None'}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Model:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$register->model}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$register->barangay}}, {{$register->municipality}}, {{$register->province}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Accident Details</h3>
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ID:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$report->id}}</p>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Time & Date:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{date('Y-m-d', strtotime($report->created_at))}} {{$report->time}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Severity:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <!-- {{($report->gforce == 0) ? "" : $report->gforce."g"}}  -->
                                    {{
                                        ($report->gforce > 0 && $report->gforce < 4) ? "Safe" :
                                        (($report->gforce >= 4 && $report->gforce < 20) ? "Low" : 
                                        ((($report->gforce >= 20 && $report->gforce < 40) ? "Moderate" : 
                                        (($report->gforce > 40) ? "Severe" : "Disoriented"))))
                                    }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Location:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$report->address}}</p>
                            </div>
                        </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Coordinates:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">LAT: {{$report->latitude}}, LON: {{$report->longitude}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Status:</p>
                            </div>
                            <div class="col-sm-9">
                            <form id="statusForm" method="POST" action="{{ route('reporting.update', ['id' => $report->id]) }}">
    @csrf
    @method('PUT')

    <div id="status">
    <select class="form-control" id="status" name="status">
        <option value="ongoing" {{ $report->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
        <option value="unread" {{ $report->status === 'unread' ? 'selected' : '' }}>Unread</option>
        <option value="completed" {{ $report->status === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <button type="submit" class="btn mt-1" style="background-color: green; border-color: green; color: white;">Submit</button>

    </div>

  
</form>

                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>





<script>
                let map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat: parseFloat("{{$report->latitude}}"), lng: parseFloat("{{$report->longitude}}") },
                        zoom: 18,
                        scrollwheel: true,
                    });

                    const uluru = { lat: parseFloat("{{$report->latitude}}"), lng: parseFloat("{{$report->longitude}}") };
                    let marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        draggable: true
                    });

                    marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });
                }
            </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                    type="text/javascript"></script>
</x-app-layout>
