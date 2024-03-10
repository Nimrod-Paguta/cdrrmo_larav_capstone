<x-app-layout>


        @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
        
        <h3>Register</h3>
        <button class="btn" onclick="openModal()">+ register</button>
        <table id="yourDataTableID" class="table table-striped" style="width:100%">
            <thead class="table-header">
            <tr>
                  
                    <th>Id</th>
                    <th>Name of Owner:</th>
                    <th>Address:</th>
                    <th>Contact Number:</th>
                    <th>Plate Number:</th>
                    <th>Vehicle License:</th>
                    <th>Date Registered:</th>
                    <th>Action</th>  
            </tr>
            </thead>
            <tbody>
            @foreach($registers as $register)
            <tr>
                
                <td>{{ $register->id }}</td>
                <td>{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</td>
                <td>{{ $register->barangay }}, {{ $register->municipality }}, {{ $register->province }}</td>
                <td>{{ $register->contactnumber }}</td>
                <td>{{ $register->placard }}</td>
                <td>{{ $register->vehiclelicense }} </td> 
                <td>{{ $register->date }}</td>
                <td>


                <form action="{{ route('registerpage.destroy', $register->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
                </form>
                <a class="ahhh"  href="{{ route('registerpage.edit', ['id' => $register->id]) }}">edit</a>
                <a  href="{{ route('registerpage.view', ['id' => $register->id]) }}">view</a>
              

                </td>
            </tr>
            @endforeach
            
            </tbody>
        </table>	




        


        <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- Your form content goes here -->
                <h3>Owner Information</h3>
                <form class="row g-3 needs-validation" method="post" action="{{ route('users.post') }}">
                            @csrf
                        
                            
                            <div class="col-md-4">
                                <label for="first_name" class="form-label naog">First Name</label>
                                <input type="text" class="form-control" name="name" required>
                                <div class="invalid-feedback">
                                    Please enter a valid first name.
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middlename">
                                <div class="invalid-feedback">
                                    Please enter a valid middle name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" required>
                                <div class="invalid-feedback">
                                    Please enter a valid last name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Barangay</label>
                                <input type="text" class="form-control" name="barangay" required>
                                <div class="invalid-feedback">
                                    Please enter barangay. 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Municipality/City</label>
                                <input type="text" class="form-control" name="municipality" required>
                                <div class="invalid-feedback">
                                    Please enter Municipality or City.  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Province</label>
                                <input type="text" class="form-control" name="province" required>
                                <div class="invalid-feedback">
                                    Please enter Province.  
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contactnumber" required>
                                <div class="invalid-feedback">
                                    Please enter Contact Number.  
                                </div>
                            </div>
                            
                            

                    <h3>Vehicle Information</h3>
                
                                        
                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control" name="brand" required>
                    <div class="invalid-feedback">
                        Please enter Brand.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" name="model" required>
                    <div class="invalid-feedback">
                        Please enter Model.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="vehiclelicense" class="form-label">Vehicle License</label>
                    <input type="text" class="form-control" name="vehiclelicense" required>
                    <div class="invalid-feedback">
                        Please enter Vehicle License.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="placard" class="form-label">Placard #</label>
                    <input type="text" class="form-control" name="placard" required>
                    <div class="invalid-feedback">
                        Please enter placard #.  
                    </div>
                </div> 
                <div class="col-md-6">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" required>
                    <div class="invalid-feedback">
                        Please enter Color.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="date" class="form-label">Date Register</label>
                    <input type="date" class="form-control" name="date" required>
                    <div class="invalid-feedback">
                        Please enter Date Register.  
                    </div>
                </div> 	
                            <x-primary-button type="submit">{{ __('Create Owner') }}</x-primary-button>
                    </form>    
                    
                    
                
        <button onclick="closeModal()" class="up">Close Modal</button>
            </div>
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
    $(document).ready(function () {
        $('#yourDataTableID').DataTable();
    });
</script>




        <script>
                function openModal() {
                    document.getElementById('myModal').style.display = 'flex';
                }

                function closeModal() {
                    document.getElementById('myModal').style.display = 'none';
                }

                // Close the modal if the overlay is clicked
                window.onclick = function (event) {
                    if (event.target === document.getElementById('myModal')) {
                        closeModal();
                    }
                };
            </script>



            
        
</x-app-layout> 
