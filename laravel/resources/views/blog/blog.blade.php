@extends('general')
@section('content')
    <section class="page-section">
     <div class="container">
                <aside class="col-md-3 sidebar" id="sidebar">
                    @include('components.sidebars.category')
                    @include('components.sidebars.testimonials')
                    @include('components.sidebars.help')
                </aside>
                <div class="content col-md-9" id="content">
                    @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                        @if(!empty($post->translation))
                            <article class="post-wrap">

                                <div class="post-media">
                                    @if($post->hasYoutubeCode())
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
                                    <h2 class="post-title"><a href="{{route('blog.post.page',['id' => $post->id, 'slug' => $post->translation->slug])}}">{{$post->translation->post_title}}</a></h2>
                                    <div class="post-meta">
                                        <span>@lang('page.created'): {{$post->created_at}} / @if($post->cat->isNotEmpty()) @lang('page.categories'): @foreach($post->cat as $cat) <a href="{{route('blog.cat', ['id'=>$cat->id, 'slug' => $cat->translate()->slug])}}">{{$cat->translate()->name}}</a>  @endforeach @endif</span>
                                    </div>
                                </div>
                                <div class="post-body">
                                    <div class="post-excerpt">
                                        <p>{{$post->translation->post_short_content}}</p>
                                    </div>
                                </div>
                                <div class="post-footer">
                                    <span class="post-read-more btn-radio"><a href="{{route('blog.post.page',['id' => $post->id,'slug' => $post->translation->slug])}}" class="btn btn-theme btn-icon-left btn-radio btn-theme-dark">@lang('page.read_more')</a></span>
                                </div>
                            </article>
                            @endif
                    @endforeach


                    @if($posts->links())
                        <div class="pagination-wrapper">
                            {{ $posts->links() }}
                        </div>
                    @endif
                    @else
                        <p>@lang('page.cat_has_no_articles')</p>
                    @endif
                </div>

        </div>
    </section>
    </div>
@endsection
@section('footer_top')
    @include('components.blog-footer')
@stop
@if(!empty($set_meta->getMeta('articles')->description))
    @section('meta-description', $set_meta->getMeta('articles')->description)
@endif
@if(!empty($set_meta->getMeta('articles')->keywords))
    @section('meta-keywords', $set_meta->getMeta('articles')->keywords)
@endif
@if(!empty($set_meta->getMeta('articles')->name))
@section('title', $set_meta->getMeta('articles')->name)
@endif