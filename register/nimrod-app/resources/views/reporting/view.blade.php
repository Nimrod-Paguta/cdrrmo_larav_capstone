<x-app-layout>

<style>
    .hayt{
        height: 100vh;
    }
</style>   <div class="hayt">


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
                    <div id="map" style="height:520px; width: 570px;" class="my-3"></div>
                </div>
                <div class="d-flex justify-content-center mb-2">

                </div>
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
                        <p class="text-muted mb-0">full name</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Address:</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">full name</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Accident Details:</h5>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Full Name:</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">full name</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Address:</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">full name</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</section>

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
</div>

</x-app-layout>