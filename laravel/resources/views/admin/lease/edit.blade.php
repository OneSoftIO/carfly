@extends('admin.general')
@section('content')
    <form method="post" action="{{route('admin.lease.edit.update', ['id' => $booking->id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('admin.lease._form');
    </form>
@endsection
@section('script')
@endsection