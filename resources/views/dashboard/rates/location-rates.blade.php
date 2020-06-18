@extends('dashboard.layout')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-12 order-lg-12 order-xl-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="fa fa-chart-line"></i>
					</span>
                            <h3 class="kt-portlet__head-title">
                                Location Rates
                            </h3>
                        </div>
                    </div>
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="control-label">&nbsp;From <span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">Name</span></label>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">&nbsp;To <span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">Name</span></label>
                                </div>
                                <div class="col-lg-1">
                                    <label class="control-label"><span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">Miles</span></label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">&nbsp;Rates <span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">{{env('CURRENCY_SYMBOL')}}</span></label>
                                </div>
                            </div>
                            <div id="rows-count" style="display: none">{{count($data['location_rates'])}}</div>
                            @foreach($data['location_rates'] as $key => $rate)
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Miles</span>
                                            </div>
                                            <input type="hidden" value="{{$rate->location_auto_id}}"
                                                   id="location_auto_id_{{$key}}">
                                            <input type="text" name="from_text" id="from_text_{{$key}}"
                                                   class="form-control" value="{{$rate->from_text}}" placeholder="0"
                                                   onkeyup="checkValidation({{$key}})">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Miles</span>
                                            </div>
                                            <input type="text" name="destination_text"
                                                   onkeyup="calculateMiles({{$key}})" id="destination_text_{{$key}}"
                                                   class="form-control" value="{{$rate->destination_text}}"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" name="miles" id="miles_{{$key}}"
                                               readonly="readonly" value="{{$rate->miles}}" class="form-control"
                                               placeholder="0">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span></div>
                                            <input type="text" name="rate" id="rate_{{$key}}"
                                                   class="form-control" value="{{$rate->rate}}" placeholder="0"
                                                   onkeyup="checkValidation({{$key}})">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button onclick="deleteRecord({{$rate->location_auto_id}})" type="button"
                                                class="btn btn-wide btn-label-danger btn-pill"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button onclick="saveRecord(0)" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                    <div class="col-lg-6 kt-align-right">
                                        <button onclick="addNewRecord()" type="reset" class="btn btn-success"><i
                                                class="fa fa-plus"></i> New
                                            Record
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End::Row-->
    </div>
    <!-- end:: Content -->
    <script>
        let recordCount = 0;
        $(document).ready(function () {
            recordCount = parseInt(document.getElementById('rows-count').innerHTML);
            if (recordCount === 0) {
                addNewRecord();
            }
        });

        function addNewRecord() {
            if (recordCount > 0) {
                saveRecord(1);
                setTimeout(function () {
                    addNewRecordApi();
                }, 2000);
            } else {
                addNewRecordApi();
            }
        }

        function addNewRecordApi() {

            KTApp.blockPage({
                baseZ: 2000,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Processing...'
            });
            $.ajax({
                url: "{{env('APP_URL')}}/location/rate/new",
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}"},
                success: function (result) {
                    KTApp.unblockPage();
                    if (result['status']) {
                        window.location.href = `{{env('APP_URL')}}/rates/location`
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


        function saveRecord(callingMethod) {
            let recordsList = [];
            for (let i = 0; i < recordCount; i++) {
                recordsList.push({
                    'location_auto_id': document.getElementById('location_auto_id_' + i).value,
                    'from_text': document.getElementById('from_text_' + i).value,
                    'destination_text': document.getElementById('destination_text_' + i).value,
                    'miles': document.getElementById('miles_' + i).value,
                    'rate': document.getElementById('rate_' + i).value
                });
            }
            KTApp.blockPage({
                baseZ: 2000,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Processing...'
            });
            $.ajax({
                url: "{{env('APP_URL')}}/location/rate/save",
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}", data: JSON.stringify(recordsList)},
                success: function (result) {
                    KTApp.unblockPage();
                    if (result['status']) {
                        if (callingMethod === 0) {
                            setTimeout(function () {
                                swal.fire({
                                    "title": "",
                                    "text": "Saved Successfully",
                                    "type": "success",
                                    "showConfirmButton": false,
                                    "timer": 1500,
                                    "onClose": function (e) {
                                        window.location.href = `{{env('APP_URL')}}/rates/location`
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                window.location.href = `{{env('APP_URL')}}/rates/location`
                            }, 2000);
                        }
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

        function deleteRecord(id) {
            if (!confirm('Are you sure to remove the rate?')) {
                return;
            }
            KTApp.blockPage({
                baseZ: 2000,
                overlayColor: '#000000',
                type: 'v1',
                state: 'danger',
                opacity: 0.15,
                message: 'Processing...'
            });
            $.ajax({
                url: "{{env('APP_URL')}}/location/rate/delete",
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}", location_auto_id: id},
                success: function (result) {
                    KTApp.unblockPage();
                    if (result['status']) {
                        setTimeout(function () {
                            swal.fire({
                                "title": "",
                                "text": "Deleted Successfully",
                                "type": "success",
                                "showConfirmButton": false,
                                "timer": 1500,
                                "onClose": function (e) {
                                    window.location.href = `{{env('APP_URL')}}/rates/location`
                                }
                            })
                        }, 100);
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

        function calculateMiles(index) {
            let destination = document.getElementById('destination_text_' + index).value;
            let from = document.getElementById('from_text_' + index).value;
            let ans = destination - from;
            if (ans < 0) {
                ans = 0;
            }
            document.getElementById('miles_' + index).value = ans;
            checkValidation(index);
        }

        function checkValidation(index) {
            if (document.getElementById('destination_text_' + index).value < 0 || document.getElementById('destination_text_' + index).value === '' || document.getElementById('destination_text_' + index).value === undefined) {
                document.getElementById('destination_text_' + index).value = 0;
            }
            if (document.getElementById('from_text_' + index).value < 0 || document.getElementById('from_text_' + index).value === '' || document.getElementById('from_text_' + index).value === undefined) {
                document.getElementById('from_text_' + index).value = 0;
            }
            if (document.getElementById('rate_' + index).value < 0 || document.getElementById('rate_' + index).value === '' || document.getElementById('rate_' + index).value === undefined) {
                document.getElementById('rate_' + index).value = 0;
            }
        }
    </script>
@endsection
