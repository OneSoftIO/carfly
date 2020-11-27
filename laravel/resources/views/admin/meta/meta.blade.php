@extends('admin.general')
@section('content')
    @include('components.notifications.all')

    <form method="post" action="{{route('admin.meta')}}" enctype="multipart/form-data" >
        {{csrf_field()}}
        @if(\App\Meta::getMetaData() !== null && count(\App\Meta::getMetaData()) > 0)
        @foreach(\App\Meta::getMetaData() as $key => $item)
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-tag"></i> {{$item['name']}}</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label id="metadata_name">Pavadinimas</label>
                    <input class="form-control" type="text" name="name[]" id="metadata_name" value="{{(isset($meta[$item['id']])?$meta[$item['id']]['name']:null)}}">
                </div>
                <div class="form-group">
                    <label id="meta_description">Aprašymas</label>
                    <textarea name="description[]" id="description" class="form-control">{{(isset($meta[$item['id']])?$meta[$item['id']]['description']:null)}}</textarea>
                </div>
                <div class="form-group">
                    <label id="meta_description">Raktažodžiai</label>
                    <textarea name="keywords[]" id="keywords[]" class="form-control">{{(isset($meta[$item['id']])?$meta[$item['id']]['keywords']:null)}}</textarea>
                </div>
            </div>
        </div>
        @endforeach
        <input type="submit" class="btn btn-warning pull-right" value="Išsaugoti">
        <div class="clearfix"></div>
        @endif
    </form>
@endsection