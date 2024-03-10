<x-app-layout>

<link href="css/serch.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


   <!-- Search form with design -->
   <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Search...">
        <button id="searchButton" class="search-btn">Search</button>
    </div>

    
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
        

        
       <!-- Table with Bootstrap classes -->
<table id="dataTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Status</th>
            <th>Id</th>
            <th>Name</th>
            <th>Barangay</th>
            <th>Municipality</th>
            <th>Province</th>
            <th>Contact Number</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Vehicle License</th>
            <th>Placard</th>
            <th>Color</th>
            <th>Date Register</th>
            <th>Action</th>  
        </tr>
    </thead>
    <tbody>
        @foreach($registers as $register)
        <tr>
            <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
            <td>{{ $register->id }}</td>
            <td>{{ $register->name }}</td>
            <td>{{ $register->barangay }}</td>
            <td>{{ $register->municipality }}</td>
            <td>{{ $register->province }}</td>
            <td>{{ $register->contactnumber }}</td>
            <td>{{ $register->brand }}</td>
            <td>{{ $register->model }}</td>
            <td>{{ $register->vehiclelicense }}</td>
            <td>{{ $register->placard }}</td>
            <td>{{ $register->color }}</td>
            <td>{{ $register->date }}</td>
            <td>
                <!-- Add any action buttons or links you need -->
                <a href="#" class="btn btn-primary">View</a>
                <a href="#" class="btn btn-secondary">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
        <div id="pagination">
            <button id="prev-button" class="icon disabled-icon" style = "margin-right: 20px">Prev</button>
            <span id="page-info" style = "margin-right: 10px"> 1-10 of 9</span>
            <button id="next-button" class="icon">Next</button>
        </div>



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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <!-- Initialize DataTable -->
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>



        <script>
            const table = document.querySelector('table');
            const tbody = table.querySelector('tbody');
            const rowsPerPage = 10; // Set rows per page
            const pageInfo = document.getElementById('page-info');
            const prevButton = document.getElementById('prev-button'); 
            const nextButton = document.getElementById('next-button');

            let currentPage = 1;
            let rows = tbody.querySelectorAll('tr');

            function showPage(page) {
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }

            for (let i = startIndex; i < endIndex && i < rows.length; i++) {
                rows[i].style.display = '';
            }

            pageInfo.textContent = ${startIndex + 1}-${endIndex} of ${rows.length};

            prevButton.classList.remove('disabled-icon');
            nextButton.classList.remove('disabled-icon');

            if (page === 1) {
                prevButton.classList.add('disabled-icon');
            }

            if (page === Math.ceil(rows.length / rowsPerPage)) {
                nextButton.classList.add('disabled-icon');
            }
            }

            showPage(currentPage);

            nextButton.addEventListener('click', () => {
            if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
                currentPage++;
                showPage(currentPage);
            }
            });

            prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
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