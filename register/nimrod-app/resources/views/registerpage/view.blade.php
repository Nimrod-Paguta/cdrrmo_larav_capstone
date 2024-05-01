<x-app-layout>
  <style>


  </style>
<div class = "hayt">
<button type="button" class="btn btn-outline-primary ms-1" onclick="window.open('/individualreport/{{ $register->id }}', '_blank')">
    <i class="fas fa-download fa-sm text-white-70"></i>
      Generate Report
</button>

 
 
 <div class="row" style="margin-top: 15px;">
   <div class="col-lg-4">
     <div class="card mb-4">
       <div class="card-body text-center">
       <center>
                            @if($register->gender == 'Male')
                                <img src="{{ asset('img/register/man.png') }}" style="width: 300px; height: 250px;">
                            @elseif($register->gender == 'Female')
                                <img src="{{ asset('img/register/woman.png') }}" style="width: 300px; height: 250px;">
                            @endif
                        </center>
         <h5 class="my-3">{{ $register->name }}</h5>
         <p class="text-muted mb-1">Registered Driver of CDRRMO</p>
         <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
         <div class="d-flex justify-content-center mb-2">
         
         
         </div>
       </div>
     </div>
   
   </div>
   
   <div class="col-lg-8">
   <h3>Owner's Profile</h3>
     <div class="card mb-4">
       <div class="card-body">
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Vehicle Owner:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->name }} {{ $register->middlename }} {{ $register->lastname }}</p>
           </div>
         </div>
         <hr>

         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Gender:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->gender }}</p>
           </div>
         </div>
         <hr>

         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Email:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->email }}</p>
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
             <p class="mb-0">Emergency Number:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->emergencynumber }}</p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <p class="mb-0">Medical Condition:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->medicalcondition ? $register->medicalcondition : "None" }}</p>
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
             <p class="mb-0">Vehicle Type:</p>
           </div>
           <div class="col-sm-9">
             <p class="text-muted mb-0">{{ $register->type }}</p>
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
             <p class="text-muted mb-0">{{ $register->created_at }}</p>
           </div>
         </div>
         
       </div>
     </div>
    
   </div>
 </div>
</div>
</section>

</div>

</x-app-layout>