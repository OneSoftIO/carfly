@extends('general')
@section('content')
    <section class="page-section with-sidebar sub-page">
        <div class="container">
            <h2>{{$post->translation->post_title}}</h2>
            {!! $post->translation->post_content !!}
        </div>
    </section>
@endsection
@if(!empty($post->translation->meta_description))
    @section('meta-description', $post->translation->meta_description)
@endif
@if(!empty($post->translation->meta_keywords))
    @section('meta-keywords', $post->translation->meta_keywords)
@endif
@section('title', $post->translation->meta_name)