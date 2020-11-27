@extends('general')
@section('content')
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 content" id="content">
                @include('components.notifications.all')
                <h3 class="block-title alt"><i class="fa fa-angle-down"></i>@lang('page.vehicle_info')</h3>
                <div class="car-big-card alt">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="owl-carousel img-carousel">
                                @if($vehicle->images)
                                    @foreach($vehicle->images as $image )
                                    <div class="item">
                                        <a href="{{asset($image)}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset($image)}}" alt=""/></a>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="row car-thumbnails">
                                @if($vehicle->resize_images)
                                    @foreach($vehicle->resize_images as $key => $image )
                                        <div class="thumbnail-image-holder"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [{{$key}},300]);"><div class="image" style="background-image: url('{{asset($image)}}');"></div> </a></div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="car-details">
                                <div class="list">
                                    <ul>
                                        <li class="title">
                                            <h2>{{$vehicle->name}}</span></h2>
                                           {{$vehicle->car_year}}m. | {{__('car.'.$vehicle->fuel_type)}} | {{__('car.'.$vehicle->gearbox)}}
                                        </li>
                                    </ul>
                                    @if(!empty($vehicle->trans->information))
                                        {!! $vehicle->trans->information !!}
                                    @endif
                                </div>
                                @if(!isset($_GET['pickup']) && isset($vehicle->price->price))
                                    <div class="price">
                                        @lang('page.price_from') <strong>@include('components.discount-price', ['price' => $vehicle->price])</strong> <span>&euro;/@lang('page.for_day')</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="page-divider half transparent"/>
                <form action="{{route('car.page.reserve', ['id' => $vehicle->id])}}" data-redirect="" method="post" class="reservation-form">
                    @if($terms->isNotEmpty())
                    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>@lang('page.extra_accessories')</h3>
                    <div role="form" class="form-extras">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="left">
                                        @foreach($terms as $key => $term)
                                        @if($term->price != null && !empty($term->trans->name))
                                            <div class="checkbox-holder">
                                                <div class="checkbox checkbox-danger">
                                                    <input data-amount='{{$term->hasAmount()?'true':'false'}}' name='services[]' class="term_input" id="checkbox{{$key}}" type="checkbox" value="{{$term->id}}" data-price="{{$term->getTermPriceContent()}}">
                                                    <label for="checkbox{{$key}}">{{$term->trans->name}}
                                                        <span class="pull-right"><span>{{$term->getTermPriceContent()}}</span>{{$term->getTermPriceContent()?' &euro;/'.__('page.per_day'):__('page.free')}}</span>
                                                        @if($term->trans->info)<i data-toggle="tooltip" title="{{$term->trans->info}}" class="fa fa-info-circle info-icon"></i>@endif</label>
                                                </div>
                                                @if($term->hasAmount())
                                                <div class="amount-checkbox">
                                                    <input name='services_amount[{{$term->id}}]' type="number" value="1" min="0" max="5" class="number-checkbox">
                                                    <label for="checkbox{{$key}}">@lang('page.choose_amount')@if($term->trans->info)<i data-toggle="tooltip" title="{{$term->trans->info}}"  class="fa fa-info-circle info-icon"></i>@endif</label>
                                                </div>
                                                @endif
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="right">
                                    @foreach($terms as $key => $term)
                                        @if($term->price == null && !empty($term->trans->name))
                                            <div class="checkbox checkbox-danger">
                                                <input name='services[]' id="checkbox{{$key}}" class="term_input" type="checkbox" {{(isset($term->price))?null:'checked'}} value="{{$term->id}}" data-price="0">
                                                <label for="checkbox{{$key}}">{{$term->trans->name}}
                                                    <span class="pull-right"><span>{{$term->getTermPriceContent()}}</span>{{$term->getTermPriceContent()?' &euro;/'.__('page.per_day'):__('page.free')}}</span>
                                                    @if($term->trans->info && !empty($term->trans->info))<i data-toggle="tooltip" title="{{$term->trans->info}}" class="fa fa-info-circle info-icon"></i>@endif</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row rezervation-info">
                        <div class="col-sm-6">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchUpLocation2">@lang('page.car_take')</label>
                                <select id="pickup-location" class="form-control" name="pickup">
                                    @foreach($deliveries['name'] as $key => $location)
                                        @if(!empty($location))
                                            <option value="{{$key}}" {{(isset($_GET['pickup']) && $_GET['pickup'] == $location)?'selected':null}} {{(!isset($_GET['pickup']) && $loop->first)?'selected':null }}>{{$location}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-6 offLocation">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchOffLocation2">@lang('page.car_leave')</label>
                                <select id="dropoff-location" class="form-control" name="dropoff">
                                    @foreach($deliveries['name'] as $key => $location)
                                        @if(!empty($location))
                                            <option value="{{$key}}" {{(isset($_GET['dropoff']) && $_GET['dropoff'] == $location)?'selected':null}} {{(!isset($_GET['dropoff']) && $loop->first)?'selected':null }}>{{$location}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchUpDate">@lang('page.car_take_date')</label>
                                <input id="pickup-datepicker" type="text" class="form-control date_picker" id="" name="pickupDate" data-value="{{(isset($_GET['pickupDate']))? $_GET['pickupDate'] : $nextDate}}" value="{{old('from')}}">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchOffDate2">@lang('page.time')</label>
                                <select id="pickup-timepicker" class="form-control" name="from_hour">
                                    @for($a=0;$a<24;$a++)
                                        <option {{ (old("from_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":00")?'selected':null}} {{(!isset($_GET['pickupTime']) && $a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                                        <option {{ (old("from_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":15")?'selected':null}} value="{{$a}}:15">{{$a}}:15</option>
                                        <option {{ (old("from_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":30")?'selected':null}} value="{{$a}}:30">{{$a}}:30</option>
                                        <option {{ (old("from_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":45")?'selected':null}} value="{{$a}}:45">{{$a}}:45</option>
                                    @endfor
                                </select>
                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group has-icon has-label">
                                <label for="formSearch">@lang('page.car_back_date')</label>
                               <input id="dropoff-datepicker" type="text" class="form-control date_picker" name="dropoffDate" data-value="{{(isset($_GET['dropoffDate']))? $_GET['dropoffDate'] : $nextWeek}}" value="{{old('until')}}">
                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-icon has-label">
                                <label for="formSearchOffDate2">@lang('page.time')</label>
                                <select id="dropoff-timepicker" class="form-control" name="until_hour">
                                    @for($a=0;$a<24;$a++)
                                        <option {{ (old("until_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":00")?'selected':null}} {{(!isset($_GET['pickupTime']) && $a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                                        <option {{ (old("until_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":15")?'selected':null}} value="{{$a}}:15">{{$a}}:15</option>
                                        <option {{ (old("until_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":30")?'selected':null}} value="{{$a}}:30">{{$a}}:30</option>
                                        <option {{ (old("until_hour") == $a.":00" ? "selected":"") }} {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":45")?'selected':null}} value="{{$a}}:45">{{$a}}:45</option>
                                    @endfor
                                </select>
                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>@lang('page.reservation')</h3>
                    <div class="form-delivery">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="radio radio-inline">
                                    <input type="radio" id="person" value="person" name="type" checked="">
                                    <label for="person"> @lang('page.invidual')</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="company" value="company" name="type">
                                    <label for="company">@lang('page.company')</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="name" id="fd-name" data-person="@lang('page.name_surname'):*" data-company="@lang('page.company_field'):*" title="@lang('page.name_surname_required')" data-toggle="tooltip" class="form-control alt" type="text" placeholder="@lang('page.name_surname'):*" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="email" id="fd-email" title="@lang('page.email_required')" data-toggle="tooltip"
                                           class="form-control alt" type="text" placeholder="@lang('page.email_address'):*" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><input name="phone" id="fd-phone"  title="@lang('page.phone_required')" data-toggle="tooltip" class="form-control alt" type="text" placeholder="@lang('page.phone_number'):*" value="{{old('phone')}}"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><input name="living_address" id="fd-address"  title="@lang('page.name_surname_required')" data-toggle="tooltip" class="form-control alt" type="text" placeholder="@lang('page.living_address'):*" value="{{old('id')}}"></div>
                            </div>
                            <div class="col-md-6 hidden company-input">
                                <div class="form-group"><input name="company_name" id="fd-address"  title="@lang('page.name_surname_required')" data-toggle="tooltip" class="form-control alt" type="text" placeholder="@lang('page.company_name'):*" value="{{old('id')}}"></div>
                            </div>
                            <div class="col-md-6 hidden company-input">
                                <div class="form-group"><input name="company_code" id="fd-phone"  title="@lang('page.phone_required')" data-toggle="tooltip" class="form-control alt" type="text" placeholder="@lang('page.company_code'):*" value="{{old('phone')}}"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"><input name="address" class="form-control alt" type="text" placeholder="@lang('page.address_or_flying_number')" value="{{old('address')}}"></div>
                            </div>

                        </div>
                    </div>


                    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>@lang('page.prices')</h3>
                    <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
                        <ul class="all-price-list">
                            <li class="rent-price"><p>@lang('page.rental_price_to') <span>0</span> d.</p><span class="pull-right">0</span> </li>
                            <li class="deliver-price"><p>@lang('page.shipping_cost')</p><span class="pull-right"></span> </li>
                            <li class="services"><p>@lang('page.extra_services')</p><span class="pull-right">0</span> </li>
                            <li class="total_price"><p>@lang('page.final_price')</p><span class="pull-right">0</span> </li>
                        </ul>
                    </div>
                    <div class="reservation-now">
                        <div class="checkbox pull-left privacy_policy" data-toggle="tooltip" title="@lang('page.required_checkbox_terms')">
                            <input id="accept" type="checkbox" name="privacy_policy" class="privacy_policy" value="1">
                            <label for="accept">@lang('page.privacy_policy') <a target="_blank" href="https://www.carfly.lt/lt/puslapis/privatumo-politika">@lang('page.privacy_policy_url_title').</a></label>
                        </div>
                        <input type="hidden" id="vehicle-id" value="{{$vehicle->id}}">
                        <a class="btn btn-theme btn-radio pull-right btn-reservation-now" href="#">@lang('page.reserve')</a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <aside class="col-md-3 sidebar" id="sidebar">
                @include('components.sidebars.prices')
                @include('components.sidebars.testimonials')
                @include('components.sidebars.help')
            </aside>


        </div>
    </div>
</section>
@include('contact')
@endsection
@section('script')
    <script>
        var labelMonthNext ="Sekantis mėnuo";
        var labelMonthPrev ="Ankstesnis mėnuo";
        var labelMonthSelect="Pasirinkite mėnesį";
        var labelYearSelect="Pasirinkite metus";
        var monthsFull=["Sausis","Vasaris","Kovas","Balandis","Gegužė","Birželis","Liepa","Rugpjūtis","Rugsėjis","Spalis","Lapkritis","Gruodis"];
        var monthsShort=["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rgp","Rgs","Spa","Lap","Grd"];
        var weekdaysFull=["Sekmadienis","Pirmadienis","Antradienis","Trečiadienis","Ketvirtadienis","Penktadienis","Šeštadienis"];
        var weekdaysShort=["Sk","Pr","An","Tr","Kt","Pn","Št"];
        var today="Šiandien";
        var clear="Išvalyti";
        var close="Uždaryti";
        var firstDay=1;
        jQuery(document).ready(function () {
            var $input = jQuery('.date_picker').pickadate({
                format: "yyyy-mm-dd",
                monthsFull: monthsFull,
                monthsShort: monthsShort,
                weekdaysFull: weekdaysFull,
                weekdaysShort: weekdaysShort,
                min: true,
                today: today,
                clear: clear,
                close:close,
                labelMonthNext: labelMonthNext,
                labelMonthPrev: labelMonthPrev,
                labelMonthSelect: labelMonthSelect,
                labelYearSelect: labelYearSelect,
                onOpen: function() {
                    jQuery('.datepicker').blur();
                }
            });
        });
    </script>
    <script src="{{asset('assets/js/car.js?ver='.config('app.versions.js'))}}"></script>

@endsection