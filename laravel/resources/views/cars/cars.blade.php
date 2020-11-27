@extends('general')
@section('content')
<section class="page-section with-sidebar sub-page">
    <div class="container">
        @include('components.notifications.alert')
        <div class="row">
            <div class="col-md-9 content car-listing" id="content">
                @if(isset($vehicles))
                    @if($vehicles->isEmpty())
                        <p class="widget-title text-center"> @lang('page.not_found_cars')</p>
                    @else
                    @foreach($vehicles as $key => $vehicle)
                    <div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                        <div class="media">
                            @if($vehicle->price->hasDiscount())
                                <div class="label label-discount">@lang('page.discount')</div>
                            @endif
                            <a class="media-link" href="{{route('car.page', ['id' => $vehicle->id, 'slug' => $vehicle->slug, 'pickup' => app('request')->input('pickup'), 'dropoff' => app('request')->input('dropoff'), 'pickupDate' => app('request')->input('pickupDate'), 'pickupTime' => app('request')->input('pickupTime'),'dropoffTime' => app('request')->input('dropoffTime') , 'dropoffDate' => app('request')->input('dropoffDate')] )}}">
                                <div class="image" style="background-image: url('{{asset($vehicle->images[0])}}')"></div>
                            </a>

                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="{{route('car.page', ['id' => $vehicle->id, 'slug' => $vehicle->slug])}}">{{$vehicle->name}}</a>
                                <span class="pull-right show-price" data-toggle="modal" data-target="#vehicle{{$key}}">@lang('page.more_informations')</span>
                            </h4>
                            <div class="pull-left">
                            @if(request()->has('pickup'))
                                <div class="more-info">
                                    <p>@lang('page.rent_for_day')
                                        <span>
                                            @if($vehicle->price->hasDiscount())
                                                <span class="old-price">{{$vehicle->getPrice(request())['price']}}&euro;</span>
                                                <span class="price-discount">{{$vehicle->getPrice(request())['discount']}}&euro;</span>
                                            @else
                                                {{$vehicle->getPrice(request())['price']}}&euro;
                                            @endif
                                        </span>
                                    </p>
                                    <p>@lang('page.rent_price') <span>{{Helper::finalDays(request())}}</span> @lang('page.for_days') <span>
                                             @if($vehicle->price->hasDiscount())
                                                <span class="old-price">{{$vehicle->getPrice(request())['price'] * Helper::finalDays(request())}}&euro;</span>
                                                <span class="price-discount">{{$vehicle->getPrice(request())['discount'] * Helper::finalDays(request())}}&euro;</span>
                                            @else
                                             {{$vehicle->getPrice(request())['price'] * Helper::finalDays(request())}}&euro;
                                             @endif

                                        </span></p>

                                </div>
                            @else
                                @if(isset($vehicle->price))
                                    <h5 class="caption-title-sub">@lang('page.price_from') @if($vehicle->price->hasDiscount()) <span class="old-price">{{$vehicle->price->price}}&euro;</span> <span class="price-discount">{{$vehicle->price->discount}} &euro;</span>@else<span class="price">{{$vehicle->price->price}} &euro;</span>@endif/@lang('page.for_day')</h5>
                                @endif
                            @endif
                            </div>
                            <div class="clearfix"></div>
                            <div class="caption-text">@if(!empty($vehicle->trans->description)) {!! $vehicle->trans->description !!} @endif</div>
                            <table class="table">
                                <tr>
                                    @if($vehicle->car_year)
                                        <td><i class="fa fa-car" data-toggle="tooltip" title="Tekstas"></i> {{$vehicle->car_year}}</td>
                                    @endif
                                    @if($vehicle->fuel_type)
                                        <td><i class="fa fa-dashboard" data-toggle="tooltip" title="Tekstas"></i> {{__('car.'.$vehicle->fuel_type)}}</td>
                                    @endif
                                    @if($vehicle->gearbox)
                                        <td><i class="fa fa-cog" data-toggle="tooltip" title="Tekstas"></i> {{__('car.'.$vehicle->gearbox)}}</td>
                                    @endif
                                    @if($vehicle->doors)
                                        <td><i class="fa fa-hdd-o" data-toggle="tooltip" title="Tekstas"></i> {{$vehicle->doors}}</td>
                                    @endif
                                    <td class="buttons"><a class="btn btn-theme" href="{{route('car.page', ['id' => $vehicle->id, 'slug' => $vehicle->slug, 'pickup' => app('request')->input('pickup'), 'dropoff' => app('request')->input('dropoff'), 'pickupDate' => app('request')->input('pickupDate'), 'pickupTime' => app('request')->input('pickupTime'),'dropoffTime' => app('request')->input('dropoffTime') , 'dropoffDate' => app('request')->input('dropoffDate')] )}}">@lang('page.look_over')</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <div class="pagination-wrapper">
                        {{$vehicles->links()}}
                    </div>
                    @endif
                @else
                    @include('components.notifications.warning')
                @endif
            </div>
            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar" id="sidebar">
               @include('components.sidebars.detail-reservation', ['btn' => true])
                @include('components.sidebars.search')
               @include('components.sidebars.price')
               @include('components.sidebars.testimonials')
               @include('components.sidebars.help')
            </aside>
            <!-- /SIDEBAR -->

        </div>
    </div>
</section>
@include('contact')
@endsection
@section('footer')
    @if(isset($vehicles))
    @foreach($vehicles as $key => $vehicle)
        <div class="modal fade vehicle-modal" id="vehicle{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{$vehicle->name}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <p class="sub-headline">@lang('page.machine_occupancy')</p>
                                <div id="datetimepicker{{$key}}" disabled="true"></div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <p class="sub-headline">@lang('page.prices')</p>
                                @include('components.price-table', ['prices'=>$vehicle->prices])
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('car.page', ['id' => $vehicle->id, 'slug' => $vehicle->slug])}}" class="btn btn-radio btn-theme">@lang('page.look_over')</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif;
@endsection
@section('js')
    @if(isset($vehicles))
    <script type="text/javascript">
        $(function () {
            @foreach($vehicles as $key => $vehicle)
           $('#datetimepicker{{$key}}').datetimepicker({
                locale: 'lt',
                inline: true,
                sideBySide: true,
                format: 'YYYY-MM-DD',
                ignoreReadonly: true,
                disabledDates: [
                    @foreach($vehicle->bookings as $dates)
                    @if($dates->isConfirm())
                    <?php
                        $start = \Carbon\Carbon::createFromFormat('Y-m-d', substr($dates->from, 0, 10));
                        $end = \Carbon\Carbon::createFromFormat('Y-m-d', substr($dates->until, 0, 10));
                        $dates = [];
                    ?>
                    <?php while ($start->lte($end)) {
                        echo "moment('".$start->copy()->format('Y-m-d') . "'), ";
                        $start->addDay();
                    }?>
                    @endif
                    @endforeach
                ],
            });
        @endforeach
        });

    </script>
    @endif
@endsection
@if(!empty($set_meta->getMeta('auto-list')->description))
    @section('meta-description', $set_meta->getMeta('auto-list')->description)
@endif
@if(!empty($set_meta->getMeta('auto-list')->keywords))
    @section('meta-keywords', $set_meta->getMeta('auto-list')->keywords)
@endif
@if(!empty($set_meta->getMeta('auto-list')->name))
@section('title', $set_meta->getMeta('auto-list')->name)
@endif