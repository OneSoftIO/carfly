@extends('admin.general')
@section('content')
    <form method="post" action="{{route('admin.vehicles.edit.save', ['id' => $vehicle->id])}}" enctype="multipart/form-data" >
        {{csrf_field()}}
        @include('admin.auto._form')
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem);
        });
    </script>
@endsection