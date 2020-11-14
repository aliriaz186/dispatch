@extends('dashboard/layout')
@section('content')
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
                                <i class="fas fa-file-invoice"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                Invoices
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="technician-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Claim Id</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><a target="_blank" href="{{env('TECHNICIAN_URL')}}/new-invoices//{{$item->invoice}}"><img style="padding:20px;object-fit: cover;border: 1px solid #a9a9a973;width: 200px;height: 200px;" alt="Click to Open"
                                                                                                                    src="{{env('TECHNICIAN_URL')}}/new-invoices/{{$item->invoice}}"></a></td>
                                    <td>
                                        {{$item->job_id}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable -->
                    </div>

                    <!-- Model -->
                </div>

            </div>
        </div>
        <!--End::Row-->

        <!--End::Dashboard 1-->
    </div>

    <!-- end:: Content -->

@endsection
