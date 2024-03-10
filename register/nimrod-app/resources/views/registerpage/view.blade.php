<x-app-layout>
<button type="button" class="btn btn-outline-primary ms-1">Back</button>
 
    <center>Driver's Profile</center>
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
             style="width: 350px;">
            <h5 class="my-3">{{ $register->name }}</h5>
            <p class="text-muted mb-1">Registered Driver of CDRRMO</p>
            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
            <div class="d-flex justify-content-center mb-2">
            
            
            </div>
          </div>
        </div>
      
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->barangay }}, {{ $register->municipality }}, {{ $register->province }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone Number:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->contactnumber }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Brand</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->brand }}</p>
              </div>
            </div>
            
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Model:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->model }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Vehicle License:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->vehiclelicense }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Placard:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->placard }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Color:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->color }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date Registered:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $register->date }}</p>
              </div>
            </div>
            
          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>


</x-app-layout>