@extends('admin.general')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="ibox">
            @include('components.notifications.all')
                {{ Form::open(array('url' => route('users.update'), 'method' => 'put')) }}
                {{ csrf_field() }}


                {{ Form::close() }}
                </div>
            </form>
        </div>
    </div>
@stop