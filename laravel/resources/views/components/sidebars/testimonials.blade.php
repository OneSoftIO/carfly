<div class="widget shadow testimonials-widget">
    <div class="widget-title">@lang('page.testimonials')</div>
    <div class="testimonials-carousel">
        <div class="owl-carousel" id="testimonials">
            @foreach($testimonials['option_value']['content'] as $key => $tes)
                @if($tes)
                    <div class="testimonial">
                        <div class="media">
                            <div class="media-body">
                                <div class="testimonial-text">{{$tes}}</div>
                                <div class="testimonial-name">{{ $testimonials['option_value']['name'][$key] }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>