<section class="page-section no-padding slider">
    <div class="container full-width">
        <div class="main-slider">
                <div class="item ver2">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div>
                                    <div class="caption-content">
                                        <!-- Search form -->
                                        <div id="form-search" class="form-search light">
                                            <form action="{{route('cars.page')}}" method="get">
                                                <div class="form-title">
                                                    <h2>@lang('page.find_auto')</h2>
                                                </div>
                                                <div class="fast-search-form">
                                                    <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchUpLocation2">@lang('page.car_take')</label>
                                                            <select class="form-control" name="pickup">
                                                                @foreach($deliveries['name'] as $key => $location)
                                                                    @if(!empty($location))
                                                                    <option>{{$location}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            <div class="checkbox checkbox-radio has-label">
                                                                <input id="off" type="checkbox" class="showOffLocation">
                                                                <label for="off">@lang('page.leave_another_place')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 offLocation" style="display: none;">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchOffLocation2">@lang('page.car_leave')</label>
                                                            <select class="form-control" name="dropoff">
                                                                @foreach($deliveries['name'] as $key => $location)
                                                                    @if(!empty($location))
                                                                        <option>{{$location}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                        <div class="col-sm-8 col-xs-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpDate">@lang('page.car_take_date')</label>
                                                                <input type="text" class="form-control date_picker" id="pickup_date" name="pickupDate" data-value="{{$nextDate}}">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-5">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate2">@lang('page.time')</label>
                                                                <select class="form-control" name="pickupTime">
                                                                    @for($a=0;$a<24;$a++)
                                                                        <option {{($a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                                                                        <option value="{{$a}}:15">{{$a}}:15</option>
                                                                        <option value="{{$a}}:30">{{$a}}:30</option>
                                                                        <option value="{{$a}}:30">{{$a}}:45</option>
                                                                    @endfor
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8 col-xs-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate2">@lang('page.car_back_date')</label>
                                                                <input type="text" class="form-control date_picker" name="dropoffDate" data-value="{{$nextWeek}}">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xs-5">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate2">@lang('page.time')</label>
                                                                <select class="form-control" name="dropoffTime">
                                                                    @for($a=0;$a<24;$a++)
                                                                        <option {{($a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                                                                        <option value="{{$a}}:15">{{$a}}:15</option>
                                                                        <option value="{{$a}}:30">{{$a}}:30</option>
                                                                        <option value="{{$a}}:30">{{$a}}:45</option>
                                                                    @endfor
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                        </div>
                                                </div>
                                                <button type="submit" id="formSearchSubmit2" class="btn bt-transparent btn-dark-hover btn-submit btn-theme btn-radio ripple-effect">@lang('page.btn.see_price')</button>
                                                <div class="clearfix"></div>

                                            </div>
                                            </form>
                                        </div>
                                        <div class="slider-content">
                                            <h2 class="caption-subtitle">@lang('page.slide.headline')
                                            </h2>
                                            <ul>
                                                <li>@lang('page.slide.1')</li>
                                                <li>@lang('page.slide.2')</li>
                                                <li>@lang('page.slide.3')</li>
                                            </ul>
                                            <p class="caption-text">
                                                <a class="btn btn-theme ripple-effect btn-theme-md btn-radio" href="{{route('cars.page')}}">@lang('page.btn.all_vehicles')</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="features-container row">
                                        <div class="block-holder">
                                            <div class="block-wrapper">
                                                <div class="image-holder">
                                                    <img src="{{asset('images/vehicle_icon.png')}}">
                                                </div>
                                                <span>@lang('page.slide_box.1-headline')</span>
                                                <div class="content">
                                                    <p>@lang('page.slide_box.1-content')</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-holder">
                                            <div class="block-wrapper">
                                                <div class="image-holder">
                                                    <img src="{{asset('images/key_icon.png')}}">
                                                </div>
                                                <span>@lang('page.slide_box.2-headline')</span>
                                                <div class="content">
                                                    <p>@lang('page.slide_box.2-content')</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-holder">
                                            <div class="block-wrapper">
                                                <div class="image-holder">
                                                    <img src="{{asset('images/time_icon.png')}}">
                                                </div>
                                                <span>@lang('page.slide_box.3-headline')</span>
                                                <div class="content">
                                                    <p>@lang('page.slide_box.3-content')</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
</section>
@section('script')
    <script>
        // Strings and translations
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
                firstDay: 1,
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
@endsection