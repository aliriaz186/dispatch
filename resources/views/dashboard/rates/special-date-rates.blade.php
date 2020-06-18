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
                                Special Date Rates
                            </h3>
                        </div>
                    </div>
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="control-label">&nbsp;Date Type</label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">&nbsp;Type</label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">Time <span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">24 Hours Format</span></label>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">&nbsp;Rates <span
                                            class="kt-badge kt-badge--warning kt-badge--sm kt-badge--inline"
                                            id="travel-distance">{{env('CURRENCY_SYMBOL')}}</span></label>
                                </div>
                            </div>
                            <div id="rows-count" style="display: none">{{count($data['special_date_rates'])}}</div>
                            @foreach($data['special_date_rates'] as $key => $rate)
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <input type="hidden" value="{{$rate->special_date_auto_id}}"
                                               id="special_date_auto_id_{{$key}}">
                                        <select name="date_type" id="date_type_{{$key}}"
                                                class="form-control kt-selectpicker">
                                            @foreach ($data['date_types'] as $index => $value)
                                                <option
                                                    value="{{($index + 1)}}" {{(($index + 1) == $rate->special_date_type) ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select name="date_method" id="date_method_{{$key}}"
                                                class="form-control kt-selectpicker">
                                            <option value="1" {{("1" == $rate->special_date_method) ? 'selected' : ''}}>
                                                Block Booking
                                            </option>
                                            <option value="2" {{("2" == $rate->special_date_method) ? 'selected' : ''}}>
                                                Uplift Booking
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">From</span>
                                            </div>
                                            <input type="text" name="from_time" id="from_time_{{$key}}"
                                                   class="form-control" value="{{$rate->special_date_start}}"
                                                   onkeyup="checkValidation({{$key}})" placeholder="00">
                                            <div class="input-group-prepend"><span class="input-group-text">To</span>
                                            </div>
                                            <input type="text" name="to_time" id="to_time_{{$key}}"
                                                   class="form-control" value="{{$rate->special_date_end}}"
                                                   onkeyup="checkValidation({{$key}})" placeholder="00">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text">{{env('CURRENCY_SYMBOL')}}</span>
                                            </div>
                                            <input type="text" name="rates" id="rates_{{$key}}"
                                                   class="form-control" placeholder="0"
                                                   onkeyup="checkValidation({{$key}})"
                                                   value="{{$rate->special_date_amount}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button onclick="deleteRecord({{$rate->special_date_auto_id}})" type="button"
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
                                        <button type="reset" class="btn btn-primary" onclick="saveRecord(0)">Save
                                        </button>
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
                url: "{{env('APP_URL')}}/specialdate/rate/new",
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}"},
                success: function (result) {
                    KTApp.unblockPage();
                    if (result['status']) {
                        window.location.href = `{{env('APP_URL')}}/rates/specialdate`
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
                    'date_method': document.getElementById('date_method_' + i).value,
                    'date_type': document.getElementById('date_type_' + i).value,
                    'special_date_auto_id': document.getElementById('special_date_auto_id_' + i).value,
                    'from_time': document.getElementById('from_time_' + i).value,
                    'to_time': document.getElementById('to_time_' + i).value,
                    'rates': document.getElementById('rates_' + i).value
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
                url: "{{env('APP_URL')}}/specialdate/rate/save",
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
                                        window.location.href = `{{env('APP_URL')}}/rates/specialdate`
                                    }
                                })
                            }, 2000);
                        } else {
                            setTimeout(function () {
                                window.location.href = `{{env('APP_URL')}}/rates/specialdate`
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
                url: "{{env('APP_URL')}}/specialdate/rate/delete",
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}", special_date_auto_id: id},
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
                                    window.location.href = `{{env('APP_URL')}}/rates/specialdate`
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

        function checkValidation(index) {
            if (document.getElementById('from_time_' + index).value < 0 || document.getElementById('from_time_' + index).value === '' || document.getElementById('from_time_' + index).value === undefined || document.getElementById('from_time_' + index).value >= 24) {
                document.getElementById('from_time_' + index).value = 0;
            }
            if (document.getElementById('to_time_' + index).value < 0 || document.getElementById('to_time_' + index).value === '' || document.getElementById('to_time_' + index).value === undefined || document.getElementById('to_time_' + index).value >= 24) {
                document.getElementById('to_time_' + index).value = 0;
            }
            if (document.getElementById('rates_' + index).value < 0 || document.getElementById('rates_' + index).value === '' || document.getElementById('rates_' + index).value === undefined) {
                document.getElementById('rates_' + index).value = 0;
            }
        }
    </script>
@endsection
