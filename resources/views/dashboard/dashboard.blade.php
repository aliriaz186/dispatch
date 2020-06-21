@extends('dashboard.layout')
<!-- begin:: Content -->
@section('content')
 <div class="row">
     <div class="col-xl-2 col-lg-2 order-lg-2 order-xl-1 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                        Total Technicians
                     </h3>
                 </div>
                <h3 class="text-center">{{$technicianCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-2 col-lg-2 order-lg-2 order-xl-1 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Total Jobs
                     </h3>
                 </div>
                 <h3 class="text-center">{{$jobsCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-2 col-lg-2 order-lg-2 order-xl-1 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Total Customers
                     </h3>
                 </div>
                 <h3 class="text-center">{{$customersCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-2 col-lg-2 order-lg-2 order-xl-1 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Coming Soon
                     </h3>
                 </div>
                 <h3 class="text-center">0</h3>
             </div>
         </div>
     </div>
 </div>
@endsection
