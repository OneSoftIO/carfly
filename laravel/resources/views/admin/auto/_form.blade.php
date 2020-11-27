<div class="row">
    <div class="col-lg-9 col-md-9">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-book"></i> Informacija</h5>
            </div>
            <div class="ibox-content">
                @include('components.notifications.all')
                <div class="form-group">
                    <label id="name">Pavadinimas <i class="text text-danger">*</i></label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name', isset($vehicle->name) ? $vehicle->name : null)}}">
                </div>
                <div class="form-group">
                    <label id="status">Rodoma</label>
                    @if(isset($vehicle->status))
                    <input type="checkbox" class="js-switch form-control" name="status" id="status" {{($vehicle->status == true)? 'checked' : null}} />
                    @else
                        <input type="checkbox" class="js-switch form-control" name="status" id="status" checked />
                    @endif
                </div>
                @if(isset($vehicle->slug))
                    <div class="form-group">
                        <label id="slug">Nuoroda</label>
                        <input class="form-control" type="text" name="slug" id="slug" value="{{old('slug', isset($vehicle->slug) ? $vehicle->slug : null)}}" />
                    </div>
                @endif
                @if(isset($vehicles) && $vehicles->isNotEmpty())
                <div class="form-group">
                    <label>Rikiavimas</label>
                    <select class="form-control" name="ord">

                        <option {{isset($vehicle) && 0 === $vehicle->ord?'selected':null}} value="0">Aukščiausia pozicija</option>
                        @foreach($vehicles as $key => $car)
                            <option {{isset($vehicle) && $car->ord === $vehicle->getCurrentOrder() ?'selected':null}} value="{{$car->ord}}">{{$car->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label id="status">Aprašymas <i class="text-danger">*</i> </label>
                    <textarea name="description" id="editor" class="form-control">{{old('description', isset($vehicle->info->description) ? $vehicle->info->description : null)}}</textarea>
                </div>
                <div class="form-group">
                    <label id="info">Automobilio informacija</label>
                    <textarea name="info" id="editor_snd" class="form-control" cols="3">{{old('info', isset($vehicle->info->information) ? $vehicle->info->information : null)}}</textarea>
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
                               @if(isset($vehicle->terms))
                               @for($a = 0; $a < count($vehicle->terms['value']);$a++)
                               {{($vehicle->terms['value'][$a] == $term->id) ? 'checked' : null}}
                               @endfor
                               @endif
                               name="terms[]" value="{{$term->id}}">
                        <label for="check{{$key}}">
                            <div class="box"><i class="fa fa-check"></i></div>
                        </label>
                        <p><label for="check{{$key}}" class="name">{{$term->info->name}}</label> <span class="pull-right">{{($term->isFree())?'NEMOKAMA':$term->price . " EUR"}}</p>
                        <hr style="margin:0;">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> Metaduomenys</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label id="metadata_name">Pavadinimas</label>
                    <input class="form-control" type="text" name="metadata_name" id="metadata_name" value="{{old('metadata_name', $meta->name?? null)}}">
                </div>
                <div class="form-group">
                    <label id="meta_description">Aprašymas</label>
                    <textarea name="metadata_description" id="metadata_description" class="form-control">{{old('metadata_description', $meta->description?? null)}}</textarea>
                </div>
                <div class="form-group">
                    <label id="meta_description">Raktažodžiai</label>
                    <textarea name="metadata_keywords" id="metadata_keywords" class="form-control">{{old('metadata_keywords', $meta->keywords?? null)}}</textarea>
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
                @if(isset($vehicle->created_at))
                    <p>Sukurta: <b>{{$vehicle->created_at}}</b></p>
                @endif
                @if(isset($vehicle->updated_at))
                    <p>Atnaujinta: <b>{{$vehicle->updated_at}}</b></p>
                @endif
                <div class="form-group">
                    <select class="form-control {{(isset($vehicle)?'js-on-change-lang':null)}}" name="lang">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <option @if(isset($vehicle)) data-href="{{route('admin.vehicles.edit', ['lang' => $localeCode, 'id' => $vehicle->id])}}" @endif {{isset($lang) && $lang == $localeCode?'selected':null}} value="{{$localeCode}}">{{ $properties['native'] }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{route('admin.category')}}" class="btn btn-danger"><i class="fa fa-ban"></i> Atšaukti</a>
                <button type="submit" class="btn btn-warning"><i class="fa fa-book"></i>Saugoti</button>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-car"></i> Automobilio informacija</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label id="car_year">Metai:</label>
                    <select class="form-control" name="car_year" id="car_year">
                        @for($i = date("Y"); $i > 1930; $i--)
                            <option value="{{$i}}" {{(isset($vehicle->car_year) && $vehicle->car_year == $i)?'selected':null}}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label id="gearbox">Pavarų dėžė:</label>
                    <select class="form-control" name="gearbox" id="gearbox">
                        <option value="mechanical" {{(isset($vehicle->gearbox) && $vehicle->gearbox == 'Mechaninė')?'selected':null}}>Mechaninė</option>
                        <option value="automatic" {{(isset($vehicle->gearbox) && $vehicle->gearbox == 'Automatinė')?'selected':null}}>Automatinė</option>
                    </select>
                </div>
                <div class="form-group">
                    <label id="fuel_type">Kuro tipas:</label>
                    <select class="form-control" name="fuel_type" id="fuel_type">
                        <option value="petrol" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Benzinas')?'selected':null}}>Benzinas</option>
                        <option value="diesel" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Dyzelis')?'selected':null}}>Dyzelis</option>
                        <option value="electricity" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Elektra')?'selected':null}}>Elektra</option>
                        <option value="petrol&gas" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Benzinas/Dujos')?'selected':null}}>Benzinas/Dujos</option>
                        <option value="diesel&elect" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Dyzelis/Elektra')?'selected':null}}>Dyzelis/Elektra</option>
                        <option value="petrol&elect" {{(isset($vehicle->fuel_type) && $vehicle->fuel_type == 'Benzinas/Elektra')?'selected':null}}>Benzinas/Elektra</option>
                    </select>
                </div>
                <div class="form-group">
                    <label id="line">Vietų skaičius</label>
                    <input class="form-control" type="number" min="1" max="9" name="line" id="line" value="{{old('line', isset($vehicle->doors) ? $vehicle->doors : null)}}" />
                </div>
                @if(\App\Vehicle::getClasses() !== null && count(\App\Vehicle::getClasses()) > 0)
                <div class="form-group">
                    <label id="class">Automobilio klasė</label>
                    <select class="form-control" name="class" id="class">
                        <option value="0">-</option>
                    @foreach(\App\Vehicle::getClasses() as $key => $vehicle_class)
                        <option {{(isset($vehicle) && $vehicle->class === $key?'selected':null)}} value="{{$key}}">{{$vehicle_class['name']}}</option>
                    @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
        <div class="ibox auto-price-wrapper">
            <div class="ibox-title">
                <h5 class="pull-left"><i class="fa fa-euro"></i> Kainos</h5>
                <i class="fa fa-plus text-warning fa-lg pull-right add-price"></i>
            <div class="clearfix"></div>
            </div>
            <div class="ibox-content">
                    <div class="row">
                        @if(isset($prices))
                            @foreach($prices as $price)
                                <div class="price-holder" data-id="{{$price->id}}">
                                    <a href="#" class="text-danger pull-right" data-click="RemovePrice({{$price->id}})" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o "></i> Ištrinti</a>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nuo:</label>
                                            <input class="form-control" type="number" min="1" name="price[from][]" value="{{$price->from}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Iki:</label>
                                            <input class="form-control" type="number" min="1" name="price[till][]" value="{{$price->to}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Kaina: (Parai &euro;)</label>
                                            <input class="form-control" type="text" name="price[value][]" value="{{$price->price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nuolaida: (&euro;)</label>
                                            <input class="form-control" type="text" name="price[discount][]" value="{{$price->discount}}">
                                        </div>
                                    </div>
                                    <input class="form-control" type="hidden" name="price[id][]" value="{{$price->id}}">
                                    <div class="clearfix"></div>
                                    <hr class="no-margin">
                                </div>
                            @endforeach
                        @else
                        <div class="price-holder">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nuo:</label>
                                    <input class="form-control" type="number" min="1" name="price[from][]">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Iki:</label>
                                    <input class="form-control" type="number" min="1" name="price[till][]">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Kaina: (Parai &euro;)</label>
                                    <input class="form-control" type="text" name="price[value][]">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nuolaida: (&euro;)</label>
                                    <input class="form-control" type="text" name="price[discount][]">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="no-margin">
                        </div>
                        @endif

                <div class="price-loop-holder"></div>
                <div class="hidden">
                    <div class="price-holder-clone">
                        <div class="price-holder">
                            <a href="#" class="text-danger pull-right" data-click="RemovePrice()" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o "></i> Ištrinti</a>
                            <div class="clearfix"></div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nuo:</label>
                                    <input class="form-control" type="number" min="1" name="price[from][]">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Iki:</label>
                                    <input class="form-control" type="number" min="1" name="price[till][]" >
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Kaina: (Parai &euro;)</label>
                                    <input class="form-control" type="text" name="price[value][]">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nuolaida: (&euro;)</label>
                                    <input class="form-control" type="text" name="price[discount][]">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="no-margin">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-picture-o"></i> Automobilio nuotraukos</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <input type="file" name="photos[]" multiple value="{{old('photos')}}" class="form-control" accept="image/*">
                    @if(isset($vehicle->resize_images))
                        @foreach($vehicle->resize_images as $key =>  $image)
                        <div class="image-holder" data-sk="{{$key}}">
                            <p class="text-center"><br><img src="{{asset($image)}}" width="150px"></p>
                            <p class="text-center"><a class="text-danger " href="#" data-click="RemoveImage({{$key}}, {{$vehicle->id}})" data-toggle="modal" data-target="#ajax-modal"><i class="fa fa-trash-o fa-lg"></i> Pašalinti paveikslėlį</a></p>
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<input type="hidden" value="{{$vehicle->info->meta_id??null}}" name="meta_id">
@include('components.modals.ajax')
<script>CKEDITOR.replace('editor');</script>
<script>CKEDITOR.replace('editor_snd');</script>
