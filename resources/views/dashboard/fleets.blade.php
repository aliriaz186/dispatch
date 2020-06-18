@extends('dashboard.layout')
@section('content')
    <!-- begin:: Content -->

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--begin:: Portlet-->
        @foreach($data['fleet_info'] as $key => $fleet)
            <div class="kt-portlet portlet-info">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media">
                                <img src="{{asset($fleet["img"])}}" alt="image">
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="#" class="kt-widget__username">
                                        {{$fleet['fleet_name']}} [<i class="fas fa-car kt-font-danger"></i>
                                        : {{$fleet['driver_count']}} ]
                                    </a>
                                </div>
                                <div class="kt-widget__subhead">
                                    <a href="#"><i
                                            class="fas fa-users fa-lg kt-font-info"></i>{{$fleet['fleet_passenger']}}
                                    </a>
                                    <a href="#"><i
                                            class="fas fa-suitcase-rolling fa-lg kt-font-warning"></i>{{$fleet['fleet_luggage']}}
                                    </a>
                                    <a href="#"><i
                                            class="fas fa-suitcase fa-lg kt-font-warning"></i>{{$fleet['fleet_cabin']}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__bottom">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-piggy-bank"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Earnings</span>
                                    <span class="kt-widget__value"><span>{{env('CURRENCY_SYMBOL')}}</span>145,200</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon2-line-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Profit</span>
                                    <span class="kt-widget__value"><span>{{env('CURRENCY_SYMBOL')}}</span>274,230</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-avatar"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Drivers</span>
                                    <span class="kt-widget__value">{{$fleet['driver_count']}}</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-clock-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Working Hours</span>
                                    <span class="kt-widget__value">350</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-chat-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">968 Comments</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Portlet-->
            <!--begin::Portlet-->
            <div class="kt-portlet portlet-cars">
                <div class="kt-portlet__body">
                    <!--begin::Accordion-->
                    <div class="accordion accordion-light  accordion-toggle-arrow" id="accordion_0">
                        <div class="card">
                            <div class="card-header" id="heading_0">
                                <div class="card-title collapsed" data-toggle="collapse"
                                     data-target="#collapse_{{$key}}"
                                     aria-expanded="false" aria-controls="collapse_0">
                                    {{$fleet['fleet_name']}} - Car List
                                </div>
                            </div>
                            <div id="collapse_{{$key}}" class="collapse" aria-labelledby="heading_0"
                                 data-parent="#accordion_0">
                                <div class="card-body">
                                    @if($fleet['driver_count'] == 0)
                                        <div class="text-muted">No Drivers Found!</div>
                                    @endif
                                    @foreach ($fleet['drivers'] as $key => $value)
                                        <div class="kt-widget31">
                                            <div class="kt-widget31__item">
                                                <div class="col-md-3">
                                                    <div class="kt-widget31__content">
                                                        <div class="kt-widget31__pic">
                                                            <i class="fas fa-car fa-3x kt-font-success"></i>
                                                        </div>
                                                        <div class="kt-widget31__info">
													<span class="kt-widget31__username">
														Driver : {{$value['fleet_driver_name']}}
													</span>
                                                            <p class="kt-widget31__text">
                                                                Plate : {{$value['fleet_plate_no']}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="kt-widget31__content">
                                                        <div class="kt-widget31__info">
													<span class="kt-widget31__username">
														Rating
													</span>
                                                            <p class="kt-widget31__text">
                                                                <i class="fa fa-star kt-font-warning"></i>
                                                                <i class="fa fa-star kt-font-warning"></i>
                                                                <i class="fa fa-star kt-font-warning"></i>
                                                                <i class="fa fa-star kt-font-warning"></i>
                                                                <i class="fa fa-star kt-font-warning"></i>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="kt-widget31__content">
                                                        <div class="kt-widget31__info">
													<span class="kt-widget31__username">
														Acceptance
													</span>
                                                            <p class="kt-widget31__text">
                                                                98%
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="kt-widget31__content">
                                                        <div class="kt-widget31__info">
													<span class="kt-widget31__username">
														Cancelation
													</span>
                                                            <p class="kt-widget31__text">
                                                                2%
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="kt-widget31__content">
                                                        <div class="kt-widget__action">
                                                            <a href="{{env('APP_URL')}}/drivers/manage/{{$value['fleet_auto_id']}}"
                                                               class="btn btn-label-success btn-sm btn-upper"><i
                                                                    class="fa fa-tools"></i> Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        @endforeach

    </div>
@endsection
<!-- end:: Content -->
