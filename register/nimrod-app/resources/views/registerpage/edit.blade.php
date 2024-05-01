<x-app-layout>

<style>
    .hayt{
        height: 100vh;
    }

</style>
<div class = "hayt">
    
<h2>Update Information</h2>
@role('admin')
<button type="button" class="btn btn-outline-primary ms-1 mb-3" onclick="window.location.href='/registerpage'">Back</button>
@endrole
@role('driver')
<button type="button" class="btn btn-outline-primary ms-1 mb-3" onclick="window.location.href='/dashboard'">Back</button>
@endrole



<div id="update-form-div">
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
                            <label for="type" class="form-label">Gender</label>
                            <select class="form-control" value="{{ $registers->gender}}" name="gender" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <!-- Add more options as needed -->
                            </select>
                            <div class="invalid-feedback">
                                Please select a Type.  
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

                        <div class="col-md-4">
                            <label for="postal_code" class="form-label">Contact Number</label>
                            <input type="number" class="form-control" value="{{ $registers->contactnumber }}" name="contactnumber" required>
                            <div class="invalid-feedback">
                                Please enter Contact Number.  
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="emergencynumber" class="form-label">Emergency Number</label>
                            <input type="number" class="form-control" value="{{ $registers->emergencynumber }}" name="emergencynumber" required>
                            <div class="invalid-feedback">
                                Please enter Emergency Number.  
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="medicalcondition" class="form-label">Medical Condition (specify)</label>
                            <input type="text" class="form-control" value="{{ $registers->medicalcondition }}" name="medicalcondition">
                        </div>
                                          
            <div class="col-md-4">
                <label for="brand" class="form-label">Vehicle Brand</label>
                <input type="text" class="form-control" value="{{ $registers->brand }}" name="brand" required>
                <div class="invalid-feedback">
                    Please enter Brand.  
                </div>
            </div> 

            <div class="col-md-4">
                <label for="model" class="form-label">Vehicle Model</label>
                <input type="text" class="form-control" value="{{ $registers->model }}" name="model" required>
                <div class="invalid-feedback">
                    Please enter Model.  
                </div>
            </div> 

            <div class="col-md-4">
                <label for="vehiclelicense" class="form-label">Vehicle License</label>
                <input type="text" class="form-control" value="{{ $registers->vehiclelicense }}" name="vehiclelicense" required>
                <div class="invalid-feedback">
                    Please enter Vehicle License.  
                </div>
            </div> 

            <div class="col-md-4">
                <label for="color" class="form-label">Vehicle Color</label>
                <input type="text" class="form-control" value="{{ $registers->color}}" name="color" required>
                <div class="invalid-feedback">
                    Please enter Color.  
                </div>
            </div> 

            <div class="col-md-4">
                <label for="type" class="form-label">Vehicle Type</label>
                <select class="form-control" value="{{ $registers->type}}" name="type" required>
                    <option value=""></option>
                    <option value="Private">Private</option>
                    <option value="Public">Public</option>
                    <!-- Add more options as needed -->
                </select>
                <div class="invalid-feedback">
                    Please select a Type.  
                </div>
            </div>
<div id="edit-button-div">
<x-primary-button type="submit" id="edit-button">{{ __('Update') }}</x-primary-button>
</div>

                       
</form>


</div>


</div>
</x-app-layout>