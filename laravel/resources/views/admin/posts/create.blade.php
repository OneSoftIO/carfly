@extends('admin.general')
@section('content')
   <form method="post" action="{{route('admin.post.save')}}" enctype="multipart/form-data">
       {{csrf_field()}}
       <div class="row">
           	<div class="col-lg-9 col-md-9">
               		<div class="ibox">
                   			<div class="ibox-title">
                       				<h5><i class="fa fa-book"></i> Įrašo turinys</h5>
                       			</div>
                   			<div class="ibox-content">
                       				@include('components.notifications.all')
                       				<div class="form-group">
                           					<label id="name">Pavadinimas <i class="text text-danger">*</i></label>
                           					<input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                           				</div>
                       				<div class="form-group">
                           					<label id="status">Rodoma</label>
                           					<input type="checkbox" class="js-switch form-control" name="status" id="status" checked />
                           				</div>
                       				<div class="form-group">
                           					<label id="status">Trumpas aprašymas</label>
                           					<textarea name="short_description" class="form-control">{{old('short_description')}}</textarea>
                           				</div>
                       				<div class="form-group">
                           
                           					<textarea name="description" id="editor" class="form-control">{{old('description')}}</textarea>
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
                       				<div class="form-group">
                           					<select class="form-control @if(isset($lang))js-on-change-lang @endif" name="lang">
                               						@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                   							<option data-href="{{route('admin.post.create', $localeCode)}}"  {{isset($lang) && $lang == $localeCode?'selected':null}} value="{{$localeCode}}">{{ $properties['native'] }}</option>
                                   						@endforeach
                               					</select>
                           				</div>
                       				<a href="{{route('admin.posts')}}" class="btn btn-danger"><i class="fa fa-ban"></i> Atšaukti</a>
                       				<button type="submit" class="btn btn-warning"><i class="fa fa-book"></i>Saugoti</button>
                       			</div>
                   		</div>
               	</div>
           	<div class="col-lg-3 col-md-3">
               		<div class="ibox">
                   			<div class="ibox-title">
                       				<h5><i class="fa fa-tag"></i> Kategorijos</h5>
                       			</div>
                   			<div class="ibox-content text-center category-wrapper">
                       				@foreach($terms  as $key => $term)
                           					<div class="check">
                               						<input id="check{{$key}}" type="checkbox" name="terms[]" value="{{$term->id}}"/>
                               						<label for="check{{$key}}">
                                   							<div class="box"><i class="fa fa-check"></i></div>
                                   						</label>
                               						<label for="check{{$key}}" class="name">{{$term->translate()->name}}</label>
                               					</div>
                           					@for($i = 0; $i < count($termChild); $i++)
                               						@if($term->id == $termChild[$i]->term_group)
                                   							<div class="check child">
                                       								<input id="check_child{{$key}}" type="checkbox" name="terms[]" value="{{$termChild[$i]->id}}"/>
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
           	<div class="col-lg-3 col-md-3">
               		<div class="ibox">
                   			<div class="ibox-title">
                       				<h5><i class="fa fa-picture-o"></i> Pagrindinis paveikslėlis</h5>
                       			</div>
                   			<div class="ibox-content">
                       				<div class="form-group">
                           					<input type="file" name="photo" class="form-control">
                           				</div>
                       			</div>
                   		</div>
               	</div>
           	<div class="col-lg-3 col-md-3">
               		<div class="ibox">
                   			<div class="ibox-title">
                       				<h5><i class="fa fa-picture-o"></i> Youtube nuorodos kodas</h5>
                       			</div>
                   			<div class="ibox-content">
                       				<div class="form-group">
                           					<label for="">PVZ: youtube.com/watch?v=<span class="text-danger">wkigo3ZPV</span></label>
                           					<input type="text" name="youtube_code" value="{{old('youtube_url')}}" class="form-control">
                           				</div>
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
                           					<input class="form-control" type="text" name="metadata_name" id="metadata_name" value="{{old('metadata_name')}}">
                           				</div>
                       				<div class="form-group">
                           					<label id="meta_description">Aprašymas</label>
                           					<textarea name="metadata_description" id="metadata_description" class="form-control">{{old('metadata_description')}}</textarea>
                           				</div>
                       				<div class="form-group">
                           					<label id="meta_description">Raktažodžiai</label>
                           					<textarea name="metadata_keywords" id="metadata_keywords" class="form-control">{{old('metadata_keywords')}}</textarea>
                           				</div>
                       			</div>
                   		</div>
               	</div>
           </div>
       </form>
   
   @endsection
-@section('script')
   <script>
       $(document).ready(function () {
           	var elem = document.querySelector('.js-switch');
           	var init = new Switchery(elem);
           });
       </script>
   @endsection