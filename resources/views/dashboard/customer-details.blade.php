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
								<i class="kt-font-brand flaticon-users-1"></i>
							</span>
                            <h3 class="kt-portlet__head-title">
                                Customer Caps Detail
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
                                    <div class="dropdown dropdown-inline">
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
                                <th>Name</th>
                                <th>Total Amount</th>
                                <th>Amount Added</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cap as $item)
                                <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->total_amount}}</td>
                                @if(\App\CustomerCapAmount::where(['customer_id' => $customerId,'cap_id' => $item->id])->exists())
                                    <td>${{\App\CustomerCapAmount::where(['customer_id' => $customerId,'cap_id' => $item->id])->first()['amount_added']}}</td>
                                @else
                                    <td>$0</td>
                                @endif
                                <td>
                                    <a data-toggle="modal" data-target="#modalContactForm" onclick="capId({{$item->id}})"
                                       class="btn btn-brand btn-elevate btn-icon-sm" style="color: white">
                                        <i class="la la-plus"></i>
                                        Add Amount
                                    </a>
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable -->
                    </div>

                    <!-- Model -->
                    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">Add Cap Amount</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{url("/cap/amount/add")}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" id="customerId" name="customerId" value="{{$customerId}}">
                                    <input type="hidden" id="capId" name="capId" value="">
                                    <div class="modal-body mx-3">
                                        <div class="md-form">
                                            <i class="fas fa-pencil prefix grey-text"></i>
                                            <label data-error="wrong" data-success="right" for="form8">Amount :</label>
                                            <input type="text" id="amount" name="amount"
                                                      class="md-textarea form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-brand">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--End::Row-->

        <!--End::Dashboard 1-->
    </div>

    <!-- end:: Content -->
    <script>
        function capId(value) {
            document.getElementById('capId').value = value;
        }
    </script>
@endsection
