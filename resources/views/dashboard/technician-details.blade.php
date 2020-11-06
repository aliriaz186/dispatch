@extends('dashboard.layout')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <form action="#" method="POST" id="listing_form" class="form-horizontal listing_form">
            {{ csrf_field() }}

            <div class="row" style="margin-bottom: 10px!important;">
                <div  class="col-xl-12 order-lg-12 order-xl-12">
{{--                    <div>--}}
{{--                        <a style="float: right" href="{{env('APP_URL')}}/technicians/{{$technician->id}}/jobs/new"--}}
{{--                             class="btn btn-brand btn-elevate btn-icon-sm">--}}
{{--                            <i class="la la-plus"></i>--}}
{{--                            Add Claim--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 order-lg-6 order-xl-6">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-user"></i>
                            </span>
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    {{$technician->name}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Company Info
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><i class="fas fa-user mr-1"></i> {{$technician->name}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><i class="fas flaticon-email mr-1"></i>  {{$technician->email}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><i class="fas fa-phone mr-1"></i> {{$technician->phone}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><i class="fas fa-location-arrow mr-1"></i>  {{$technician->address}} </p>
                                </div>
                                <div class="col-lg-12">
                                    <p><i class="fas flaticon2-website mr-1"></i>  {{$technician->website}} </p>
                                </div>
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
                                        @if(count($technicianFiles) != 0)
                                        @foreach($technicianFiles as $file)
                                            <div style="margin-left: 10px">
                                                <img style="object-fit: cover;border: 1px solid #a9a9a973;width: 200px;height: 200px;"
                                                     src="{{asset('technician-files')}}/{{$file->file}}">
                                            </div>
                                        @endforeach
                                        @else
                                            <p>No Files Attached</p>
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
                                <i class="kt-font-brand fas fa-cog"></i>
                            </span>
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Settings
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile" style="display: none">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    User
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
                    <div class="kt-portlet kt-portlet--mobile" style="display: none">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Activity
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
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Open Claims
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p> Total Open Claims : <span style="font-weight: 500;">{{$openJobsCount}}</span> </p>
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
                                                style="font-weight: 500">Rating:</span> {{$item->rating}} out of 5
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
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Service Area Coverage
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($zipCode) != 0)
                                    @foreach($zipCode as $zip)
                                    <p> {{$zip->zip_code}} </p>
                                    @endforeach
                                    @else
                                        <p>No zip code added</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title text-uppercase">
                                    Selected Work Types
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($workType) != 0)
                                    @foreach($workType as $types)
                                        <p> {{$types->type}} </p>
                                    @endforeach
                                    @else
                                        <p>No work type selected</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <p id="long" style="display: none">{{$technician->longg}}</p>
        <p id="lat" style="display: none">{{$technician->lat}}</p>
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
