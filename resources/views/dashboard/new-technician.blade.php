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
                                    New Provider
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="companyName" id="companyName" class="form-control"
                                           placeholder="Enter company name">
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Enter full name">
                                </div>
                                <div class="col-lg-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-envelope"></i></span></div>
                                        <input type="text" name="email" id="email"
                                               class="form-control"
                                               placeholder="Enter email">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <label>Password
                                        <span data-toggle="kt-tooltip" data-placement="top"
                                              title="Leave blank for default password [123456]">
                                    <i class="flaticon2-information text-info"></i>
                                    </span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-key"></i></span></div>
                                        <input type="text" name="password" id="password"
                                               class="form-control"
                                               placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fa fa-phone"></i></span></div>
                                            <input type="text" name="phone" id="phone"
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Website <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa flaticon2-website"></i></span></div>
                                        <input type="text" name="website" id="website"
                                               class="form-control"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <label>Service Area Coverage <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" id="zipCode"
                                               class="form-control"
                                               placeholder="Press Enter to Add Multiple Zip Code"
                                               onkeypress="addMultipleZipCode(event,value)">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Office Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="address" id="address" readonly
                                               class="form-control" placeholder="Please Select From Map" onkeypress="codeAddress(event)">
                                    </div>
                                </div>
                                <div class="mt-3 col-lg-12">
                                    <span class="small my-2" id="append-span"></span>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <label>Type of work <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="row col-lg-12 mt-1">
                                            <input id="plumbing-work" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Plumbing</span>
                                            <input id="electrician-work" style="margin-left: 129px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Electrician</span>
                                            <input id="hvac-work" style="margin-left: 139px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Hvac</span>
                                        </div>
                                        <div class="row col-lg-12 mt-1">
                                            <input id="garage-doors-work" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Garage Doors</span>
                                            <input id="appliances-work" style="margin-left: 100px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Appliances</span>
                                            <input id="drywall-work" style="margin-left: 133px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Drywall</span>
                                        </div>
                                        <div class="row col-lg-12 mt-1">
                                            <input id="roof-repair-work" style="" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Roof Repair</span>
                                            <input id="septic-system-work" style="margin-left: 117px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Septic System</span>
                                            <input id="pools-work" style="margin-left: 114px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Pools</span>
                                        </div>
                                        <div class="row col-lg-12 mt-1">
                                            <input id="central-vacuum-work" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">Central Vacuum</span>
                                            <input id="other-work" style="margin-left: 85px" type="checkbox"><span style="margin-top: -3px;margin-left: 6px;">other</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <label for="offer-images">Select multiple files to upload: </label>
                                    <input id="offer-images" onclick="selectImages()" type="file" name="images[]"
                                           multiple/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-map"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    Select Address or service Area from map
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="map" style="height:450px;width:100%;"></div>

                                <input type="hidden" id="lat" name="lat" value="" />
                                <input type="hidden" id="longg" name="longg" value="" />
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        |
                                        <a href="{{env('APP_URL')}}/technicians" class="btn btn-warning">Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <img src="{{asset('img/technician.png')}}" style="display: none" id="technician-icon">
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
            let zipCodeArray = [];

            function addMultipleZipCode(event, value) {
                if (event.keyCode === 13) {
                    if(document.getElementById('zipCode').value === '' || document.getElementById('zipCode').value === null)
                    {
                        swal.fire({
                            "title": "",
                            "text": "Zip Code may be empty or format may not be correct",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                            "onClose": function (e) {
                                console.log('on close event fired!');
                            }
                        })
                        event.preventDefault();
                        return;
                    }
                    var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
                    if(!zipCodePattern.test(document.getElementById('zipCode').value))
                    {
                        swal.fire({
                            "title": "",
                            "text": "Zip Code is not correct",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                            "onClose": function (e) {
                                console.log('on close event fired!');
                            }
                        })
                        event.preventDefault();
                        return;
                    }
                    let appendSpan = document.getElementById('append-span');
                    let span = document.createElement('span');
                    span.innerHTML = '<span\n' +
                        '                                                 style="margin-left:5px;background-color: #f8f8f8;padding: 5px 13px;border: 1px solid #d0d0d0;border-radius: 4px;color: black;">' + value + '\n' +
                        '                                                         </span>';
                    appendSpan.appendChild(span);
                    zipCodeArray.push(value);
                    document.getElementById('zipCode').value = '';
                    event.preventDefault();
                }
            }

            function addMultipleZipCodeDirect(value) {
                var zipCodePattern = /^\d{5}$|^\d{5}-\d{4}$/;
                if (!zipCodePattern.test(document.getElementById('zipCode').value)) {
                    swal.fire({
                        "title": "",
                        "text": "Zip Code is not correct",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary",
                        "onClose": function (e) {
                            console.log('on close event fired!');
                        }
                    })
                    event.preventDefault();
                    return;
                }
                let appendSpan = document.getElementById('append-span');
                let span = document.createElement('span');
                span.innerHTML = '<span\n' +
                    '                                                 style="margin-left:5px;background-color: #f8f8f8;padding: 5px 13px;border: 1px solid #d0d0d0;border-radius: 4px;color: black;">' + value + '\n' +
                    '                                                         </span>';
                appendSpan.appendChild(span);
                zipCodeArray.push(value);
                document.getElementById('zipCode').value = '';
                event.preventDefault();
            }
        </script>
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
                        companyName: {required: true},
                        name: {required: true},
                        email: {email: true, required: true},
                        phone: {required: true, minlength: 10},
                        address: {required: true},
                        website: {required: true},

                    },
                    // Specify validation error messages
                    messages: {
                        companyName: "Please enter company name",
                        name: "Please enter name",
                        email: "Please enter email address",
                        phone: {
                            required: "Please provide a phone number",
                            minlength: "Your phone number must be 10 characters long"
                        },
                        address: "Please enter address",
                        website: "Please enter address",
                    },
                    // Invalid Handler message
                    invalidHandler: function (event, validator) {
                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                            "onClose": function (e) {
                                checkBoxesArray = [];
                            }
                        })
                    },
                    // Here we submit the completed form to database
                    submitHandler: function (form, e) {
                        // Enable Page Loading

                        if (document.getElementById('other-work').checked === false && document.getElementById('central-vacuum-work').checked === false && document.getElementById('pools-work').checked === false && document.getElementById('septic-system-work').checked === false && document.getElementById('roof-repair-work').checked === false && document.getElementById('drywall-work').checked === false && document.getElementById('appliances-work').checked === false && document.getElementById('garage-doors-work').checked === false && document.getElementById('hvac-work').checked === false && document.getElementById('electrician-work').checked === false && document.getElementById('plumbing-work').checked === false) {
                            swal.fire({
                                "title": "",
                                "text": "Please select atleast one work type",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary",
                                "onClose": function (e) {
                                    console.log('on close event fired!');
                                }
                            })
                            event.preventDefault();
                            return;
                        }
                        if(document.getElementById('zipCode').value !== '')
                        {
                            addMultipleZipCodeDirect(document.getElementById('zipCode').value);
                        }
                        if (zipCodeArray.length === 0) {
                            swal.fire({
                                "title": "",
                                "text": "Please atleast add one zip code",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary",
                                "onClose": function (e) {
                                    console.log('on close event fired!');
                                }
                            })
                            event.preventDefault();
                            return;
                        }

                        if(document.getElementById('plumbing-work').checked === true)
                        {
                            checkBoxesArray.push('Plumbing');
                        }
                        if(document.getElementById('electrician-work').checked === true)
                        {
                            checkBoxesArray.push('Electrician');
                        }
                        if(document.getElementById('hvac-work').checked === true)
                        {
                            checkBoxesArray.push('Hvac');
                        }
                        if(document.getElementById('garage-doors-work').checked === true)
                        {
                            checkBoxesArray.push('Garage Doors');
                        }
                        if(document.getElementById('appliances-work').checked === true)
                        {
                            checkBoxesArray.push('Appliances');
                        }
                        if(document.getElementById('drywall-work').checked === true)
                        {
                            checkBoxesArray.push('Drywall');
                        }
                        if(document.getElementById('roof-repair-work').checked === true)
                        {
                            checkBoxesArray.push('Roof Repair');
                        }
                        if(document.getElementById('septic-system-work').checked === true)
                        {
                            checkBoxesArray.push('Septic System');
                        }
                        if(document.getElementById('pools-work').checked === true)
                        {
                            checkBoxesArray.push('Pools');
                        }
                        if(document.getElementById('central-vacuum-work').checked === true)
                        {
                            checkBoxesArray.push('Central Vacuum');
                        }
                        if(document.getElementById('other-work').checked === true)
                        {
                            checkBoxesArray.push('Other');
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
                            "name": "zipCodeArray",
                            "value": zipCodeArray
                        });
                        data.push({
                            "name": "checkBoxesArray",
                            "value": checkBoxesArray
                        });
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        $.ajax({
                            url: "{{env('APP_URL')}}/technician/save",
                            type: 'POST',
                            dataType: "JSON",
                            data: data,
                            success: function (result) {
                                if (result['status']) {
                                    // Disable Page Loading and show confirmation

                                    var offerImages = document.getElementById('offer-images').files;

                                    let formData = new FormData();
                                    for (var i = 0; i < offerImages.length; i++) {
                                        formData.append("offer_images[]", offerImages[i]);
                                    }
                                    formData.append("technicianId", result['technician_id']);
                                    formData.append("_token", "{{ csrf_token() }}");
                                    // document.getElementById('send-email-btn').setAttribute('disabled', true);
                                    $.ajax
                                    ({
                                        type: 'POST',
                                        url: `{{env('APP_URL')}}/technician/files/save`,
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
                                                        window.location.href = `{{env('APP_URL')}}/technicians`
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

                                } else {
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
                            }
                        });
                    }
                });
            });

        });

    </script>
@endsection
