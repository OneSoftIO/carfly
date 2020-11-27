@extends('admin.general')
@section('content')
    <form method="post" action="{{route('admin.lease.add.save')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('admin.lease._form')
    </form>

@endsection
@section('script')
@endsection