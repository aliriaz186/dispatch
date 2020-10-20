@extends('dashboard.layout')
<!-- begin:: Content -->
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 1-->

        <!--Begin::Row-->
        <form action="#" method="POST" id="listing_form" class="form-horizontal listing_form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xl-4 order-lg-4 order-xl-4">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-briefcase"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    New Claim
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="col-lg-12">
                                <label>Claim Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span></div>
                                    <input type="text" name="address" id="address" readonly
                                           class="form-control" placeholder="Please Select From Map" onchange="addressEntered(this.value)">
{{--                                    <input type="text" name="technician_id" id="technician_id"--}}
{{--                                           class="form-control" style="display: none">--}}
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>City <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span></div>
                                    <input type="text" name="city" id="city"
                                           class="form-control" placeholder="Enter city">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>State <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span></div>
                                    <input type="text" name="estate" id="estate"
                                           class="form-control" placeholder="Enter estate">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Zip Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
                                    {{--                                                class="fas fa-map-marker-alt"></i></span></div>--}}
                                    <input type="text" name="zipCode" id="zipCode"
                                           class="form-control" placeholder="Enter zip code">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label class="">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Enter full name">
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Customer Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-envelope"></i></span></div>
                                    <input type="text" name="email" id="email"
                                           class="form-control"
                                           placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Customer Phone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-phone"></i></span></div>
                                    <input type="text" name="phone" id="phone"
                                           class="form-control"
                                           placeholder="Enter phone">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Policy No <span class="text-danger">*</span></label>
                                <div class="input-group">
{{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                class="fas fa-map-marker-alt"></i></span></div>--}}
                                    <input type="text" name="policyNo" id="policyNo"
                                           class="form-control" placeholder="Enter policy no">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Item Type <span class="text-danger">*</span></label>
                                <div class="input-group">
{{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                class="fas fa-map-marker-alt"></i></span></div>--}}
                                    <input type="text" name="itemType" id="itemType"
                                           class="form-control" placeholder="Enter item type">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Item Location <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fas fa-map-marker-alt"></i></span></div>
                                    <input type="text" name="itemLocation" id="itemLocation"
                                           class="form-control" placeholder="Enter item location">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Issue Details <span class="text-danger">*</span></label>
                                <div class="input-group">
{{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                class="fas fa-map-marker-alt"></i></span></div>--}}
                                    <input type="text" name="issueDetails" id="issueDetails"
                                           class="form-control" placeholder="Enter issue details">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Model No </label>
                                <div class="input-group">
{{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                class="fas fa-map-marker-alt"></i></span></div>--}}
                                    <input type="text" name="modelNo" id="modelNo"
                                           class="form-control" placeholder="Enter model no">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Serial No </label>
                                <div class="input-group">
{{--                                    <div class="input-group-prepend"><span class="input-group-text"></span></div>--}}
                                    <input type="text" name="serialNo" id="serialNo"
                                           class="form-control" placeholder="Enter serial no">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Prior Issue <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="row col-lg-12 mt-1">
                                        <input id="priorIssueYes" name="priorIssue" type="radio"><span style="margin-top: -3px;margin-left: 6px;">Yes</span>
                                        <input id="priorIssueNo" name="priorIssue" style="margin-left: 18px" type="radio"><span style="margin-top: -3px;margin-left: 6px;">No</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px !important;">
                                <label>Technician </label>
                                <div class="input-group">
                                    <select name="technician_id" id="technician_id"
                                            class="form-control">
                                        <option value="">Select Technician</option>
                                        @foreach($technicianList as $item)
                                            <option value="{{$item->id}}">{{$item->name}} |
                                                <ul style="float: right">
                                                    @foreach(\App\TechnicianWorkType::all() as $items)
                                                        <li>{{$items->type}} ,</li>
                                                    @endforeach
                                                </ul>
                                            </option>
                                        @endforeach
                                    </select>
{{--                                    <input type="text" name="technician_name" id="technician_name"--}}
{{--                                           class="form-control" placeholder="Select nearby provider from map" readonly>--}}
{{--                                    <input type="text" name="technician_id" id="technician_id"--}}
{{--                                           class="form-control" style="display: none">--}}
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label class="">Claim Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                       placeholder="Enter job title">
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label class="">Claim Description <span class="text-danger">*</span></label>
                                <input type="text" name="description" id="description" class="form-control"
                                       placeholder="Enter job description">
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label class="">Claim Service Type <span class="text-danger">*</span></label>
                                <input type="text" name="service_type" id="service_type" class="form-control"
                                       placeholder="Enter job service type" list="browsers">
                                <datalist id="browsers">
                                    @foreach($caps as $item)
                                        <option value="{{$item->name ?? ''}}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Customer Availability</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-calendar-times"></i></span></div>
                                    <input type="datetime-local" name="customer_availability_one" id="customer_availability_one"
                                           class="form-control datepicker"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Next Best Availability</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-calendar-times"></i></span></div>
                                    <input type="datetime-local" name="customer_availability_two" id="customer_availability_two"
                                           class="form-control"
                                           placeholder="">
                                </div>
                            </div>
{{--                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">--}}
{{--                                <label>Third Best Availability</label>--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                class="fa fa-calendar-times"></i></span></div>--}}
{{--                                    <input type="datetime-local" name="customer_availability_three" id="customer_availability_three"--}}
{{--                                           class="form-control"--}}
{{--                                           placeholder="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label>Notes</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fa fa-sticky-note"></i></span></div>
                                    <input type="text" name="notes" id="notes"
                                           class="form-control"
                                           placeholder="enter notes (optional)">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2" style="margin-top: 20px !important;">
                                <label for="offer-images">Select multiple images to upload: </label>
                                <div class="input-group">
                                    <input id="offer-images" onclick="selectImages()" type="file" name="images[]"
                                           multiple/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">Create Claim</button>
                                        |
                                        <a href="{{env('APP_URL')}}/jobs" class="btn btn-warning">Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-8 order-lg-8 order-xl-8">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-map"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    Select Address of Claim and nearby provider from map
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="map" style="height:825px !important;width:100%;"></div>

                            <input type="hidden" id="lat" name="lat" value=""/>
                            <input type="hidden" id="longg" name="longg" value=""/>
                        </div>
                    </div>
                </div>
                <img src="{{asset('img/technician.png')}}" style="display: none" id="technician-icon">
            </div>
        </form>

        <script type="text/javascript">
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

                    });
                } else {
                    console.log("Your browser does not support File API");
                }
            }</script>

        <script>
            var marker = false; ////Has the user plotted their location marker?
            var lati = 25.785257;
            var longi = -80.221207;
            var map, infoWindow, geocoder;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: {lat: lati, lng: longi}
                });
                getTechnicianMarkerts();

                geocoder = new google.maps.Geocoder;
                infoWindow = new google.maps.InfoWindow;


                google.maps.event.addListener(map, 'click', function(event) {
                    //Get the location that the user clicked.
                    var clickedLocation = event.latLng;
                    //If the marker hasn't been added.
                    if(marker === false){
                        //Create the marker.
                        marker = new google.maps.Marker({
                            position: clickedLocation,
                            map: map,
                            draggable: true //make it draggable
                        });
                        //Listen for drag events!
                        google.maps.event.addListener(marker, 'dragend', function(event){
                            markerLocation();
                        });
                    } else{
                        //Marker has already been added, so just change its location.
                        marker.setPosition(clickedLocation);

                    }
                    //Get the marker's location.
                    markerLocation();
                });
            }

            function geocodeLatLng(geocoder, map, infowindow) {

            }
            function moveToLocation(lat, lng){
                var center = new google.maps.LatLng(lat, lng);
                map.panTo(center);
            }

            function markerLocation(){
                //Get location.
                var currentLocation = marker.getPosition();
                //Add lat and lng values to a field that we can save.
                var newlat = currentLocation.lat(); //latitude
                var newlong = currentLocation.lng(); //longitude
                document.getElementById('lat').value = newlat;
                document.getElementById('longg').value = newlong;
                console.log(newlong);
                console.log(newlat);
                var myurl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +newlat+ "," +newlong+"&key=AIzaSyBiWCqUwYcKgZyvusgkFOKfop1vA2dLZnE";
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(e) {
                    if (this.readyState === 4 && this.status === 200) {
                        let data = JSON.parse(e.srcElement.response);
                        var dat = JSON.stringify(data.results);
                        console.log(data);
                        var address= data.results[1].formatted_address;
                        document.getElementById('address').value = address;
                    }
                };
                xhttp.open("GET", myurl, true);
                xhttp.send();

            }

            function addressEntered(address){
                // alert(address);
                // if (geocoder) {
                //     geocoder.geocode( { 'address': address}, function(results, status) {
                //         if (status === google.maps.GeocoderStatus.OK) {
                //             if (status !== google.maps.GeocoderStatus.ZERO_RESULTS) {
                //                 map.setCenter(results[0].geometry.location);
                //                 var infowindow = new google.maps.InfoWindow(
                //                     { content: '<b>'+address+'</b>',
                //                         size: new google.maps.Size(150,50)
                //                     });
                //
                //                 var marker = new google.maps.Marker({
                //                     position: results[0].geometry.location,
                //                     map: map,
                //                     title:address
                //                 });
                //                 google.maps.event.addListener(marker, 'click', function() {
                //                     infowindow.open(map,marker);
                //                 });
                //
                //             } else {
                //                 alert("No results found");
                //             }
                //         } else {
                //             alert("Geocode was not successful for the following reason: " + status);
                //         }
                //     });
                // }
            }

            function getTechnicianMarkerts() {
                $.ajax({
                    url: `{{env('APP_URL')}}/api/technicians/get`,
                    type: 'GET',
                    dataType: "JSON",
                    beforeSend: function () {
                        $('#main-form').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                    },
                    success: function (result) {
                        let techniciansList = result;
                        for(let i=0;i<techniciansList.length;i++){
                            console.log(techniciansList[i].lat)
                            var myLatLng = {lat: parseFloat(techniciansList[i].lat)  , lng: parseFloat(techniciansList[i].longg)};
                            var mymarker = new google.maps.Marker({
                                position: myLatLng,
                                title:techniciansList[i].name,
                                icon: document.getElementById('technician-icon').getAttribute('src'),
                            });
                            mymarker.setMap(map);
                            mymarker.addListener('click', function (event) {
                                 document.getElementById('technician_name').value=techniciansList[i].name;
                                 document.getElementById('technician_id').value=techniciansList[i].id;
                            });
                        }
                    }
                });
            }

        </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJqJcwaHOlWKivApYFYSjmVobGeKFqGdE&callback=initMap">
                </script>
    </div>
    <script>
        // window.onload = (event) => {
        //     $(document).ready(function () {
        //         const today = new Date()
        //         const tomorrow = new Date(today)
        //         tomorrow.setDate(tomorrow.getDate() + 1)
        //         $('#customer_availability_one').datepicker('setStartDate', new Date());
        //         $('#customer_availability_one').datepicker('setEndDate', tomorrow);
        //     });
        // };
        $(document).ready(function(){
            var maxDate = new Date(Date.now() + 62 * 60 * 60 * 1000).toISOString();
            elem = document.getElementById("customer_availability_one")
            var iso = new Date().toISOString();
            var minDate = iso.substring(0,iso.length-1);
            elem.min = minDate
            elem.max = maxDate
            console.log('min',minDate);
            console.log('max',maxDate);
        });
        $(document).ready(function(){
            var maxDate = new Date(Date.now() + 62 * 60 * 60 * 1000).toISOString();
            elem = document.getElementById("customer_availability_two")
            var iso = new Date().toISOString();
            var minDate = iso.substring(0,iso.length-1);
            elem.min = minDate
            elem.max = maxDate
            console.log('min',minDate);
            console.log('max',maxDate);
        });
        let radioButtonPrior;


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
                        address: {required: true},
                        city: {required: true},
                        estate: {required: true},
                        zipCode: {required: true},
                        policyNo: {required: true},
                        itemType: {required: true},
                        itemLocation: {required: true},
                        issueDetails: {required: true},
                        title: {required: true},
                        description: {required: true},
                        service_type: {required: true},
                        name: {required: true},
                        email: {email: true, required: true},
                        phone: {required: true, minlength: 10},

                    },
                    // Specify validation error messages
                    messages: {
                        address: "Please enter address",
                        city: "Please enter city",
                        estate: "Please enter estate",
                        zipCode: "Please enter zip code",
                        policyNo: "Please enter policy no",
                        itemType: "Please enter item type",
                        itemLocation: "Please enter item location",
                        issueDetails: "Please enter issue details",
                        title: "Please enter title",
                        description: "Please enter description",
                        service_type: "Please enter service type",
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
                                // checkBoxesArray = [];
                            }
                        })
                    },
                    // Here we submit the completed form to database
                    submitHandler: function (form, e) {
                        // Enable Page Loading
                        if (document.getElementById('priorIssueYes').checked === false && document.getElementById('priorIssueNo').checked === false) {
                            swal.fire({
                                "title": "",
                                "text": "Please select prior issue",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary",
                                "onClose": function (e) {
                                    console.log('on close event fired!');
                                }
                            })
                            event.preventDefault();
                            return;
                        }
                        if(document.getElementById('priorIssueYes').checked === true)
                        {
                            radioButtonPrior = 'Yes';
                        }
                        if(document.getElementById('priorIssueNo').checked === true)
                        {
                            radioButtonPrior = 'No';
                        }

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
                        data.push({
                            "name": "radioButtonPrior",
                            "value": radioButtonPrior
                        });
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        $.ajax({
                            url: "{{env('APP_URL')}}/job/save",
                            type: 'POST',
                            dataType: "JSON",
                            data: data,
                            success: function (result) {
                                if (result['status']) {
                                    var offerImages = document.getElementById('offer-images').files;

                                    let formData = new FormData();
                                    for (var i = 0; i < offerImages.length; i++) {
                                        formData.append("offer_images[]", offerImages[i]);
                                    }
                                    formData.append("jobId", result['job_id']);
                                    formData.append("_token", "{{ csrf_token() }}");
                                    // document.getElementById('send-email-btn').setAttribute('disabled', true);
                                    $.ajax
                                    ({
                                        type: 'POST',
                                        url: `{{env('APP_URL')}}/job/images/save`,
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
                                                        window.location.href = `{{env('APP_URL')}}/jobs`
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



                                    // Disable Page Loading and show confirmation

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
