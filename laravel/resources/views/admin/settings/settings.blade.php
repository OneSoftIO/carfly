@extends('admin.general')
@section('content')
    <form action="{{route('admin.settings.save')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    @foreach($options as $key => $option)

@if($option->option_name == 'online_payments')
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> Nustatymai</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <h4>Apmokėjimas internetu</h4>
                        <div class="radio">
                            <label>
                                <input type="radio" name="online_payments" id="payments" value="0" {{($option->option_value == 0)?'checked':null}}>
                                Išjungti
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="online_payments" id="payments" value="1" {{($option->option_value == 1)?'checked':null}}>
                                Įjungti
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($option->option_name == 'delivery')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 class="pull-left"><i class="fa fa-tag"></i> Pristatymo punktai</h5>
                    <i class="fa fa-plus fa-lg text-warning pull-right hover pointer" onclick="AddRow('delivery')"></i>
                    <div class="clearfix"></div>
                </div>
                <div class="ibox-content">
                    <p>* <strong>Dienų iki</strong> - Jeigu 0, vadinasi skaičiuojasi nuo "Dienų nuo" iki xxx dienų.</p>

                    <div class="row">
                        <ul class="delivery-holder no-list">
                            @if($option->option_value)
                            @foreach($option->option_value['name'] as $key => $term)
                            @if($term)
                            <li data-row="{{$key}}">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Pavadinimas</label>
                                        <input class="form-control" type="text" name="delivery[name][]" value="{{old('value[delivery][price][]', $term)}}" id="t_name">
                                    </div>
                                </div>
                               <div class="clearfix"></div>
                                <div class="prices-list-container">
                                    @if(isset($option->option_value['date_from'][$key]))
                                    @foreach($option->option_value['date_from'][$key] as $price_key => $value)
                                        @if(!empty($value))
                                        <div class="prices-list output">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Dienų nuo</label>
                                                    <input class="form-control" type="number" min="1" max="99" name="delivery[date_from][{{$key}}][]" value="{{$option->option_value['date_from'][$key][$price_key]}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Dienų iki</label>
                                                    <input class="form-control" type="number" min="0" max="99" name="delivery[date_to][{{$key}}][]" value="{{$option->option_value['date_to'][$key][$price_key]}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Kaina</label>
                                                    <input class="form-control" type="number" name="delivery[price][{{$key}}][]" value="{{$option->option_value['price'][$key][$price_key]}}" id="t_name">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    @else
                                        <div class="prices-list output">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Dienų nuo</label>
                                                    <input class="form-control" type="number" min="1" max="99" name="delivery[date_from][{{$key}}][]" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Dienų iki</label>
                                                    <input class="form-control" type="number" min="0" max="99" name="delivery[date_to][{{$key}}][]" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Kaina</label>
                                                    <input class="form-control" type="number" min="0" name="delivery[price][{{$key}}][]" id="t_name">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="pull-right">
                                <p><a class="text-warning add_price_row" data-row="{{$key}}" href="#"><i class="fa fa-plus fa-lg"></i> Pridėti kainą</a></p>
                                <p><a class="text-danger" href="#" data-click="RemoveRow({{$key}}, 'delivery')" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o fa-lg"></i> Pašalinti pristatymo punktą</a></p>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                            </li>
                            @endif
                            @endforeach
                            @else
                                <li>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Pavadinimas</label>
                                            <input class="form-control" type="text" name="delivery[name][]" value="{{old('value[delivery][price][]')}}" id="t_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Pristatymo kaina</label>
                                            <input class="form-control" type="text" name="delivery[price][]" value="{{old('delivery[price][]')}}" id="t_name">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="delivery-clone clone">

                    </div>
                    <div class="delivery-clone-holder hidden">
                        <div class="delivery-holder row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label id="t_name">Pavadinimas</label>
                                    <input class="form-control" type="text" name="delivery[name][]" id="t_name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label id="t_name">Pristatymo kaina</label>
                                    <input class="form-control" type="text" name="delivery[price][]" id="t_name">
                                </div>
                            </div>
                            <span class="text-danger pull-right delete-group pointer"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($option->option_name == 'faq')

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="pull-left"><i class="fa fa-tag"></i> DUK</h5>
                            <i class="fa fa-plus fa-lg text-warning pull-right hover pointer" onclick="AddRow('faq')"></i>
                            <div class="clearfix"></div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <ul class="faq-holder no-list">
                                    @if($option->option_value)
                                        @foreach($option->option_value['title'] as $key => $term)
                                            @if($term)
                                                <li data-row="{{$key}}">
                                                    <div class="col-md-8 col-sm-12">
                                                        <div class="form-group">
                                                            <label id="t_name">Pavadinimas</label>
                                                            <input class="form-control" type="text" name="faq[title][]" value="{{old('faq[title][]', $term)}}" id="t_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label id="t_name">Tekstas</label>
                                                            <textarea class="form-control" name="faq[content][]">{{$option->option_value['content'][$key]}}</textarea>
                                                        </div>
                                                    </div>
                                                    <a class="text-danger pull-right" href="#" data-click="RemoveRow({{$key}}, 'faq')" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</a>
                                                    <div class="clearfix"></div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Pavadinimas</label>
                                                    <input class="form-control" type="text" name="faq[title][]" value="{{old('faq[title][]')}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Tekstas</label>
                                                    <textarea class="form-control" name="faq[content][]"></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="faq-clone clone">

                            </div>
                            <div class="faq-clone-holder hidden">
                                <div class="faq-holder row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Pavadinimas</label>
                                            <input class="form-control" type="text" name="faq[title][]" value="{{old('faq[title][]')}}" id="t_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Tekstas</label>
                                            <textarea class="form-control" name="faq[content][]"></textarea>
                                        </div>
                                    </div>
                                    <span class="text-danger pull-right delete-group pointer"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @if($option->option_name == 'email')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 class="pull-left"><i class="fa fa-tag"></i> Nustatymai</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label id="t_name">El.pašto adresas</label>
                        <input class="form-control" type="text" name="email" value="{{old('email', ($option->option_value) ? $option->option_value : null)}}" id="t_name">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($option->option_name == 'members')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5 class="pull-left"><i class="fa fa-user"></i> Komanda</h5>
                        <i class="fa fa-plus fa-lg text-warning pull-right hover pointer" onclick="AddRow('members')"></i>
                        <div class="clearfix"></div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <ul class="members-holder no-list">
                            @if($option->option_value)
                                @foreach($option->option_value['name'] as $key => $term)
                                    @if($term)
                                    <li data-row="{{$key}}">
                                        <div data-row="">
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Nuotrauka</label>
                                                    <input type="file" class="form-control file_image" name="photos[]">
                                                    <input type="hidden" class="image_name" name="members[image][]" value="{{(isset($option->option_value['image'][$key])) ? $option->option_value['image'][$key] : null}}">
                                                    @if(isset($option->option_value['image'][$key]))
                                                        <img src="{{asset("storage/team/".$option->option_value['image'][$key])}}" width="80px">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Vardas Pavardė</label>
                                                    <input class="form-control" type="text" name="members[name][]" value="{{$term}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Pareigos</label>
                                                    <input class="form-control" type="text" name="members[position][]" value="{{$option->option_value['position'][$key]}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Telefono numeris</label>
                                                    <input class="form-control" type="text" name="members[phone][]" value="{{$option->option_value['phone'][$key]}}" id="t_name">
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">El.paštas</label>
                                                    <input class="form-control" type="text" name="members[email][]" value="{{$option->option_value['email'][$key]}}" id="t_name">
                                                </div>
                                            </div>
                                            <a class="text-danger pull-right" href="#" data-click="RemoveRow({{$key}}, 'members')" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            @else

                                <li data-row="">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Vardas Pavardė</label>
                                            <input class="form-control" type="text" name="members[name][]" value="" id="t_name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Pareigos</label>
                                            <input class="form-control" type="text" name="members[position][]" value="" id="t_name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Telefono numeris</label>
                                            <input class="form-control" type="text" name="members[phone][]" value="" id="t_name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">El.paštas</label>
                                            <input class="form-control" type="text" name="members[email][]" value="" id="t_name">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            @endif
                        </div>

                        <div class="members-clone clone">

                        </div>
                        <div class="members-clone-holder hidden">
                            <div class="members-holder row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Vardas Pavardė</label>
                                        <input class="form-control" type="text" name="members[name][]" value="" id="t_name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Pareigos</label>
                                        <input class="form-control" type="text" name="members[position][]" value="" id="t_name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Telefono numeris</label>
                                        <input class="form-control" type="text" name="members[phone][]" value="" id="t_name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">El.paštas</label>
                                        <input class="form-control" type="text" name="members[email][]" value="" id="t_name">
                                    </div>
                                </div>
                                <span class="text-danger pull-right delete-group pointer"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($option->option_name == 'testimonials')

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="pull-left"><i class="fa fa-tag"></i> Atsiliepimai</h5>
                            <i class="fa fa-plus fa-lg text-warning pull-right hover pointer" onclick="AddRow('testimonials')"></i>
                            <div class="clearfix"></div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <ul class="testimonials-holder no-list">
                                    @if($option->option_value)
                                        @foreach($option->option_value['name'] as $key => $term)
                                            @if($term)
                                                <li data-row="{{$key}}">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label id="t_name">Nuotrauka</label>
                                                            <input class="form-control file_image" type="file" name="images[]">
                                                            <input type="hidden" class="image_name" name="testimonials[image][]" value="{{(isset($option->option_value['image'][$key])) ? $option->option_value['image'][$key] : null}}">
                                                        </div>
                                                        @if($option->option_value['image'][$key])
                                                            <img src="{{asset("storage/tms/".$option->option_value['image'][$key])}}" width="80px">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label id="t_name">Vardas Pavardė</label>
                                                            <input class="form-control" type="text" name="testimonials[name][]" value="{{$term}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label id="t_name">Atsiliepimas</label>
                                                            <textarea class="form-control" name="testimonials[content][]">{{$option->option_value['content'][$key]}}</textarea>
                                                        </div>
                                                    </div>
                                                    <a class="text-danger pull-right" href="#" data-click="RemoveRow({{$key}}, 'testimonials')" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</a>
                                                    <div class="clearfix"></div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Nuotrauka</label>
                                                    <input class="form-control file_image" type="file" name="images[]">
                                                    <input type="hidden" class="image_name" name="testimonials[image][]" >
                                                </div>
                                                <div class="form-group">
                                                    <label id="t_name">Vardas Pavardė</label>
                                                    <input class="form-control" type="text" name="testimonials[name][]">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label id="t_name">Atsiliepimas</label>
                                                    <textarea class="form-control" name="testimonials[content][]"></textarea>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="testimonials-clone clone">

                            </div>
                            <div class="testimonials-clone-holder hidden">
                                <div class="testimonials-holder row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Nuotrauka</label>
                                            <input class="form-control file_image" type="file" name="images[]">
                                            <input type="hidden" class="image_name" name="testimonials[image][]" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Vardas Pavardė</label>
                                            <input class="form-control" type="text" name="testimonials[name][]">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label id="t_name">Atsiliepimas</label>
                                            <textarea class="form-control" name="testimonials[content][]"></textarea>
                                        </div>
                                    </div>
                                    <span class="text-danger pull-right delete-group pointer"><i class="fa fa-trash-o fa-lg"></i> Pašalinti</span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($option->option_name == 'social')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="pull-left"><i class="fa fa-tag"></i> Socialiniai tinklai</h5>
                            <i class="fa fa-user fa-lg text-warning pull-right hover pointer" onclick="AddRow('testimonials')"></i>
                            <div class="clearfix"></div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Facebook URL</label>
                                        <input class="form-control" type="text" name="social[facebook]" value="{{(isset($option->option_value['facebook']))? $option->option_value['facebook'] : null}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Instagram Vartotojo Vardas</label>
                                        <input class="form-control" type="text" name="social[instagram]" value="{{(isset($option->option_value['instagram']))? $option->option_value['instagram'] : null}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Twitter URL</label>
                                        <input class="form-control" type="text" name="social[twitter]" value="{{(isset($option->option_value['twitter']))? $option->option_value['twitter'] : null}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Pinterest URL</label>
                                        <input class="form-control" type="text" name="social[pinterest]" value="{{(isset($option->option_value['pinterest']))? $option->option_value['pinterest'] : null}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="t_name">Google URL</label>
                                        <input class="form-control" type="text" name="social[google]" value="{{(isset($option->option_value['google']))? $option->option_value['google'] : null}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <input type="submit" class="btn btn-warning pull-right" value="Išsaugoti">
    <div class="clearfix"></div>
    </form>
    @include('components.modals.ajax')
@endsection