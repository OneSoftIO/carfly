@extends('general')
@section('content')
    <section class="page-section with-sidebar sub-page">
        <div class="container">
                <div class="content" id="content">
                    <article class="post-wrap post-single">
                        <div class="post-media" >
                            @if(isset($post->youtube_code) && !empty($post->youtube_code) && $post->hasYoutubeCode())
                                <div class="">
                                    <a href="http://youtu.be/{{$post->youtube_code}}" data-gal="prettyPhoto" class="media-link">
                                        <span class="btn btn-play"><i class="fa fa-play"></i></span>
                                        <div class="image-holder" style="background-image: url('{{asset($post->image)}}')"></div></a>
                                    </a>
                                </div>
                            @elseif(!empty($post->image))
                                <a href="{{asset($post->image)}}" data-gal="prettyPhoto">
                                    <div class="image-holder" style="background-image: url('{{asset($post->image)}}')"></div></a>
                            @endif
                        </div>
                        <div class="post-header">
                            <h2 class="post-title">{{$post->trans()->post_title}}</h2>
                            <span>@lang('page.created'): {{$post->created_at}} / @if($post->cat->isNotEmpty()) @lang('page.categories'): @foreach($post->cat as $cat) <a href="{{route('blog.cat', ['id'=>$cat->id, 'slug' => $cat->translate()->slug])}}">{{$cat->translate()->name}}</a>  @endforeach @endif</span>

                        </div>
                        <div class="post-body">
                            <div class="post-excerpt">
                                {!!$post->trans()->post_content!!}
                            </div>
                        </div>
                    </article>
                </div>
        </div>
    </section>
@endsection
@if(!empty($post->translation->meta_description))
    @section('meta-description', $post->trans()->meta_description)
@endif
@if(!empty($post->translation->meta_keywords))
    @section('meta-keywords', $post->trans()->meta_keywords)
@endif
@section('title', $post->trans()->meta_name)
@section('footer_top')
    @include('components.blog-footer')
@stop