<section class="page-section featured-articles-section">
    <div class="container">

        <h2 class="section-title wow fadeInDown dark" data-wow-offset="200" data-wow-delay="100ms">
            <span>@lang('page.featured_articles')</span>
        </h2>

        <div class="row">
            @foreach($articles as $key => $article)
                @if(!empty($article->translation))
                    <div class="col-md-6 wow {{($key == 0)? 'fadeInLeft' : 'fadeInRight'}}" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-href" href="{{route('blog.post.page', ['id' => $article->id, 'slug' => $article->translation->slug])}}">
                                    <div class="article-image" style="background-image: url('{{asset($article->image)}}')"></div>
                                </a>
                                <div class="media-left">
                                    <div class="meta-date">
                                        <div class="day">{{$article->created_at->format('d')}}</div>
                                        <div class="month">{{$article->formatMonth()}}</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{route('blog.post.page', ['id' => $article->id, 'slug' => $article->translation->slug])}}">{{$article->translation->post_title}}</a></h4>
                                    <div class="media-excerpt">{{$article->translation->post_short_content}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="text-center margin-top wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <a href="{{route('blog.page')}}" class="btn btn-theme btn-radio bt-dark ripple-effect btn-theme-light btn-more-posts">@lang('page.all_articles')</a>
        </div>

    </div>
</section>