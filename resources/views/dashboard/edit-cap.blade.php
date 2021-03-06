@extends('dashboard.layout')
<!-- begin:: Content -->
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 1-->

        <!--Begin::Row-->
        <form action="#" method="POST" id="listing_form" class="form-horizontal listing_form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xl-12 order-lg-12 order-xl-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-user"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    Edit Cap
                                </h3>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id"
                               class="form-control" value="{{$cap->id}}">
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Enter full name" value="{{$cap->name}}">
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Total Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="totalAmount" id="totalAmount" class="form-control"
                                           placeholder="Enter number"  value="{{$cap->total_amount}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        |
                                        <a href="{{env('APP_URL')}}/cap" class="btn btn-warning">Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <img src="{{asset('img/technician.png')}}" style="display: none" id="technician-icon">
        </form>

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
                 geocoder = new google.maps.Geocoder;
                infoWindow = new google.maps.InfoWindow;
                getTechnicianMarkerts();

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

            function codeAddress(event) {
                if (event.key !== "Enter"){
                    return;
                }
                event.preventDefault();
                geocoder = new google.maps.Geocoder();
                let address = document.getElementById("address").value;
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        let gotlat = results[0].geometry.location.lat();
                        let gotlong = results[0].geometry.location.lng();
                        moveToLocation(gotlat, gotlong);
                        document.getElementById('lat').value = gotlat;
                        document.getElementById('longg').value = gotlong;
                        let markernew = new google.maps.Marker({
                            position: new google.maps.LatLng(gotlat, gotlong),
                            map: map,
                            title: 'Technician Location'
                        });
                    }
                    else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
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
                            var myLatLng = {lat: parseFloat(techniciansList[i].lat)  , lng: parseFloat(techniciansList[i].longg)};
                            var mymarker = new google.maps.Marker({
                                position: myLatLng,
                                title:techniciansList[i].name,
                                icon: document.getElementById('technician-icon').getAttribute('src'),
                            });
                            mymarker.setMap(map);
                        }
                    }
                });
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

        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJqJcwaHOlWKivApYFYSjmVobGeKFqGdE&callback=initMap">
        </script>
    </div>

    <!-- end:: Content -->
    <script>
        let checkBoxesArray = [];
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
                        totalAmount: {required: true},
                    },
                    // Specify validation error messages
                    messages: {
                        name: "Please enter name",
                        totalAmount: "Please enter total amount",
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
                            url: "{{env('APP_URL')}}/cap/update",
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
                                            "text": "Updated Successfully",
                                            "type": "success",
                                            "showConfirmButton": false,
                                            "timer": 1500,
                                            "onClose": function (e) {
                                                window.location.href = `{{env('APP_URL')}}/cap`
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
