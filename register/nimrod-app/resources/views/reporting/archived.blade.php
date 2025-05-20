<x-app-layout>
    <style>
        /* Custom CSS to adjust the button width */
        .actions-buttons.btn-sm {
            width: 150px; /* Adjust the width as needed */
        }

        /* Custom CSS to set the modal height */
        #restoreModal .modal-content {
            height: 200px; /* Set the modal height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #restoreModal .modal-body {
            height: 100%; /* Ensure modal body takes the full height */
            display: flex;
            align-items: center;
            justify-content: center;
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
                    <!-- Trigger Modal -->
                    <button type="button" class="btn btn-warning actions-buttons btn-sm" data-bs-toggle="modal" data-bs-target="#restoreModal" data-report-id="{{ $report->id }}">
                        Restore
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Confirming Restore -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to restore this report?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Restore button inside form -->
                    <form id="restoreForm" method="POST" action="" style="display:inline;">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-warning">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        // Script to handle modal interaction
        $('#restoreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var reportId = button.data('report-id'); // Extract the report ID
            var formAction = '{{ route('reports.restore', ['id' => ':id']) }}'.replace(':id', reportId);

            // Set the form action dynamically based on the report ID
            $('#restoreForm').attr('action', formAction);
        });
    </script>

    <!-- DataTable and other necessary JS -->
    <script>
        $(document).ready(function() {
            $('#yourDataTableID').DataTable();
        });
    </script>
</x-app-layout>