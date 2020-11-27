<section class="page-section testimonials testimonials-section">
    <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials">
                @foreach($testimonials['option_value']['image'] as $key => $tes)
                    @if($tes)
                    <div class="testimonial">
                        <div class="media">
                            <div class="media-left">
                                <div class="media-object testimonial-avatar" style="background-image: url('{{asset("storage/tms/".$tes)}}');"></div>
                            </div>
                            <div class="media-body">
                                <div class="testimonial-text">{{$testimonials['option_value']['content'][$key]}}</div>
                                <div class="testimonial-name">{{$testimonials['option_value']['name'][$key]}}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>