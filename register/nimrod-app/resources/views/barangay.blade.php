<x-app-layout>
    <style>
       
    </style>
    <div class="hayt">
        <h3>Barangay Report</h3>
        <a href="/allreports" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-70"></i> Generate Report</a>
        <table id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
                <tr>
                    <th>Barangay</th>
                    <th>Total Reports</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($totalReportsByBarangay as $report)
                <tr>
                    <td>{{ $report->barangay }}</td>
                    <td>{{ $report->total_reports }}</td>
                    <td>{{ $report->city }}</td>
                    <td style="text-align: center;">
                    <form method="GET" action="{{ route('barangayreport', ['id' => $report->barangay]) }}">
    @csrf
    <button type="submit" class="btn btn-secondary actions-buttons" style="background-color: green; width: 220px;">
        <i class="fas fa-download fa-sm text-white-70"></i> Generate Report
    </button>
</form>


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
