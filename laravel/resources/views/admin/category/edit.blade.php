@extends('admin.general')
@section('content')
    <form method="post" action="{{route('admin.category.edit.save', ['id' => $term->id])}}">
        {{csrf_field()}}
        @include('admin.category._form')
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