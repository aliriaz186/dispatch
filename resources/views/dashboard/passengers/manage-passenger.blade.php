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
                                    Passenger
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Passenger ID <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$data['selected_passenger']->passenger_system_id}}"
                                           name="actual_passenger_auto_id" id="passenger_auto_id" class="form-control"
                                           placeholder="Passenger ID" disabled="disabled">
                                    <input type="hidden" value="{{$data['selected_passenger']->passenger_auto_id}}"
                                           name="passenger_auto_id" id="passenger_auto_id" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$data['selected_passenger']->passenger_name}}"
                                           name="passenger_name" id="passenger_name" class="form-control"
                                           placeholder="Enter full name">
                                </div>
                                <div class="col-lg-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-envelope"></i></span></div>
                                        <input type="text" value="{{$data['selected_passenger']->passenger_email}}"
                                               name="passenger_email" id="passenger_email" class="form-control"
                                               placeholder="Enter email">
                                    </div>
                                </div>
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
                                        <input type="text" value="{{$data['selected_passenger']->passenger_password}}"
                                               name="passenger_password" id="passenger_password" class="form-control"
                                               placeholder="Enter password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-lg-4">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-phone"></i></span></div>
                                        <input type="text" value="{{$data['selected_passenger']->passenger_phone}}"
                                               name="passenger_phone" id="passenger_phone" class="form-control"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-credit-card"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    Credit Card
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Name on Card</label>
                                    <input type="text" name="passenger_cc_name_on_card" id="passenger_cc_name_on_card"
                                           class="form-control" placeholder="Enter name on card"
                                           value="{{$data['selected_passenger']->passenger_cc_name_on_card}}">
                                </div>
                                <div class="col-lg-4">
                                    <label>Card Number</label>
                                    <input type="text" name="passenger_cc_card_number" id="passenger_cc_card_number"
                                           class="form-control" placeholder="Enter card number"
                                           value="{{$data['selected_passenger']->passenger_cc_card_number}}">
                                </div>
                                <div class="col-lg-4">
                                    <label>Card Expire</label>
                                    <input type="text" name="passenger_cc_card_expire" id="passenger_cc_card_expire"
                                           class="form-control" placeholder="Enter card expire"
                                           value="{{$data['selected_passenger']->passenger_cc_card_expire}}">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label>Country</label>
                                    <select name="passenger_cc_country" id="passenger_cc_country"
                                            class="form-control kt-selectpicker">
                                        <?php
                                        // foreach ($countries as $key => $value) {
                                        //     echo '<option value="'.$key.'">'.$value.'</option>';
                                        // }
                                        //                                   ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="passenger_cc_address" id="passenger_cc_address"
                                               class="form-control" placeholder="Enter address">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>City</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="passenger_cc_city" id="passenger_cc_city"
                                               class="form-control" placeholder="Enter city">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Postal Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="passenger_cc_postcode" id="passenger_cc_postcode"
                                               class="form-control" placeholder="Enter postcode">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        |
                                        <a href="{{env('APP_URL')}}/passengers" class="btn btn-warning">Go Back</a>
                                    </div>
                                    <div class="col-lg-6 kt-align-right">
                                        <button type="button" class="btn btn-danger"><i class="fa fa-key"></i> Send
                                            Password Reset Email
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <!--End::Row-->

        <!--End::Dashboard 1-->
    </div>

    <!-- end:: Content -->

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
                        passenger_name: {required: true},
                        passenger_email: {required: true, email: true},
                        passenger_phone: {required: true, digits: true, minlength: 10}
                    },
                    // Specify validation error messages
                    messages: {
                        passenger_name: "Please enter driver name",
                        passenger_email: "Please enter email address",
                        passenger_phone: {
                            required: "Please provide a phone number",
                            digits: "Only numbers allowed",
                            minlength: "Your phone number must be 10 characters long"
                        }
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
                            url: "{{env('APP_URL')}}/passenger/update",
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
                                            "timer": 1500
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
