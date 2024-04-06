<x-app-layout>

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
            background-color: rgba(0, 0, 0, 0.4);
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

        .hayt {
            height: 100vh;
        }
    </style>

    <div class="hayt">
        <h3>Reporting</h3>
        <table id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
                <tr>
                    <th>Id</th>
                    <th>Registered User ID</th>
                    <th>Time</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td id="name_{{ $report->id }}"></td>
                        <td>{{ $report->time }}</td>
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
                            <!-- Add text-center class to center content -->
                            <form method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger actions-buttons">Delete</button>
                            </form>
                            <a href="{{ route('reporting.view', ['id' => $report->id]) }}">
                                <button type="submit" class="btn btn-secondary actions-buttons">View</button>
                            </a>
                            {{-- <a>
                                <button type="submit" class="btn btn-primary actions-buttons" onclick="sendReport({{ $report->id }}, {{ $report->registereduserid }})">Send</button>
                            </a> --}}
                        </td>
                    </tr>
                    <script>
                        const report{{ $report->id }} = {!! json_encode($report) !!};
                        const firstName{{ $report->id }} = report{{ $report->id }}.registereduserid.name;
                        const middleName{{ $report->id }} = report{{ $report->id }}.registereduserid.middlename;
                        const lastName{{ $report->id }} = report{{ $report->id }}.registereduserid.lastname;
                        document.getElementById('name_{{ $report->id }}').innerText = firstName{{ $report->id }} + " " + middleName{{ $report->id }} + " " + lastName{{ $report->id }};
                    </script>
                @endforeach

                <!-- Add other rows as needed -->
            </tbody>
        </table>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <!-- <script>
            console.log(@json($reports))
        </script> -->

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
    </div>
</x-app-layout>
