@extends('admin.general')
@section('content')
    @include('components.modals.all')
    <form method="post" action="{{route('admin.vehicles.category.save')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> Komplektacija</h5>
                    </div>
                    <div class="ibox-content">
                        @include('components.notifications.all')
                        <div class="row">

                            @if(!count($terms) > 0)
                                <div class="term-block">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label id="name">Pavadinimas</label>
                                            <input class="form-control" type="text" name="terms[]" id="name" value="{{old('terms')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="price">Kaina</label>
                                            <input class="form-control" type="text" name="price[]" id="price" value="{{old('price')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label id="name">Papildoma informacija </label>
                                            <input class="form-control" type="text" name="info[]" id="name" value="{{old('info')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="name">Įjungti kiekio pasirinkimą </label>
                                            <select class="form-control" name="amount[]" id="amount">
                                                <option value="0">Ne</option>
                                                <option value="1">Taip</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="min_price">Minimali užsakymo kaina </label>
                                            <input name="min_price[]" id="min_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="max_price">Didžiausia užsakymo kaina </label>
                                            <input name="max_price[]" id="max_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endif
                            @foreach($terms as $term)
                                <div class="term-block">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label id="name">Pavadinimas<i class="text-danger">*</i></label>
                                            <input class="form-control" type="text" name="terms[]" id="name" value="{{!empty($term->info->name)?$term->info->name:null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label id="price">Kaina</label>
                                            <input class="form-control" type="text" name="price[]" id="price" value="{{$term->price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label id="price"></label>
                                            <a href="#" data-href="{{route('admin.delete', ['table' => 'vehicles_terms', 'id' => $term->id])}}"  class="delete-form-group" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label id="name">Papildoma informacija </label>
                                            <input class="form-control" type="text" name="info[]" id="name" value="{{!empty($term->info->info)?$term->info->info:null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="name">Įjungti kiekio pasirinkimą </label>
                                            <select class="form-control" name="amount[]" id="amount">
                                                <option value="0" {{$term->amount == false?'selected':null}} >Ne</option>
                                                <option value="1" {{$term->amount == true?'selected':null}}>Taip</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="min_price">Minimali užsakymo kaina </label>
                                           <input name="min_price[]" id="min_price" class="form-control" value="{{$term->min_price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label id="max_price">Didžiausia užsakymo kaina </label>
                                            <input name="max_price[]" id="max_price" class="form-control" value="{{$term->max_price}}">
                                        </div>
                                    </div>
                                    <input class="hidden" type="hidden" name="id[]" id="price" value="{{$term->id}}">
                                    <div class="clearfix"></div>
                                </div>
                                @endforeach
                            <div class="form-holder"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5><i class="fa fa-bell-o"></i> Informacija</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <p>* Pašalinus komplektaciją pasišalins ir iš automobilio komplektacijos sąrašo.</p>
                        @if(isset($term->created_at))
                            <p>Sukurta: <b>{{$term->created_at}}</b></p>
                        @endif
                        @if(isset($term->updated_at))
                            <p>Atnaujinta: <b>{{$term->updated_at}}</b></p>
                        @endif
                        <div class="form-group">
                            <select class="form-control js-on-change-lang" name="lang">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <option data-href="{{route('admin.vehicles.category', $localeCode)}}" value="{{$localeCode}}" {{isset($lang) && $lang == $localeCode?'selected':null}}>{{ $properties['native'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="#" class="btn btn-primary add-field"><i class="fa fa-plus"></i> Pridėti laukelį</a>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-book"></i> Saugoti</button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
    <div class="clone-form hidden">
        <div class="term-block">
            <div class="col-md-9">
                <div class="form-group">
                    <label id="name">Pavadinimas<i class="text-danger">*</i> </label>
                    <input class="form-control" type="text" name="terms[]" id="name" value="{{old('terms')}}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label id="price">Kaina</label>
                    <input class="form-control" type="text" name="price[]" id="price" value="{{old('price')}}">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label id="price"></label>
                    <a href="#" data-href=""  class="delete-form-group" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg text-danger"></i></a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label id="name">Papildoma informacija </label>
                    <input class="form-control" type="text" name="info[]" id="name" value="{{old('info')}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="name">Įjungti kiekio pasirinkimą </label>
                    <select class="form-control" name="amount[]" id="amount">
                        <option value="0">Ne</option>
                        <option value="1">Taip</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="min_price">Minimali užsakymo kaina </label>
                    <input name="min_price[]" id="min_price" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label id="max_price">Didžiausia užsakymo kaina </label>
                    <input name="max_price[]" id="max_price" class="form-control">
                </div>
            </div>
            <input class="hidden" type="hidden" name="id[]" id="price" value="">
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
