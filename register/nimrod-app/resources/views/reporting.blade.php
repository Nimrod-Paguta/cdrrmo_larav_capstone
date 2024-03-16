<x-app-layout>
    <h3>Reporting</h3>

    <style>
        /* Custom modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            height: 80%;
            max-width: 900px;
            max-height: 1000px;
            border-radius: 10px;
        }

        .modal-header h4 {
            margin-top: 0;
        }

        .modal-body {
            padding: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

<h3>Reporting</h3>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Id</th>
                <th>Registered User ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Time</th>
                <th>Gforce</th>
                <th>Statux</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
                <td>1</td>
                <td>T1253</td>
                <td>-18.727286368579076</td>
                <td>29.30572768356254</td>
                <td>5pm</td>
                <td>5G</td>
                <td class="text-center"><!-- Add text-center class to center content -->
                    <button type="button" class="btn btn-primary btn2">COMPLETE</button>
                </td>
            </tr>

            <tr>
                <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
                <td>1</td>
                <td>T1253</td>
                <td>8.1719755</td>
                <td>125.09863233333333</td>
                <td>5pm</td>
                <td>5G</td>
                <td class="text-center"><!-- Add text-center class to center content -->
                    <button type="button" class="btn btn-primary btn2">aNOTHER</button>
                </td>
            </tr>
            <!-- Add other rows as needed -->
        </tbody>
    </table>

    <!-- Hardcoded Modal -->
    <div class="modal" id="myModal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <span class="close">&times;</span>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Modal content goes here -->
                <div class="mapform">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                        </div>
                    </div>
                    <div id="map" style="height:400px; width: 800px;" class="my-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="pagination">
        <button id="prev-button" class="icon disabled-icon" style="margin-right: 20px">Prev</button>
        <span id="page-info" style="margin-right: 10px"> 1-10 of 9</span>
        <button id="next-button" class="icon">Next</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Add a click event listener to the buttons
            $('.btn2').click(function () {
                // Set the modal content here
                const tr = $(this).closest('tr');
                const lat = tr.find('td:nth-child(4)').text();
                const lng = tr.find('td:nth-child(5)').text();

                $('#lat').val(lat);
                $('#lng').val(lng);

                // Show the modal
                $('#myModal').css('display', 'block');

                // Initialize map with the retrieved latitude and longitude
                initMap(parseFloat(lat), parseFloat(lng));
            });

            // Close the modal when the close button is clicked
            $('.close').click(function () {
                $('#myModal').css('display', 'none');
            });

            // Close the modal when clicking outside of it
            $(window).click(function (e) {
                if ($(e.target).is('.modal')) {
                    $('#myModal').css('display', 'none');
                }
            });
        });

        let map;
        let marker;

        function initMap(lat, lng) {
            const initialLocation = { lat: lat, lng: lng };
            map = new google.maps.Map(document.getElementById("map"), {
                center: initialLocation,
                zoom: 8,
                scrollwheel: true,
            });

            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'position_changed', function () {
                let lat = marker.position.lat();
                let lng = marker.position.lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
            });

            google.maps.event.addListener(map, 'click', function (event) {
                marker.setPosition(event.latLng);
            });

            // Function to center the map on user input latitude and longitude
            function centerMapOnLocation(lat, lng) {
                const newLocation = { lat: parseFloat(lat), lng: parseFloat(lng) };
                map.setCenter(newLocation);
                marker.setPosition(newLocation);
            }

            // Trigger map centering on user input
            $('#lat').on('input', function () {
                const lat = $(this).val();
                const lng = $('#lng').val();
                centerMapOnLocation(lat, lng);
            });

            $('#lng').on('input', function () {
                const lat = $('#lat').val();
                const lng = $(this).val();
                centerMapOnLocation(lat, lng);
            });
        }
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                        type="text/javascript"></script>
</x-app-layout> 
