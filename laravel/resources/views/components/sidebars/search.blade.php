<div class="widget shadow widget-find-car {{(isset($_GET['pickup']))?'hidden':null}}">
    <div class="widget-title">@lang('page.fast_search')</div>
    <div class="widget-content">
        <div class="form-search light">
            <form action="{{route('cars.page')}}" method="get">

                <div class="form-group has-icon has-label">
                    <label for="formSearchUpLocation3">@lang('page.car_take')</label>
                    <select class="form-control" name="pickup">
                        @foreach($deliveries['name'] as $key => $location)
                            @if(!empty($location))
                                <option {{(isset($_GET['pickup']) && $_GET['pickup'] == $location)?'selected':null}}>{{$location}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>

                <div class="form-group has-icon has-label">
                    <label for="formSearchOffLocation3">@lang('page.car_leave')</label>
                    <select class="form-control" name="dropoff">
                        @foreach($deliveries['name'] as $key => $location)
                            @if(!empty($location))
                                <option {{(isset($_GET['dropoff']) && $_GET['dropoff'] == $location)?'selected':null}}>{{$location}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>

                <div class="form-group has-icon has-label">
                    <label for="formSearchUpDate3">@lang('page.car_take_date')</label>
                    <input type="text" class="form-control date_picker" id="" name="pickupDate" data-value="{{$nextDate}}" ">
                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                </div>

                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>@lang('page.taken_time')</label>
                    <select class="form-control" name="pickupTime">
                        @for($a=0;$a<24;$a++)
                            <option {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":00")?'selected':null}} {{(!isset($_GET['pickupTime']) && $a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                            <option {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":15")?'selected':null}} value="{{$a}}:15">{{$a}}:15</option>
                            <option {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":30")?'selected':null}} value="{{$a}}:30">{{$a}}:30</option>
                            <option {{(isset($_GET['pickupTime']) && $_GET['pickupTime'] == $a.":45")?'selected':null}} value="{{$a}}:30">{{$a}}:45</option>
                        @endfor
                    </select>
                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="form-group has-icon has-label">
                    <label for="formSearchOffDate2">@lang('page.car_back_date')</label>
                    <input type="text" class="form-control date_picker" name="dropoffDate" data-value="{{$nextWeek}}">
                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                </div>
                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>@lang('page.back_time')</label>
                    <select class="form-control" name="dropoffTime">
                        @for($a=0;$a<24;$a++)
                            <option {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":00")?'selected':null}} {{(!isset($_GET['pickupTime']) && $a == 11)? 'selected':null}} value="{{$a}}:00">{{$a}}:00</option>
                            <option {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":15")?'selected':null}} value="{{$a}}:15">{{$a}}:15</option>
                            <option {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":30")?'selected':null}} value="{{$a}}:30">{{$a}}:30</option>
                            <option {{(isset($_GET['dropoffTime']) && $_GET['dropoffTime'] == $a.":45")?'selected':null}} value="{{$a}}:30">{{$a}}:45</option>
                        @endfor
                    </select>
                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                </div>

                <button type="submit" id="formSearchSubmit3" class="btn btn-radio btn-submit btn-theme btn-theme-dark btn-block">@lang('page.search_vehicles')</button>

            </form>
        </div>
        <!-- /Search form -->
    </div>@section('script')
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
</div>