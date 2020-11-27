<div class="row">
    <div class="col-lg-9 col-md-9">
        @if(isset($booking->status) && $booking->status == 'approved' && $booking->order->isPending() ||isset($booking->status) && $booking->order->isCanceled() && $booking->status == 'approved')
            <label class="alert alert-danger">Dėmesio! Jūs patvirtinote rezervaciją, bet apmokėjimo negavote arba jis
                yra atšauktas.</label>
        @endif
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-book"></i> Rezervacija</h5>
            </div>
            <div class="ibox-content">
                @if(isset($booking) && !$booking->Vehicles)
                    <div class="alert alert-danger">
                        Dėmesio! Automobilis duomenų bazėje nerastas
                    </div>
                @endif
                @include('components.notifications.all')
                <div class="form-group">
                    <label id="t_name">Pasirinkite mašiną <i class="text text-danger">*</i></label>
                    <select class="form-control" name="vehicle">
                        @foreach($vehicles as $vehicle)
                            <option {{(isset($booking->car_id) && $booking->car_id == $vehicle->id)? 'selected':null}} value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label id="t_name">Statusas</label>
                    <select class="form-control" name="status">
                        @foreach($status as $key => $stat)
                            <option {{(isset($booking->status) && $booking->status == $key)? 'selected':null}} value="{{$key}}">{{$stat}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-7 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Data nuo <i class="text text-danger">*</i></label>
                            <input type="text" class="form-control datepicker" name="pickupDate" id="datetimepicker6"
                                   value="{{old('from', (isset($booking->from))?$booking->from:null)}}">
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Laikas nuo <i class="text text-danger">*</i></label>
                            <select class="form-control" name="from_hour">
                                @for($i = 0;$i < 24;$i++)
                                    <option {{(isset($booking->from_timestamp) && $booking->fromTime() == $i.":00" ?'selected':null)}} value="{{$i}}:00">{{$i}}
                                        :00
                                    </option>
                                    <option {{(isset($booking->from_timestamp) && $booking->fromTime() == $i.":30" ?'selected':null)}} value="{{$i}}:30">{{$i}}
                                        :30
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Data iki <i class="text text-danger">*</i></label>
                            <input type="text" class="form-control datepicker" name="dropoffDate" id="datetimepicker7"
                                   value="{{old('until', (isset($booking->until))?$booking->until:null)}}">
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Laikas iki <i class="text text-danger">*</i></label>
                            <select class="form-control" name="until_hour">
                                @for($i = 0;$i < 24;$i++)
                                    <option {{(isset($booking->until_timestamp) && $booking->untilTime() == $i.":00" ?'selected':null)}} value="{{$i}}:00">{{$i}}
                                        :00
                                    </option>
                                    <option {{(isset($booking->until_timestamp) && $booking->untilTime() == $i.":30" ?'selected':null)}} value="{{$i}}:30">{{$i}}
                                        :30
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Paėmimo vieta <i class="text text-danger">*</i></label>
                            <select id="pickup-location" class="form-control" name="pickup">
                                @foreach($deliveries['name'] as $key => $location)
                                    @if(!empty($location))
                                        <option value="{{$key}}" {{(isset($booking->pickup) && $booking->pickup == $key)?'selected':null}}>{{$location}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="form-group">
                            <label id="t_name">Grąžinimo vieta <i class="text text-danger">*</i></label>
                            <select id="dropoff-location" class="form-control" name="dropoff">
                                @foreach($deliveries['name'] as $key => $location)
                                    @if(!empty($location))
                                        <option value="{{$key}}" {{(isset($booking->dropoff) && $booking->dropoff == $key)?'selected':null}}>{{$location}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="info">Svarbi informacija</label>
                    <textarea id="info" name="info"
                              class="form-control">{{old('info', (isset($booking->info))?$booking->info:null)}}</textarea>
                </div>
                <div class="form-group">
                    <label>Kur pristatyti automobilį? (adresas arba Jūsų skrydžio numeris)</label>
                    <input type="text" name="address" class="form-control"
                           value="{{old('address',(isset($booking->address))?$booking->address:null)}}">
                </div>
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-puzzle-piece"></i> Komplektacija</h5>
            </div>
            <div class="ibox-content">
                @foreach($terms as $key => $term)
                    <div class="check">
                        <input id="check{{$key}}" type="checkbox"
                               @if(isset($bookingServices))
                               @foreach($bookingServices as $active)
                               {{($active->service_id == $term->id)?'checked':null}}
                               @endforeach
                               @endif
                               name="terms[]"
                               {{(!isset($bookingServices) && empty($term->price))?'checked':null}} value="{{$term->id}}">
                        <label for="check{{$key}}">
                            <div class="box"><i class="fa fa-check"></i></div>
                        </label>
                        <label for="check{{$key}}" class="name">{{$term->transl()->name}}
                            | {{(!empty($term->price))?$term->price . '&euro;':'Free'}}</label>
                    </div>
                    @if($term->hasAmount())
                        <div class="form-group">
                            <div class="col-md-8">
                                <label class="text-right pull-right">Kiekis</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" min="1" value="1" max="5">
                            </div>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <hr>
                @endforeach
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-book"></i> Klientas</h5>
            </div>

            <div class="ibox-content">
                <div class="form-group">
                    <label>Esamas klientas</label>
                    <select name="current_client" class="form-control">
                        @if(!isset($booking))
                            <option value=" ">-</option>
                        @endif
                        @foreach($users as $user)
                            <option {{(isset($booking->user_id) && $booking->user_id == $user->id)? 'selected':null}} value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if(!isset($booking))
                    <hr>
                    <h3 class="text-center">Arba</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Vardas Pavardė <i class="text text-danger">*</i></label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>El.pašto adresas <i class="text text-danger">*</i></label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}">
                            </div>
                        </div>
                        {{--<div class="col-md-6 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                        {{--<label>Vairuotojo pažymėjimo numeris <i class="text text-danger">*</i></label>--}}
                        {{--<input type="text" name="driver_license" class="form-control" value="{{old('driver_license')}}">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Telefono numeris <i class="text text-danger">*</i></label>
                                <input type="text" name="phone_number" class="form-control"
                                       value="{{old('phone_number')}}">
                            </div>
                        </div>
                        {{--<div class="col-md-6 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                        {{--<label>Paso arba ID kortelės numeris </label>--}}
                        {{--<input type="text" name="passport" class="form-control" value="{{old('passport')}}">--}}
                        {{--</div>--}}
                        {{--</div>--}}

                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">

        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-bell-o"></i> Informacija</h5>
            </div>
            <div class="ibox-content text-center">
                @if(isset($post->created_at))
                    <p>Sukurta: <b>{{$post->created_at}}</b></p>
                @endif
                @if(isset($post->updated_at))
                    <p>Atnaujinta: <b>{{$post->updated_at}}</b></p>
                @endif
                <button type="submit" class="btn btn-warning"><i class="fa fa-book"></i> Saugoti</button>
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-dollar"></i> Mokėjimo informacija</h5>
            </div>
            <div class="ibox-content">

                <div class="form-group">
                    <label>Apmokėjimo statusas</label>
                    <select name="payment_status" class="form-control">
                        <option value="pending" {{isset($booking) && $booking->order->isPending()?'selected':null}}>
                            Laukiama apmokėjimo
                        </option>
                        <option value="paid" {{isset($booking) && $booking->order->isPaid()?'selected':null}}>Apmokėta
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{asset('assets/plugins/datetimepicker/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker6').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datetimepicker7').datetimepicker({
                useCurrent: false,
                format: 'YYYY-MM-DD'
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        })
    </script>
@endsection

