@extends('order')
@section('content')
    <form id="order" action="{{route('submit.payment', $order->token)}}" method="post">
    {{csrf_field()}}
    <section class="page-section breadcrumbs text-right order-top">
        <div class="container">
            <div class="logo">
                <a href="{{route('main.page')}}"><img src="{{asset('images/logo.svg')}}" alt="CarFly.lt"/></a>
            </div>
            <div class="header-middle-wrapper">
                <a href="tel:+370640 80000" class="phone-number">+370 640 80000</a>
            </div>
            <span>@lang('page.order_id'): <strong>{{$order->booking->id}}</strong></span>
        </div>
    </section>
    @if(($order->isPending() && $order->isCash()) || ($order->isPending() && $order->isPaid()))
        <div class="container">
            <div class="alert alert-warning">
                <span>@lang('page.success_reservation')</span>
            </div>
        </div>
    @endif
    @if($order->booking->isDisapproved())
        <h2 class="text-center">@lang('page.order_canceled')</h2>
    @else
        <section class="status container {{($order->booking->isConfirm())?'confirm':null}}">
            <ol class="progtrckr">
                <li class="progtrckr-done">@lang('page.selected_car')</li>
                <li class="progtrckr-done">@lang('page.reservation')</li>
                <li class="progtrckr-{{($order->isPaid() || $order->isCash())?'done':'todo'}}">@lang('page.confirm_reservation')</li>
                <li class="progtrckr-{{($order->isPaid())?'done':'todo'}}">@lang('page.payment')</li>
                <li class="progtrckr-todo">@lang('page.approved_manager')</li>
            </ol>
        </section>
    @endif
    @if($order->booking->isWaiting() || $order->booking->isConfirm())
    <section class="page-section sub-page order">
        <div class="container">
            <div class="row">
            <div class="col-md-5 col-xs-12">
                    <h4 class="widget-title">@lang('page.booked_car')</h4>
                    <div class="thumbnail no-border no-padding thumbnail-car-card">
                        <div class="media">
                            <img src="{{asset($vehicle->images[0])}}" alt="{{$vehicle->name}}">
                        </div>
                        <div class="caption text-center">
                            <h4 class="caption-title">{{$vehicle->name}}</h4>
                            <table class="table">
                                <tbody><tr>
                                    @if(!empty($vehicle->car_year))
                                        <td><i class="fa fa-car" data-toggle="tooltip" data-original-title="Tekstas"></i> {{$vehicle->car_year}}</td>
                                    @endif
                                    @if(!empty($vehicle->fuel_type))
                                        <td><i class="fa fa-dashboard" data-toggle="tooltip" data-original-title="Tekstas"></i> {{__('car.'.$vehicle->fuel_type)}}</td>
                                    @endif
                                    @if(!empty($vehicle->gearbox))
                                        <td><i class="fa fa-cog" data-toggle="tooltip" data-original-title="Tekstas"></i> {{__('car.'.$vehicle->gearbox)}}</td>
                                    @endif
                                    @if(!empty($vehicle->doors))
                                        <td><i class="fa fa-hdd-o" data-toggle="tooltip" data-original-title="Tekstas"></i> {{$vehicle->doors}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="widget shadow">
                        <div class="widget-title">@lang('page.additional_equipment')</div>
                        <div class="widget-content">
                            @if($services->isNotEmpty())
                            <table class="table">
                                <thead>
                                @foreach($services as $service)
                                @if(!empty($service->translation()))
                                <tr>
                                    <td>{{$service->translation()->name}}</td>
                                    <td class="text-right">{{$service->isFree() ? __('page.free') : $service->service->getTermPriceContent($days). " &euro; /" . __('page.for_day')}}</td>
                                    <td>{{$service->amount}} @lang('page.vnt').</td>
                                </tr>
                                @endif
                                @endforeach
                                </thead>
                            </table>
                            @else
                                <span>@lang('page.not_have')...</span>
                            @endif
                        </div>
                    </div>
                <div class="widget shadow">
                    <div class="widget-title">@lang('page.additional_info')</div>
                    <div class="widget-content">
                        @if($order->isPending() && !$order->isCash())
                        <div class="form-group">
                            <textarea name="message" id="fad-message" class="form-control alt" placeholder="@lang('page.additional_info_content')..." cols="30" rows="5">{{ old('message') }}</textarea>
                        </div>
                        @else
                            <p>{{isset($order->booking->info)?$order->booking->info: __('page.additional_info_not_found') . '...'}}</p>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="widget shadow">
                    <div class="widget-title">
                        @lang('page.info')
                    </div>
                    <div class="widget-content">
                        <div id="responsive-table">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>@lang('page.name_surname')</td>
                                    <td>{{$order->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('page.email_address')</td>
                                    <td>{{$order->user->email}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('page.phone_number')</td>
                                    <td>{{$order->user->phone_number}}</td>
                                </tr>
                                @if($order->booking->address)
                                <tr>
                                    <td>@lang('page.address_or_flying_number2')</td>
                                    <td>{{$order->booking->address}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>@lang('page.living_address')</td>
                                    <td>{{$order->user->address}}</td>
                                </tr>
                                @if(!empty($order->user->company_name))
                                <tr>
                                    <td>@lang('page.company_name')</td>
                                    <td>{{$order->user->company_name}}</td>
                                </tr>
                                @endif
                                @if(!empty($order->user->company_code))
                                    <tr>
                                        <td>@lang('page.company_code')</td>
                                        <td>{{$order->user->company_code}}</td>
                                    </tr>
                                @endif
                                    <tr>
                                        <td>@lang('page.take_destination')</td>
                                        <td> <i class="fa fa-calendar"></i> {{$order->booking->from}}<br> <i class="fa fa-location-arrow"></i>  {{isset($pickup)? $pickup : null}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('page.leave_destination')</td>
                                        <td> <i class="fa fa-calendar"></i> {{$order->booking->until}}<br> <i class="fa fa-location-arrow"></i>  {{isset($dropoff)? $dropoff:null}}</td>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<td>@lang('page.pass_or_')</td>--}}
                                        {{--@if(empty($order->user->passport))--}}
                                        {{--<td><input id="fd-passport" type="text" title="@lang('page.name_surname_required')" name="passport" class="form-control"></td>--}}
                                        {{--@else--}}
                                        {{--<td>{{ (!empty($order->user->driver_license))?$order->user->encodeLastCharOfString($order->user->passport, 3):null }}</td>--}}
                                        {{--@endif--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td>@lang('page.driving_licence')</td>--}}
                                        {{--@if(empty($order->user->driver_license))--}}
                                            {{--<td><input id="fd-id" type="text" name="id" title="@lang('page.name_surname_required')" class="form-control"></td>--}}
                                        {{--@else--}}
                                            {{--<td>{{(!empty($order->user->driver_license))?$order->user->encodeLastCharOfString($order->user->driver_license, 3):null}}</td>--}}
                                        {{--@endif--}}
                                    {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @if($order->isPending() && !$order->isCash())
                <div class="widget shadow">
                    <div class="widget-title">@lang('page.payment')</div>
                    <div class="widget-content">
                        <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
                            @if($onlinePayments->isActive())
                            <div class="panel radio panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne" data-value="paysera">
                                            <span class="dot"></span> @lang('page.ban_trans_or_payment')
                                        </a>
                                        <span class="overflowed pull-right"><img src="{{asset('assets/img/preview/payments/paysera.png')}}" alt=""/></span>

                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body">
                                        @lang('page.paysera_content')
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="panel panel-default {{!$onlinePayments->isActive()?'radio':null}}">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class='{{$onlinePayments->isActive()?'collapsed':null}}' data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="{{!$onlinePayments->isActive()?'true':'false'}}" aria-controls="collapseTwo" data-value="cash">
                                            <span class="dot"></span> @lang('page.cash')
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse {{!$onlinePayments->isActive()?'in':null}}" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body">
                                        @lang('page.cash_content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="widget shadow">
                    <div class="widget-title">@lang('page.prices')</div>
                    <div class="widget-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <td>@lang('page.rental_price_to') {{isset($days)?$days:0}} d.</td>
                                <td>{{$order->price}} &euro;</td>
                            </tr>
                            <tr>
                                <td>@lang('page.shipping_cost')</td>
                                <td>{{$order->delivery_price}} &euro;</td>
                            </tr>
                            <tr>
                                <td>@lang('page.extra_services')</td>
                                <td>{{$order->service_price}} &euro;</td>
                            </tr>
                            <tr>
                                <td><strong>@lang('page.final_price')</strong></td>
                                <td><strong>{{$order->total_price}} &euro;</strong></td>
                            </tr>
                            </thead>
                        </table>
                        @if($order->isPending() && !$order->isCash())
                        <div class="checkbox pull-left" title="@lang('page.confirm_terms')" data-toggle="tooltip">
                                <input id="accept" type="checkbox" name="fd-name">
                                <label for="accept">@lang('page.confirm_with') <a target="_blank" href="{{route('other.page', 'nuomos-salygos')}}">@lang('page.terms').</label>
                            </div>
                            <div class="pull-right">
                                {{--<a href="#" data-toggle="modal" data-target="#help">Pagalbos? </a>--}}
                                <button type="submit" class="btn btn-theme confirm-order">@lang('page.confirm_order')</button>
                            </div>
                        <div class="clearfix"></div>
                        </div>
                        @endif
                </div>
            </div>

            </div>
            </div>


    </section>
    @endif
    </form>
@endsection
@section('header')
    {{--<!-- Modal -->--}}
    {{--<div class="modal fade bs-example-modal-sm" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title" id="myModalLabel">Pagalba</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<h4>Reikia pagalbos?</h4>--}}
                    {{--<p>+3706 25 47 348</p>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-theme">Uždaryti</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
@section('script')
    <script src="{{asset('assets/js/order.js')}}"></script>

@endsection