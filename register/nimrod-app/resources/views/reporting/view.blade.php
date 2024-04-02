<x-app-layout>
    <style>
        .hayt {
            height: 100vh;
        }
    </style>
    <div class="hayt">
        <center>
            <h5>Reporting Details</h5>
        </center>

        <div class="row">
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="mapform">
                            <div class="row">
                                <div class="col-5">
                                    <span>Latitude</span>
                                    <input type="text" class="form-control" placeholder="lat" name="lat" id="lat"
                                        value="{{$report->latitude}}" disabled>
                                </div>
                                <div class="col-5">
                                    <span>Longitude</span>
                                    <input type="text" class="form-control" placeholder="lng" name="lng" id="lng"
                                        value="{{$report->longitude}}" disabled>
                                </div>
                            </div>
                            <div id="map" style="height:584px; width: 570px;" class="my-3"></div>
                        </div>
                        <div class="d-flex justify-content-center mb-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Driver info:</h5>
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
                                <p class="text-muted mb-0">{{$register->emergencynumber}}</p>
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
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Accident Details:</h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Time:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$report->time}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Gforce:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$report->gforce}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Location:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$report->barangay}}, {{$report->city}}</p>
                            </div>
                        </div>
                          <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Alert Message:</p>
                            </div>
                            <div class="col-sm-9">
                            Attention: Urgent! A car crash has just occured at the {{$report->barangay}}, {{$report->city}}. The involved parties include a {{$register->model}} registered under the full name of {{$register->name}} {{$register->middlename}} {{$register->lastname}}. Please respond immediately and exercise caution in the area.
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

    <select class="form-control" id="status" name="status">
        <option value="ongoing" {{ $report->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
        <option value="unread" {{ $report->status === 'unread' ? 'selected' : '' }}>Unread</option>
        <option value="completed" {{ $report->status === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <button type="submit" class="btn mt-2" style="background-color: green; border-color: green; color: white;">Submit</button>
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
                        zoom: 8,
                        scrollwheel: true,
                    });

                    const uluru = { lat: parseFloat("{{$report->latitude}}"), lng: parseFloat("{{$report->longitude}}") };
                    let marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        draggable: true
                    });

                    google.maps.event.addListener(marker,'position_changed',
                        function (){
                            let lat = marker.position.lat();
                            let lng = marker.position.lng();
                            $('#lat').val(lat);
                            $('#lng').val(lng);
                        });

                    google.maps.event.addListener(map,'click',
                    function (event){
                        let pos = event.latLng;
                        marker.setPosition(pos);
                        let lat = pos.lat();
                        let lng = pos.lng();
                        $('#lat').val(lat);
                        $('#lng').val(lng);
                    });
                }
            </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                    type="text/javascript"></script>
</x-app-layout>
