@extends('dashboard.layout')
<!-- begin:: Content -->
@section('content')
 <div class="row">
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                        Total Service Providers
                     </h3>
                 </div>
                <h3 class="text-center">{{$technicianCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Total Claims
                     </h3>
                 </div>
                 <h3 class="text-center">{{$jobsCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
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
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Total Open Claims <br><span style="font-size: 17px;">(Open over 48 hours)</span>
                     </h3>
                 </div>
                 <h3 class="text-center">{{$totalOpenClaimsCount}}+</h3>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Total Completed Claims
                     </h3>
                 </div>
                 <div class="d-flex" style="margin: 0 auto;width: fit-content;font-weight: 500">
                     <div class="text-center" style="font-size: 17px;"><span
                             style="font-size: 16px;">Today</span><br><br>{{$totalTodayCompletedClaims}}+
                     </div>
                     <div class="text-center ml-2" style="font-size: 17px;"><span
                             style="font-size: 16px;">Week</span><br><br>{{$totalThisWeekCompletedClaims}}+
                     </div>
                     <div class="text-center ml-2" style="font-size: 17px;"><span
                             style="font-size: 16px;">Month</span><br><br>{{$totalThisMonthCompletedClaims}}+
                     </div>
                     <div class="text-center ml-2" style="font-size: 17px;"><span
                             style="font-size: 16px;">Year</span><br><br>{{$totalThisYearCompletedClaims}}+
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-xl-3 col-lg-3 order-lg-3 order-xl-2 ml-3">
         <div class="kt-portlet kt-portlet--height-fluid">
             <div class="kt-widget14">
                 <div class="kt-widget14__header kt-margin-b-30">
                     <h3 class="text-center">
                         Denied Claims
                     </h3>
                 </div>
                 <h3 class="text-center">{{$deniedClaimsCount}}+</h3>
             </div>
         </div>
     </div>
 </div>
@endsection
