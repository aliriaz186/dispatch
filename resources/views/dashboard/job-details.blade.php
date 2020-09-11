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
                                    @if(!empty($ratings->rating))
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
                                    <p><span style="font-weight: 500">City:</span> {{$job->city}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><span style="font-weight: 500">Estate:</span> {{$job->estate}} </p>
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
                                    Claim Location
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p> {{$job->job_address}} </p>
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
                                    <p><span style="font-weight: 500">First:</span> {{$job->customer_availability_one}} </p>
                                    <p><span style="font-weight: 500">Second:</span> {{$job->customer_availability_two}} </p>
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

        </form>
        <p id="long" style="display: none">{{$job->long}}</p>
        <p id="lat" style="display: none">{{$job->lat}}</p>
        <script>
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

@endsection
