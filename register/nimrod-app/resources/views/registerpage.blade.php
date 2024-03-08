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
        <table>
            <thead>
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
                <a  href="{{ route('registerpage.edit', ['id' => $register->id]) }}">edit</a>
                <a  href="{{ route('registerpage.view', ['id' => $register->id]) }}">edit</a>
              

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

            pageInfo.textContent = `${startIndex + 1}-${endIndex} of ${rows.length}`;

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

<script>
    $(document).ready(function () {
        const table = document.querySelector('table');
        const tbody = table.querySelector('tbody');
        const rowsPerPage = 10;
        const pageInfo = document.getElementById('page-info');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const searchInput = document.getElementById('searchInput');
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

            pageInfo.textContent = `${startIndex + 1}-${endIndex} of ${rows.length}`;

            prevButton.classList.remove('disabled-icon');
            nextButton.classList.remove('disabled-icon');

            if (page === 1) {
                prevButton.classList.add('disabled-icon');
            }

            if (page === Math.ceil(rows.length / rowsPerPage)) {
                nextButton.classList.add('disabled-icon');
            }
        }

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();

            rows = tbody.querySelectorAll('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].querySelectorAll('td');
                let rowText = '';

                cells.forEach((cell) => {
                    rowText += cell.textContent.toLowerCase() + ' ';
                });

                if (rowText.includes(searchTerm)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }

            currentPage = 1;
            showPage(currentPage);
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

        searchInput.addEventListener('input', filterTable);
    });
</script>

            
        
</x-app-layout> 
