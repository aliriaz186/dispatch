@extends('dashboard.layout')
<!-- begin:: Content -->
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 1-->

        <!--Begin::Row-->
        <form action="#" method="POST" id="listing_form" class="form-horizontal listing_form">
            {{ csrf_field() }}
            <input type="hidden" id="jobId" value="{{$job->id}}">
            <div class="row">

                <div class="col-xl-6 order-lg-6 order-xl-6">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-briefcase"></i>
                            </span>
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    {{$job->title}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    @if(\App\DispatchJob::where('id', $job->id)->first()['status'] == 'Follow Up')
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                   Claim Follow Up
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Reason:</span> {{$followUp->reason}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary" type="button"
                                            style="background-color: #f48134!important;border-color: #f48134!important;color: white!important;"
                                            onclick="followUpClaimApprove()">Approve Claim
                                    </button>
                                    <button class="btn btn-primary" type="button"
                                            style="background-color: #0780b7!important;border-color: #0780b7!important;color: white!important;"
                                            onclick="followUpClaimDenied()">Deny Claim
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($job->status == 'Completed')
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title text-uppercase">
                                        Claim Invoice
                                    </h3>
                                </div>
                            </div>
                            @if(!\App\JobInvoices::where('job_id', $job->id)->exists())
{{--                                <div class="kt-portlet__body">--}}
{{--                                    --}}
{{--                                </div>--}}

                                <div class="kt-portlet__body">
                                    <p>No Invoice attached yet.</p>
                                    <div class="row">

                                        <label for="offer-images">Select file to upload: </label>
                                        <div class="input-group">
                                            <input id="offer-images" onclick="selectImages()" type="file"
                                                   name="images[]"
                                                   multiple/>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div style="margin-left: 10px">
                                    <a target="_blank" href="{{env('TECHNICIAN_URL')}}/new-invoices/{{\App\JobInvoices::where('job_id', $job->id)->first()['invoice']}}">
                                        <img style="padding:20px;object-fit: cover;border: 1px solid #a9a9a973;width: 200px;height: 200px;" alt="Click to Open" src="{{env('TECHNICIAN_URL')}}/new-invoices/{{\App\JobInvoices::where('job_id', $job->id)->first()['invoice']}}"></a>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if(\App\DispatchJob::where('id', $job->id)->first()['status'] == 'Completed')
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title text-uppercase">
                                        Claim Completion Status
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><span style="font-weight: 500">Issue Repaired:</span> {{$jobCompletionStatus->completion_status}} </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p><span style="font-weight: 500">Conclusion:</span> {{$jobCompletionStatus->conclusion}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title text-uppercase">
                                        Reviews
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="row">
                                    @if(count($ratings) != 0)
                                        @foreach($ratings as $item)
                                            <div class="col-lg-12">
                                                <p><span
                                                        style="font-weight: 500">Rating:</span> {{$item->rating}} out of
                                                    5
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p><span
                                                        style="font-weight: 500">Additional Comments:</span> {{$item->additional_comments}}
                                                </p>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-12">
                                            <p>No reviews yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Claim Status
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p> {{$job->status}} </p>
                                </div>
                                @if(\App\ClaimRescheduleNotHome::where('job_id', $job->id)->exists())
                                    <div class="col-lg-12">
                                    <p> We missed you, and will try you again on {{$schedule->date}} between
                                        ({{$schedule->est_time_from}} - {{$schedule->est_time_to}}) </p>
                                    </div>
                                @endif
                                @if($job->status == 'rejected')
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Reason:</span> {{\App\RejectClaimReason::where('job_id', $job->id)->first()['reason']}} </p>
                                </div>
                                @endif
                                <div class="col-lg-12" id="text-div">
                                    <p style="text-decoration: underline;color: dodgerblue;cursor: pointer" onclick="showSelectField()"> Change Status </p>
                                </div>
                                <div id="statusChangeDiv" style="display: none">
                                <div class="col-lg-12">
                                    <select name="jobStatus" id="jobStatus"
                                            class="form-control" value="{{$job->status ?? ''}}">
                                        <option selected="selected" value="">Select Status</option>
                                        <option  {{$job->status == "offered" ? 'selected' : ''}} value="offered">Offered</option>
                                        <option  {{$job->status == "unscheduled" ? 'selected' : ''}} value="unscheduled">Unscheduled</option>
                                        <option  {{$job->status == "scheduled" ? 'selected' : ''}} value="scheduled">Scheduled</option>
                                        <option  {{$job->status == "On My Way" ? 'selected' : ''}} value="On My Way">On My Way</option>
                                        <option  {{$job->status == "Job Started" ? 'selected' : ''}} value="Job Started">Job Started</option>
                                        <option  {{$job->status == "Completed" ? 'selected' : ''}} value="Completed">Completed</option>
                                        <option  {{$job->status == "Follow Up" ? 'selected' : ''}} value="Follow Up">Follow Up</option>
                                        <option  {{$job->status == "Denied" ? 'selected' : ''}} value="Denied">Denied</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button class="btn btn-primary" type="button"
                                            style="background-color: #f48134!important;border-color: #f48134!important;color: white!important;" onclick="changeStatus()">Change
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($job->status == 'scheduled' || $job->status == 'On My Way' || $job->status == 'Job Started' || $job->status == 'Completed')
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Worker Details
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Name:</span> {{$scheduledJob->name}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Email:</span> {{$scheduledJob->email}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Phone:</span> {{$scheduledJob->phone}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Claim Description
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Description:</span> {{$job->description}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Service Type:</span> {{$job->service_type}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Claim Address
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Address:</span> {{$job->job_address}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">City:</span> {{$job->city}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">State:</span> {{$job->estate}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Zip Code:</span> {{$job->zip_code}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Claims Details
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Policy No:</span> {{$job->policy_no}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Item Type:</span> {{$job->item_type}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Item Location:</span> {{$job->item_location}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Issue Details:</span> {{$job->issue_details}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Model No:</span> {{$job->model_no}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Serial No:</span> {{$job->serial_no}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Prior Issue:</span> {{$job->prior_issue}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Customer
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Name:</span> {{$customer->name}} </p>
                                    <p><span style="font-weight: 500">Email:</span> {{$customer->email}} </p>
                                    <p><span style="font-weight: 500">Phone No:</span> {{$customer->phone}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Customer Availability
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">First:</span>
                                        @if(!empty($job->customer_availability_one))
                                            {{date('Y-m-d h:i A', strtotime($job->customer_availability_one)) ?? ''}}
                                        @endif
                                    </p>
                                    <p><span style="font-weight: 500">Second:</span>
                                        @if(!empty($job->customer_availability_two))
                                            {{date('Y-m-d h:i A', strtotime($job->customer_availability_two)) ?? ''}}
                                        @endif
                                    </p>
{{--                                    <p><span style="font-weight: 500">Third:</span> {{$job->customer_availability_three}} </p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Providers
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <p style="text-decoration: underline;color: dodgerblue;cursor: pointer" data-toggle="modal" data-target="#exampleModal"> Change Provider </p>
                            @if(!empty($technician->name))
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Name:</span> {{$technician->name}} </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Email:</span> {{$technician->email}} </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Phone:</span> {{$technician->phone}} </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Address:</span> {{$technician->address}} </p>
                                </div>
                            </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><span style="font-weight: 500">Not Assigned Yet</span></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Notes
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p> {{$job->notes}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Attachments
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-wrap">
                                        @if(count($jobImages) != 0)
                                            @foreach($jobImages as $images)
                                                <div style="margin-left: 10px">
                                                    <img style="object-fit: cover;border: 1px solid #a9a9a973;width: 200px;height: 200px;"
                                                         src="{{asset('job-files')}}/{{$images->image}}">
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No Images Attached</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 order-lg-6 order-xl-6">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-briefcase"></i>
                            </span>
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Claim Location ({{$job->job_address}})
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg" style="padding: 0px !important;">
                            <div class="kt-portlet__head-label">
                            </div>
                                <div id="map" style="height:541px!important;width:100%;"></div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile" style="display: none">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Activity of Claim
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p> Comming Soon </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Technician</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
{{--                            <form method="post" action="" enctype="multipart/form-data">--}}
                                <input id="job_id" name="job_id" value="{{$job->id}}" type="hidden">
                            <h3>we are now showing providers near to the zip code of job!</h3>
                                <select name="technician_id" id="technician_id"
                                        class="form-control">
                                    <option value="">Select Technician</option>
{{--                                    @foreach(\App\Technician::all() as $item)--}}
{{--                                        <option value="{{$item->id}}">{{$item->name}} |--}}
{{--                                            <ul style="float: right">--}}
{{--                                                @foreach(\App\TechnicianWorkType::all() as $items)--}}
{{--                                                    <li>{{$items->type}} ,</li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
                                    @foreach($selectedProviders as $item)
                                        <option value="{{$item->id}}">{{$item->name}} |
                                            <ul style="float: right">
                                                @foreach($item['work_types'] as $items)
                                                    <li>{{$items->type}} ,</li>
                                                @endforeach
                                            </ul>
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    <button type="button" id="send-email-btn" class="btn btn-success"
                                            style="background-color: #0780b7!important;border-color: #0780b7;color: white;margin-top: 15px;border: none!important;" onclick="changeTechnician()">Change Technician
                                    </button>
                                </div>
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <p id="long" style="display: none">{{$job->long}}</p>
        <p id="lat" style="display: none">{{$job->lat}}</p>
        <script>

            function changeTechnician()
            {
                let data = new FormData();
                let jobId = document.getElementById('job_id').value;
                let jobStatus = document.getElementById('technician_id').value;
                data.append("_token", "{{ csrf_token() }}");
                data.append("technician_id", jobStatus);
                data.append("job_id", jobId);
                KTApp.blockPage({
                    baseZ: 2000,
                    overlayColor: '#000000',
                    type: 'v1',
                    state: 'danger',
                    opacity: 0.15,
                    message: 'Processing...'
                });
                $.ajax({
                    url: "{{env('APP_URL')}}/change/claim/technician",
                    type: 'POST',
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        if (result['status']) {
                            // Disable Page Loading and show confirmation
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": "Technician Changed Successfully!",
                                    "type": "success",
                                    "showConfirmButton": false,
                                    "timer": 1500,
                                    "onClose": function (e) {
                                        window.location.reload();
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": result['message'],
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary",
                                    "onClose": function (e) {
                                        console.log('on close event fired!');
                                    }
                                })
                            }, 2000);
                        }
                    }
                });
            }

            function showSelectField()
            {
                document.getElementById('statusChangeDiv').style.display = 'Block';
                document.getElementById('text-div').style.display = 'none';
            }
            function changeStatus()
            {
                let data = new FormData();
                let jobId = document.getElementById('jobId').value;
                let jobStatus = document.getElementById('jobStatus').value;
                data.append("_token", "{{ csrf_token() }}");
                data.append("jobStatus", jobStatus);
                data.append("jobId", jobId);
                KTApp.blockPage({
                    baseZ: 2000,
                    overlayColor: '#000000',
                    type: 'v1',
                    state: 'danger',
                    opacity: 0.15,
                    message: 'Processing...'
                });
                $.ajax({
                    url: "{{env('APP_URL')}}/claim/status/change",
                    type: 'POST',
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        if (result['status']) {
                            // Disable Page Loading and show confirmation
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": "Claim Status Changed Successfully!",
                                    "type": "success",
                                    "showConfirmButton": false,
                                    "timer": 1500,
                                    "onClose": function (e) {
                                        window.location.reload();
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": result['message'],
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary",
                                    "onClose": function (e) {
                                        console.log('on close event fired!');
                                    }
                                })
                            }, 2000);
                        }
                    }
                });
            }
        </script>
        <script>
            function followUpClaimApprove()
            {
                // alert('hi')
                // e.preventDefault();
                let data = new FormData();
                let jobId = document.getElementById('jobId').value;
                data.append("_token", "{{ csrf_token() }}");
                data.append("jobId", jobId);
                KTApp.blockPage({
                    baseZ: 2000,
                    overlayColor: '#000000',
                    type: 'v1',
                    state: 'danger',
                    opacity: 0.15,
                    message: 'Processing...'
                });
                $.ajax({
                    url: "{{env('APP_URL')}}/followup/claim/approve",
                    type: 'POST',
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        if (result['status']) {
                            // Disable Page Loading and show confirmation
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": "Claim Approved Successfully!",
                                    "type": "success",
                                    "showConfirmButton": false,
                                    "timer": 1500,
                                    "onClose": function (e) {
                                        window.location.reload();
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": result['message'],
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary",
                                    "onClose": function (e) {
                                        console.log('on close event fired!');
                                    }
                                })
                            }, 2000);
                        }
                    }
                });
            }
        </script>
        <script>
            function followUpClaimDenied()
            {
                // alert('hi')
                // e.preventDefault();
                let data = new FormData();
                let jobId = document.getElementById('jobId').value;
                data.append("_token", "{{ csrf_token() }}");
                data.append("jobId", jobId);
                KTApp.blockPage({
                    baseZ: 2000,
                    overlayColor: '#000000',
                    type: 'v1',
                    state: 'danger',
                    opacity: 0.15,
                    message: 'Processing...'
                });
                $.ajax({
                    url: "{{env('APP_URL')}}/followup/claim/denied",
                    type: 'POST',
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        if (result['status']) {
                            // Disable Page Loading and show confirmation
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": "Claim denied Successfully",
                                    "type": "success",
                                    "showConfirmButton": false,
                                    "timer": 1500,
                                    "onClose": function (e) {
                                        window.location.reload();
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": result['message'],
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary",
                                    "onClose": function (e) {
                                        console.log('on close event fired!');
                                    }
                                })
                            }, 2000);
                        }
                    }
                });
            }
        </script>
        <script>
            let marker = false; ////Has the user plotted their location marker?
            let lati = parseFloat(document.getElementById('lat').innerText);
            let longi = parseFloat(document.getElementById('long').innerText);
            let map, infoWindow, geocoder;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: {lat: lati, lng: longi}
                });
                geocoder = new google.maps.Geocoder;
                infoWindow = new google.maps.InfoWindow;
                let clickedLocation = {lat: lati, lng: longi};
                if(marker === false){
                    marker = new google.maps.Marker({
                        position: clickedLocation,
                        map: map,
                        title : "Job Location"
                    });
                } else{
                    marker.setPosition(clickedLocation);
                }

            }

        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJqJcwaHOlWKivApYFYSjmVobGeKFqGdE&callback=initMap">
        </script>
    </div>
    <script>

        $(document).ready(function () {
            KTApp.blockPage({
                baseZ: 2000,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Loading Please Wait...'
            });
            setTimeout(function () {
                KTApp.unblockPage();
            }, 3000);

            $(function () {
                // Initialize form validation.
                $(".listing_form").validate({
                    // Specify validation rules
                    rules: {
                        name: {required: true},
                        email: {email: true, required: true},
                        phone: {required: true, minlength: 10},

                    },
                    // Specify validation error messages
                    messages: {
                        name: "Please enter name",
                        email: "Please enter email address",
                        phone: {
                            required: "Please provide a phone number",
                            minlength: "Your phone number must be 10 characters long"
                        },
                    },
                    // Invalid Handler message
                    invalidHandler: function (event, validator) {
                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                            "onClose": function (e) {
                                console.log('on close event fired!');
                            }
                        })
                    },
                    // Here we submit the completed form to database
                    submitHandler: function (form, e) {
                        // Enable Page Loading
                        KTApp.blockPage({
                            baseZ: 2000,
                            overlayColor: '#000000',
                            type: 'v1',
                            state: 'danger',
                            opacity: 0.15,
                            message: 'Processing...'
                        });
                        var form = $('.listing_form');
                        var data = form.serializeArray();
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        $.ajax({
                            url: "{{env('APP_URL')}}/customer/update",
                            type: 'POST',
                            dataType: "JSON",
                            data: data,
                            success: function (result) {
                                if (result['status']) {
                                    // Disable Page Loading and show confirmation
                                    setTimeout(function () {
                                        KTApp.unblockPage();
                                    }, 1000);
                                    setTimeout(function () {
                                        swal.fire({
                                            "title": "",
                                            "text": "Saved Successfully",
                                            "type": "success",
                                            "showConfirmButton": false,
                                            "timer": 1500,
                                            "onClose": function (e) {
                                                window.location.href = `{{env('APP_URL')}}/customers`
                                            }
                                        })
                                    }, 2000);
                                } else {
                                    setTimeout(function () {
                                        KTApp.unblockPage();
                                    }, 1000);
                                    setTimeout(function () {
                                        swal.fire({
                                            "title": "",
                                            "text": result['message'],
                                            "type": "error",
                                            "confirmButtonClass": "btn btn-secondary",
                                            "onClose": function (e) {
                                                console.log('on close event fired!');
                                            }
                                        })
                                    }, 2000);
                                }
                            }
                        });
                    }
                });
            });

        });

    </script>

<script>
    function selectImages() {
    if (window.File && window.FileList && window.FileReader) {
    var filesInput = document.getElementById("offer-images");

    filesInput.addEventListener("change", function (event) {
    var files = [];
    files = event.target.files; //FileList object
    var output = document.getElementById("result");
    for (var i = 0; i < files.length; i++) {
    var file = files[i];

    //Only pics
    if (!file.type.match('image'))
    continue;

    var picReader = new FileReader();

    picReader.addEventListener("load", function (event) {

    var picFile = event.target;

    var div = document.createElement("span");

    div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
    "title='" + picFile.name + "'/>";

    output.insertBefore(div, null);

    });

    //Read the image
    picReader.readAsDataURL(file);
    }
    KTApp.blockPage({
    baseZ: 2000,
    overlayColor: '#000000',
    type: 'v1',
    state: 'danger',
    opacity: 0.15,
    message: 'Processing...'
    });
    var offerImages = document.getElementById('offer-images').files;

        let formData = new FormData();
        for (var i = 0; i < offerImages.length; i++) {
            formData.append("offer_images[]", offerImages[i]);
        }
        let jobId = document.getElementById('jobId').value;
        formData.append("jobId", jobId);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax
        ({
            type: 'POST',
            url: `{{env('TECHNICIAN_URL')}}/api/job/invoice/save`,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                setTimeout(function () {
                    KTApp.unblockPage();
                }, 1000);
                setTimeout(function () {
                    swal.fire({
                        "title": "",
                        "text": "Saved Successfully",
                        "type": "success",
                        "showConfirmButton": false,
                        "timer": 1500,
                        "onClose": function (e) {
                            setTimeout(function () {
                                KTApp.unblockPage();
                            }, 1000);
                            window.location.reload();
                        }
                    })
                }, 2000);
            },
            error: function (data) {
                checkBoxesArray = [];
                setTimeout(function () {
                    KTApp.unblockPage();
                }, 1000);
                setTimeout(function () {
                    swal.fire({
                        "title": "",
                        "text": result['message'],
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary",
                        "onClose": function (e) {
                            console.log('on close event fired!');
                        }
                    })
                }, 2000);
            }
        });

    });
    } else {
        console.log("Your browser does not support File API");
    }
    }</script>
@endsection
