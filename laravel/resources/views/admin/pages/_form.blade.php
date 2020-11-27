<div class="row">
    <div class="col-lg-9 col-md-9">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-book"></i> Puslapio turinys</h5>
            </div>

            <div class="ibox-content">
                @include('components.notifications.all')
                @include('components.modals.delete')
                <div class="form-group">
                    <label id="t_name">Pavadinimas <i class="text text-danger">*</i></label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name', $post->translation->post_title??null)}}">
                </div>
                <div class="form-group">
                    <label id="status">Rodoma</label><input type="checkbox" class="js-switch form-control" name="status" id="status" {{(isset($post->status) && $post->status)?'checked':null}} />
                </div>
                @if(isset($post->post_type) && $post->post_type == 'post')
                <div class="form-group">
                    <label id="short_description">Trumpas aprašymas</label>
                    <textarea name="short_description" id="short_description" class="form-control">{{$post->translation->post_short_content}}</textarea>
                </div>
                @endif
                <div class="form-group">
                    <textarea name="description" id="editor" class="form-control">{{old('description', $post->translation->post_content?? null)}}</textarea>
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
                @if(isset($post->created_at))
                    <p>Sukurta: <b>{{$post->created_at}}</b></p>
                @endif
                @if(isset($post->updated_at))
                    <p>Atnaujinta: <b>{{$post->updated_at}}</b></p>
                @endif
                <div class="form-group">
                    <select class="form-control @if(isset($lang)) js-on-change-lang @endif" name="lang">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <option  @if(isset($post) && !empty($post->id)) data-href="{{route('admin.post.edit',['id' => $post->id,'lang' => $localeCode])}}" @endif {{isset($lang) && $lang == $localeCode?'selected':null}} value="{{$localeCode}}">{{ $properties['native'] }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{(isset($post->post_type) && $post->post_type == 'page') ? route('admin.pages') : route('admin.posts')}}" class="btn btn-danger"><i class="fa fa-ban"></i> Atšaukti</a>
                <button type="submit" class="btn btn-warning"><i class="fa fa-book"></i>Saugoti</button>
            </div>
        </div>
    </div>
    @if(isset($post->post_type) && $post->post_type == 'post')
    <div class="col-lg-3 col-md-3">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> Kategorijos</h5>
            </div>
            <div class="ibox-content text-center category-wrapper">
                @foreach($terms  as $key => $term)
                    <div class="check">
                        <input id="check{{$key}}" type="checkbox" name="terms[]" value="{{$term->id}}"
                               @for($a = 0; $a < count($activeTerms);$a++)
                                   {{($activeTerms[$a]->term_id == $term->id) ? 'checked' : null}}
                               @endfor
                        />
                        <label for="check{{$key}}">
                            <div class="box"><i class="fa fa-check"></i></div>
                        </label>
                        <label for="check{{$key}}" class="name">{{$term->translate()->name}}</label>
                    </div>
                    @for($i = 0; $i < count($termChild); $i++)
                        @if($term->id == $termChild[$i]->term_group)
                            <div class="check child">
                                <input id="check_child{{$key}}" type="checkbox" name="terms[]" value="{{$termChild[$i]->id}}"
                                @for($a = 0; $a < count($activeTerms);$a++)
                                    {{($activeTerms[$a]->term_id == $termChild[$i]->id) ? 'checked' : null}}
                                @endfor
                                />
                                <label for="check_child{{$key}}">
                                    <div class="box"><i class="fa fa-check"></i></div>
                                </label>
                                <label for="check_child{{$key}}" class="name">{{$termChild[$i]->translate()->name}}</label>
                            </div>
                        @endif
                    @endfor
                @endforeach
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-lg-3 col-md-3">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-picture-o"></i> Pagrindinis paveikslėlis</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <input type="file" name="photo" value="{{old('photo')}}" class="form-control">
                    @if(isset($post->image))
                        <p class="text-center"><br><img src="{{asset($post->image)}}" width="150px"></p>
                        <p class="text-center"><a class="text-danger " href="#" data-href="{{route('admin.delete.post.image', ['id' => $post->id])}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Pašalinti paveikslėlį</a></p>
                    @endif
                </div>
            </div>
        </div>
        @if(isset($post->post_type) && $post->post_type == 'post')
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-picture-o"></i> Youtube nuorodos kodas</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label for="">PVZ: youtube.com/watch?v=<span class="text-danger">wkigo3ZPV</span></label>
                    <input type="text" name="youtube_code" class="form-control" value="{{$post->youtube_code}}">
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="clearfix"></div>
    <div class="col-lg-9 col-md-9">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> Metaduomenys</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label id="t_name">Pavadinimas</label>
                    <input class="form-control" type="text" name="metadata_name" value="{{old('metadata_name', $post->translation->meta_name ?? null)}}" id="t_name">
                </div>
                <div class="form-group">
                    <label id="meta_description">Aprašymas</label>
                    <textarea name="metadata_description" id="meta_description" class="form-control">{{old('meta_description', $post->translation->meta_description ?? null)}}</textarea>
                </div>
                <div class="form-group">
                    <label id="meta_description">Raktažodžiai</label>
                    <textarea name="metadata_keywords" id="meta_keywords" class="form-control">{{old('meta_keywords', $post->translation->meta_keywords ?? null)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>