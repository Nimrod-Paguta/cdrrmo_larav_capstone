<x-app-layout>
<style>
        .hayt{
            height: 100vh;
        }
    </style>
   <div class="hayt">
    
   <h1>Reports</h1>
        <table  id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
                <tr>
                    <th>User ID</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Action</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->registereduserid }}</td>
                    <td>{{ $report->latitude }}</td>
                    <td>{{ $report->longitude }}</td>
                    <td>{{ $report->barangay }}</td>
                    <td>{{ $report->city }}</td>
                    <!-- Add more table cells for other attributes -->
                    <td style="text-align: center;">
    <a href="" style="display: inline-block;">
        <button type="submit" class="btn btn-secondary actions-buttons" style="background-color: green; width: 220px;"><i
                 class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
    </a>
</td>


                </tr>
                @endforeach
            </tbody>
        </table>
   </div>


                <!-- Include jQuery -->
                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

<script>
    $(document).ready(function() {
        $('#yourDataTableID').DataTable();
    });
</script>
 
</x-app-layout>
