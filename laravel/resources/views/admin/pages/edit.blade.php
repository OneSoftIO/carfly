@extends('admin.general')
@section('content')
    <form method="post" action="{{route('admin.post.edit.save', ['id' => $post->id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('admin.pages._form')
    </form>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem);
        })
    </script>
@endsection