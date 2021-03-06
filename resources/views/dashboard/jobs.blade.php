@extends('dashboard/layout')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12 order-lg-12 order-xl-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="kt-font-brand fas fa-briefcase"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                Claims
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
                                    <div class="dropdown dropdown-inline">
                                        {{--                                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"--}}
                                        {{--                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                        {{--                                            <i class="la la-download"></i> Export--}}
                                        {{--                                        </button>--}}
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__section kt-nav__section--first">
                                                    <span class="kt-nav__section-text">Choose an option</span>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-print"></i>
                                                        <span class="kt-nav__link-text">Print</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-copy"></i>
                                                        <span class="kt-nav__link-text">Copy</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                        <span class="kt-nav__link-text">Excel</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                        <span class="kt-nav__link-text">CSV</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                        <span class="kt-nav__link-text">PDF</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <a href="{{env('APP_URL')}}/jobs/new"
                                       class="btn btn-brand btn-elevate btn-icon-sm">
                                        <i class="la la-plus"></i>
                                        New Claim
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="technician-table">
                            <thead>
                            <tr>
                                <th>Claim No</th>
                                <th>Date Claim Created</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Technician</th>
                                <th>Title</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                        </table>
                        <!--end: Datatable -->
                    </div>
                </div>

            </div>
        </div>
        <!--End::Row-->

        <!--End::Dashboard 1-->
    </div>

    <!-- end:: Content -->
    <script>
        $(document).ready(function() {
            $('#technician-table').DataTable({
                "autoWidth": true,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax":{
                    "url": `{{env('APP_URL')}}/jobs/all`,
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "created_at" },
                    { "data": "status" },
                    { "data": "customer" },
                    { "data": "technician" },
                    { "data": "title"},
                    { "data": "address" },
                ]

            });
        } );
    </script>
@endsection
