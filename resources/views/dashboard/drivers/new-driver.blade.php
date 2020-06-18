@extends('dashboard.layout')
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
                                    Driver
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Company ID <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_company_auto_id" id="fleet_company_auto_id"
                                           class="form-control" value="100001" placeholder="Company ID"
                                           disabled="disabled">
                                </div>
                                <div class="col-lg-4">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="fleet_driver_status" id="fleet_driver_status"
                                            class="form-control kt-selectpicker">
                                        <option value="1" selected>Active</option>
                                        <option value="2">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_driver_name" id="fleet_driver_name"
                                           class="form-control" placeholder="Enter full name">
                                </div>
                                <div class="col-lg-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-envelope"></i></span></div>
                                        <input type="text" name="fleet_driver_email" id="fleet_driver_email"
                                               class="form-control" placeholder="Enter email">
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
                                        <input type="text" name="fleet_driver_password" id="fleet_driver_password"
                                               class="form-control" placeholder="Enter password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-lg-4">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-phone"></i></span></div>
                                        <input type="text" name="fleet_driver_phone" id="fleet_driver_phone"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Gender <span class="text-danger">*</span></label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" checked name="fleet_driver_gender" value="1"> Male
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" name="fleet_driver_gender" value="2"> Female
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="fleet_driver_address" id="fleet_driver_address"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>City <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="fleet_driver_city" id="fleet_driver_city"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Postal Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt"></i></span></div>
                                        <input type="text" name="fleet_driver_postal_code" id="fleet_driver_postal_code"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <label class="">Licence No <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_driver_license_no" id="fleet_driver_license_no"
                                           class="form-control" placeholder="Enter licence no">
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Licence Expire Date <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_driver_license_expire"
                                           id="fleet_driver_license_expire" class="form-control"
                                           placeholder="Enter licence expire date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand fas fa-car"></i>
                            </span>
                                <h3 class="kt-portlet__head-title">
                                    Fleet
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Fleet Type <span class="text-danger">*</span></label>
                                    <select name="fleet_type_id" id="fleet_type_id"
                                            class="form-control kt-selectpicker">
                                        @foreach ($data['fleets'] as $key => $value)
                                            <option
                                                value="{{$key}}" {{(1 == $key) ? 'selected' : ''}}>{{$value}}</option>;
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Plate No <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_plate_no" id="fleet_plate_no" class="form-control"
                                           placeholder="Enter plate no">
                                </div>
                                <div class="col-lg-4">
                                    <label>Make <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_make" id="fleet_make" class="form-control"
                                           placeholder="Enter make name">
                                </div>
                                <div class="col-lg-4">
                                    <label>Model <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_model" id="fleet_model" class="form-control"
                                           placeholder="Enter model name">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <label class="">Is Baby Seat Available </label>
                                    <select name="fleet_is_baby_seat" id="fleet_is_baby_seat"
                                            class="form-control kt-selectpicker">
                                        <option value="1">Yes</option>
                                        <option value="2" selected>No</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Is Wheel Chair Available </label>
                                    <select name="fleet_is_wheelchair" id="fleet_is_wheelchair"
                                            class="form-control kt-selectpicker">
                                        <option value="1">Yes</option>
                                        <option value="2" selected>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Commission (Every Trip) <span class="text-danger">*</span></label>
                                    <input type="text" name="fleet_contract_amount" id="fleet_contract_amount"
                                           class="form-control" placeholder="Enter Amount / Percentage">
                                    <span class="form-text text-muted">Please enter Amount / Percentage ({{env('CURRENCY_SYMBOL')}}5 or 10%)</span>
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
                                        <a href="{{env('APP_URL')}}/drivers" class="btn btn-warning">Go Back</a>
                                    </div>
                                    <div class="col-lg-6 kt-align-right">
                                        <button type="button" class="btn btn-danger"><i class="fa fa-key"></i> Reset
                                            Password
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
                baseZ: 500,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Loading Please Wait...'
            });
            setTimeout(function () {
                KTApp.unblockPage();
            }, 500);
            $(function () {
                // Initialize form validation.
                $(".listing_form").validate({
                    // Specify validation rules
                    rules: {
                        fleet_driver_name: {required: true},
                        fleet_driver_email: {required: true, email: true},
                        fleet_driver_phone: {required: true, digits: true, minlength: 10, maxlength: 15},
                        fleet_driver_address: {required: true},
                        fleet_driver_city: {required: true},
                        fleet_driver_postal_code: {required: true},
                        fleet_driver_license_no: {required: true},
                        fleet_driver_license_expire: {required: true, date: "YYYY-MM-DD"},
                        fleet_plate_no: {required: true},
                        fleet_make: {required: true},
                        fleet_model: {required: true},
                        fleet_contract_amount: {required: true}
                    },
                    // Specify validation error messages
                    messages: {
                        fleet_driver_name: "Please enter driver name",
                        fleet_driver_email: "Please enter email address",
                        fleet_driver_phone: {
                            required: "Please provide a phone number",
                            digits: "Only numbers allowed",
                            minlength: "Your phone number must be 10 characters long",
                            maxlength: "Your phone number must be 10 characters long"
                        },
                        fleet_driver_address: "Please enter address",
                        fleet_driver_city: "Please enter city",
                        fleet_driver_postal_code: "Please enter postal code",
                        fleet_driver_license_no: "Please enter license no",
                        fleet_driver_license_expire: {
                            required: "Please enter license expire date",
                            date: "Correct Format is: YYYY-MM-DD"
                        },
                        fleet_plate_no: "Please enter plate no",
                        fleet_make: "Please enter make",
                        fleet_model: "Please enter model",
                        fleet_contract_amount: "Please enter Commission Amount"
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
                            url: "{{env('APP_URL')}}/drivers/save",
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
                                                window.location.href = `{{env('APP_URL')}}/drivers`
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
