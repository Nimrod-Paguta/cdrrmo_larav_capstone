@role('admin')
<x-app-layout>
    <style>
        /* Custom CSS to adjust the button width */
.actions-buttons.btn-sm {
    width: 150px; /* Adjust the width as needed */
}

    </style>

<a href="/reporting" class="btn btn-primary" id="registerReport" style="margin-right: 10px">Back</a>
        <h1>Archived Reports</h1>
        <table id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivedReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ explode(' ', $report->created_at)[0] }}</td>
                        <td>{{ explode(' ', $report->created_at)[1] }}</td>
                        <td>{{ $report->barangay }}</td>
                        <td>{{ $report->city }}</td>
                        <td>
                            <span style="background-color: 
                                @if($report->status == 'ongoing') 
                                    orange;
                                @elseif($report->status == 'completed') 
                                    green;
                                @elseif($report->status == 'unread') 
                                    red; 
                                @endif 
                                    color: white; padding: 5px 10px; border-radius: 5px;">
                                {{ $report->status }}
                            </span>
                        </td>
                        <td class="text-center">
                        <form method="POST" action="{{ route('reports.restore', ['id' => $report->id]) }}" style="display:inline;">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-warning actions-buttons btn-sm">Restore</button>
                        </form>


                @endforeach

                <!-- Add other rows as needed -->
            </tbody>
        </table>


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
@endrole
@role('driver')
<center><h1>404 - Page Not Found</h1></center>
@endrole