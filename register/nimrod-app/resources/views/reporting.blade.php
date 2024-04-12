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

      
    </style>

    <div class="hayt">
        <h3>Reporting</h3>
        <div style="display: flex;">
        <a href="{{$pdf}}" target="_blank" class="btn btn-primary" id="registerReport" style="margin-right: 5px"><i class="fas fa-download fa-sm text-white-70"></i> Generate Report</a>

            <select id="reportingSelect" class="form-control" style="width: 135px">
                <option value="0">All Time</option>
                <option value="1">This Week</option>
                <option value="2">This Month</option>
                <option value="3">Last Month</option>
                <option value="4">This Year</option>
                <option value="5">Last Year</option>
            </select>
        </div>
        <table id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
                <tr>
                    <th>Id</th>
                    <th>Registered User ID</th>
                    <th>Date</th>
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
                            <!-- Add text-center class to center content -->
                            <form method="POST" action="{{ route('reports.destroy', ['id' => $report->id]) }}" style="display:inline;">
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
                        if(middleName{{ $report->id }}){
                            document.getElementById('name_{{ $report->id }}').innerText = firstName{{ $report->id }} + " " + middleName{{ $report->id }} + " " + lastName{{ $report->id }};
                        }else{
                            document.getElementById('name_{{ $report->id }}').innerText = firstName{{ $report->id }} + " " + lastName{{ $report->id }};
                        }
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
            $(document).ready(function () {
                $('#yourDataTableID').DataTable();

                // update select if changed
            var selectElement = document.getElementById('reportingSelect');
            for(var i = 0; i < selectElement.options.length; i++) {
                if(selectElement.options[i].value == {!! json_encode($sort) !!}) {
                    selectElement.options[i].selected = true;
                    break;
                }
            }
        
                document.getElementById('reportingSelect').addEventListener('change', function() {
                        var select = parseInt(this.value);
                        updateTable(select)
                    });
        
                function updateTable(select){
                    switch (select) {
                        case 0:
                            getReports('/reporting')
                            break;
                        case 1:
                            getReports('/this-week-reports')
                            break;
                        case 2:
                            getReports('/this-month-reports')
                            break;
                        case 3:
                            getReports('/last-month-reports')
                            break;
                        case 4:
                            getReports('/this-year-reports')
                            break;
                        case 5:
                            getReports('/last-year-reports')
                            break;
                        
                        default:
                            break;    
                        }
                    }
                
                function getReports(registerURL){
                    $.ajax({
                        url: registerURL,
                        type: 'GET',
                        success: function(response) {
                            window.location.href = registerURL;
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
        
            });
        </script>
    </div>
</x-app-layout>
