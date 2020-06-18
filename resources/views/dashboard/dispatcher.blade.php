@extends('dashboard/layout');
@section('content')
    <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
            height: 500px;
        }
    </style>

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 1-->

        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-12 order-lg-12 order-xl-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fas fa-user"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Customer
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-marginless row">
                                    <div class="form-group col-lg-3">
                                        <label>Contact No:</label>
                                        <input type="text" class="form-control" placeholder="Enter Contact No">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Full Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 order-lg-6 order-xl-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fas fa-calendar"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                New Booking
                            </h3>
                        </div>
                    </div>
                    <form action="#" method="POST" id="new_booking_form" class="form-horizontal new_booking_form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="kt-portlet__body">
                                    <div class="form-group form-group-marginless row">
                                        <div class="form-group col-lg-12">
                                            <label>Pickup Location:</label>
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control" name="pickupFrom"
                                                       id="pickupFrom" placeholder="Enter Pickup Location">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                            class="la la-map-marker text-danger"></i></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Via Location:</label>
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control"
                                                       placeholder="Enter Pickup Location">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                            class="la la-map-marker text-warning"></i></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Dropoff Location:</label>
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control" name="pickupTo" id="pickupTo"
                                                       placeholder="Enter Dropoff Location">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                            class="la la-map-marker text-success"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-marginless row">
                                        <div class="col-lg-4">
                                            <label>Distance: <span
                                                    class="kt-badge kt-badge--danger kt-badge--md kt-badge--inline"
                                                    id="travel-distance">0 km</span></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Time: <span
                                                    class="kt-badge kt-badge--danger kt-badge--md kt-badge--inline"
                                                    id="travel-duration">0 hours 0 mins</span></label>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="form-group form-group-marginless row">
                                        <div class="form-group col-lg-6">
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="trip_time" checked value="1"> Oneway
                                                <span></span>
                                            </label>
                                            <input type="email" class="form-control" placeholder="dd/mm/yyyy">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="trip_time" value="1"> Return
                                                <span></span>
                                            </label>
                                            <input type="email" class="form-control" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-marginless row">
                                        <div class="col-lg-4">
                                            <label class="">Passengers:</label>
                                            <select class="form-control kt-selectpicker">
                                                @foreach ($data['lug_pass_counts'] as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>;
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Luggage:</label>
                                            <select class="form-control kt-selectpicker">
                                                @foreach ($data['lug_pass_counts'] as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>;
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Cabin Luggage:</label>
                                            <select class="form-control kt-selectpicker">
                                                @foreach ($data['lug_pass_counts'] as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>;
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary">Find Fleets</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6 order-lg-6 order-xl-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fas fa-car"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Fleets
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-marginless row">
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="kt-widget kt-widget--user-profile-1 kt-widget-dispatch-car">
                                            <div class="kt-widget__head">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Go!</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget__body">
                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label">MPV 06 or Pepole Carrier</span>
                                                    </div>
                                                    <div class="kt-widget__info">
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-users fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i> X 4</span>
                                                        <span class="kt-widget__label"><i
                                                                class="fas fa-suitcase fa-lg kt-font-warning"></i> X 4</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 order-lg-12 order-xl-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fas fa-car"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Map
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="map"></div>
                    </div>
                </div>


            </div>
        </div>
        <!--End::Row-->


        <!--End::Dashboard 1-->
    </div>

    <!-- end:: Content -->


    <script>

        $('.new_booking_form').on('submit', function (e) {
            // Enable Page Loading
            KTApp.blockPage({
                baseZ: 2000,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Processing...'
            });
            var form = $('.new_booking_form');
            var data = form.serializeArray();
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                url: `{{env('APP_URL')}}/dispatcher/fetchFleets`,
                type: 'POST',
                dataType: "JSON",
                data: data,
                beforeSend: function () {
                    $('#main-form').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                },
                success: function (result) {
                    if (result['status']) {
                        $("#travel-distance").html(result['distance']);
                        $("#travel-duration").html(result['duration']);
                        $(".status-message").html(result['message']);
                        // Disable Page Loading
                        setTimeout(function () {
                            KTApp.unblockPage();
                        }, 1000);
                    } else {
                        setTimeout(function () {
                            KTApp.unblockPage();
                        }, 1000);
                    }
                }
            });
        });

    </script>

    <script>

        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -37.804887, lng: 144.955425},
                zoom: 16,
                styles: styles['default'],
                mapTypeControl: false
            });

            // Path of the icons
            var iconBase = 'http://localhost/dispatcher/assets/media/dispatcher/';

            // List of Car Icons
            var icons = {
                active: {
                    icon: iconBase + 'active.png'
                },
                available: {
                    icon: iconBase + 'available.png'
                }
            };

            // List of Cars
            var listofcars = [
                {
                    position: new google.maps.LatLng(-37.803743, 144.955404),
                    type: 'active'
                }, {
                    position: new google.maps.LatLng(-37.801446, 144.952829),
                    type: 'active'
                }, {
                    position: new google.maps.LatLng(-37.802209, 144.949846),
                    type: 'active'
                }, {
                    position: new google.maps.LatLng(-37.803786, 144.947411),
                    type: 'active'
                }, {
                    position: new google.maps.LatLng(-37.803353, 144.951896),
                    type: 'available'
                }
            ];

            // Add controls to the map, allowing users to hide/show features.
            var styleControl = document.getElementById('style-selector-control');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

            for (var i = 0; i < listofcars.length; i++) {
                var marker = new google.maps.Marker({
                    position: listofcars[i].position,
                    icon: icons[listofcars[i].type].icon,
                    map: map
                });
            }
            ;
        }

        var styles = {
            default: [
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#7c93a3"
                        },
                        {
                            "lightness": "-10"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#a0a4a5"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#62838e"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#DAE6EB"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#3f4a51"
                        },
                        {
                            "weight": "0.30"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.business",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.government",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.school",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.sports_complex",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#bbcacf"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "lightness": "0"
                        },
                        {
                            "color": "#bbcacf"
                        },
                        {
                            "weight": "0.50"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#a9b4b8"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "invert_lightness": true
                        },
                        {
                            "saturation": "-7"
                        },
                        {
                            "lightness": "3"
                        },
                        {
                            "gamma": "1.80"
                        },
                        {
                            "weight": "0.01"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#a3c7df"
                        }
                    ]
                }
            ],
            night: [
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#7c93a3"
                        },
                        {
                            "lightness": "-10"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#a0a4a5"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#62838e"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#DAE6EB"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#3f4a51"
                        },
                        {
                            "weight": "0.30"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.business",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.government",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.school",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.sports_complex",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#bbcacf"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "lightness": "0"
                        },
                        {
                            "color": "#bbcacf"
                        },
                        {
                            "weight": "0.50"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#a9b4b8"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "invert_lightness": true
                        },
                        {
                            "saturation": "-7"
                        },
                        {
                            "lightness": "3"
                        },
                        {
                            "gamma": "1.80"
                        },
                        {
                            "weight": "0.01"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#a3c7df"
                        }
                    ]
                }
            ]
        };
    </script>


    <script>
        $(document).ready(function () {
            var inputFrom = document.getElementById('pickupFrom');
            var optionsFrom = {
                // types: ['(cities)'],
                componentRestrictions: {country: 'gb'}
            };
            pickupFrom = new google.maps.places.Autocomplete(inputFrom, optionsFrom);

            var inputTo = document.getElementById('pickupTo');
            var optionsTo = {
                // types: ['(cities)'],
                componentRestrictions: {country: 'gb'}
            };
            pickupTo = new google.maps.places.Autocomplete(inputTo, optionsTo);
        });
    </script>


    <script async defer type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSObvVb71gNZiHskaCm_OUNMsi9JjQVeg&libraries=places&callback=initMap"></script>
@endsection
