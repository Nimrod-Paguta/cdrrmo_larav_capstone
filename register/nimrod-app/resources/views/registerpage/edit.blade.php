<x-app-layout>


<form class="row g-3 needs-validation" method="post" action="{{ route('registerpage.update', ['id' => $registers->id]) }}">
    @method('PUT')
    @csrf
    <!-- Your form fields here -->

       
    <div class="col-md-4">
                                <label for="name" class="form-label naog">First Name</label>
                                <input type="text" class="form-control" name="name"  value="{{ $registers->name }}"  required>
                                <div class="invalid-feedback">
                                    Please enter a valid first name.
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" value="{{ $registers->middlename }}" name="middlename">
                                <div class="invalid-feedback">
                                    Please enter a valid middle name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" value="{{ $registers->lastname }}" name="lastname" required>
                                <div class="invalid-feedback">
                                    Please enter a valid last name.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Barangay</label>
                                <input type="text" class="form-control" value="{{ $registers->barangay }}" name="barangay" required>
                                <div class="invalid-feedback">
                                    Please enter barangay. 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Municipality/City</label>
                                <input type="text" class="form-control" value="{{ $registers->municipality }}" name="municipality" required>
                                <div class="invalid-feedback">
                                    Please enter Municipality or City.  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Province</label>
                                <input type="text" class="form-control" value="{{ $registers->province }}" name="province" required>
                                <div class="invalid-feedback">
                                    Please enter Province.  
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" value="{{ $registers->contactnumber }}" name="contactnumber" required>
                                <div class="invalid-feedback">
                                    Please enter Contact Number.  
                                </div>
                            </div>
                            
                            

                    <h3>Vehicle Information</h3>
                
                                        
                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control" value="{{ $registers->brand }}" name="brand" required>
                    <div class="invalid-feedback">
                        Please enter Brand.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" value="{{ $registers->model }}" name="model" required>
                    <div class="invalid-feedback">
                        Please enter Model.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="vehiclelicense" class="form-label">Vehicle License</label>
                    <input type="text" class="form-control" value="{{ $registers->vehiclelicense }}" name="vehiclelicense" required>
                    <div class="invalid-feedback">
                        Please enter Vehicle License.  
                    </div>
                </div> 

                <div class="col-md-6">
                    <label for="placard" class="form-label">Placard #</label>
                    <input type="text" class="form-control" value="{{ $registers->placard }}" name="placard" required>
                    <div class="invalid-feedback">
                        Please enter placard #.  
                    </div>
                </div> 
                <div class="col-md-6">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" value="{{ $registers->color}}" name="color" required>
                    <div class="invalid-feedback">
                        Please enter Color.  
                    </div>
                </div> 

                <div class="col-md-6">
    <label for="date" class="form-label">Date Register</label>
    <input type="date" class="form-control" value="{{ $registers->date }}" name="date" required readonly>
    <div class="invalid-feedback">
        Please enter Date Register.  
    </div>
</div>

                            <x-primary-button type="submit">{{ __('Update') }}</x-primary-button>
</form>


</x-app-layout>