<div class="row">
    <div class="col-lg-9 col-md-9">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-book"></i> Kategorija</h5>
            </div>
            <div class="ibox-content">
                @include('components.notifications.all')
                <div class="form-group">
                    <label id="name">Pavadinimas <i class="text text-danger">*</i></label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name', $term->trans->name ?? null)}}">
                </div>
                <div class="form-group">
                    <label id="status">Rodoma</label>
                    @if(isset($term->status)):
                        <input type="checkbox" class="js-switch form-control" name="status" id="status" {{($term->status == true)? 'checked' : null}} />
                    @else
                        <input type="checkbox" class="js-switch form-control" name="status" id="status" checked />
                    @endif
                </div>
                <div class="form-group">
                    <label id="status">Tėvinė kategorija</label>
                    <select class="form-control" name="parent">
                        <option value="0">-</option>
                        @if(isset($term->id))
                            @foreach($terms as $cat)
                                @if($cat->id != $term->id && $cat->term_group == 0 )
                                    <option {{($term->term_group == $cat->id)? 'selected' : null }} value="{{$cat->id}}">{{$cat->translate()->name}}</option>
                                @endif
                            @endforeach
                        @else
                            @foreach($terms as $cat)
                                <option value="{{$cat->id}}">{{$cat->translate()->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label id="status">Trumpas aprašymas</label>
                    <textarea name="description" id="editor" class="form-control">{{old('description', $term->trans->description ?? null)}}</textarea>
                </div>
                <script>CKEDITOR.replace('editor');</script>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-bell-o"></i> Informacija</h5>
            </div>
            <div class="ibox-content text-center">
                @if(isset($term->created_at))
                    <p>Sukurta: <b>{{$term->created_at}}</b></p>
                @endif
                @if(isset($term->updated_at))
                    <p>Atnaujinta: <b>{{$term->updated_at}}</b></p>
                @endif
                <div class="form-group">
                    <select class="form-control @if(isset($lang)) js-on-change-lang @endif" name="lang">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <option @if(isset($lang)) data-href="{{route('admin.category.edit',['id' => $term->id,'lang' => $localeCode])}}" @endif {{isset($lang) && $lang == $localeCode?'selected':null}} value="{{$localeCode}}">{{ $properties['native'] }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{route('admin.category')}}" class="btn btn-danger"><i class="fa fa-ban"></i> Atšaukti</a>
                <button type="submit" class="btn btn-warning"><i class="fa fa-book"></i>Saugoti</button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-9 col-md-9">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> Metaduomenys</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label id="metadata_name">Pavadinimas</label>
                    <input class="form-control" type="text" name="metadata_name" id="metadata_name" value="{{old('metadata_name', $term->trans->meta_name?? null)}}">
                </div>
                <div class="form-group">
                    <label id="meta_description">Aprašymas</label>
                    <textarea name="metadata_description" id="metadata_description" class="form-control">{{old('metadata_description', $term->trans->meta_description ?? null)}}</textarea>
                </div>
                <div class="form-group">
                    <label id="meta_description">Raktažodžiai</label>
                    <textarea name="metadata_keywords" id="metadata_keywords" class="form-control">{{old('metadata_keywords', $term->trans->meta_keywords ?? null)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>