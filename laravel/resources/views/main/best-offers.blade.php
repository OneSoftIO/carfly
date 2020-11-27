<section class="page-section best-offers-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
            <small>@lang('page.recommended_vehicles')</small>
            <span>@lang('page.best_offer')</span>
        </h2>
        <div class="swiper swiper--offers-best">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($discounts as $vehicle)
                    <div class="swiper-slide">
                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                            <div class="media">
                                <a class="media-link" data-gal="prettyPhoto" href="{{asset($vehicle->images[0])}}">
                                    <img src="{{asset($vehicle->images[0])}}" alt=""/>
                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                </a>
                            </div>
                            <div class="caption text-center">
                                <h4 class="caption-title"><a href="#">{{$vehicle->name}}</a></h4>
                                <div class="caption-text">@lang('page.price_from') @if(!empty($vehicle->price->discount))<span class="old-price">{{$vehicle->price->price}}&euro; </span> <span class="price-discount">{{$vehicle->price->discount}}</span> @else {{$vehicle->price->price}} @endif &euro;/@lang('page.for_day')</div>
                                <div class="buttons">
                                    <a class="btn btn-radio btn-theme ripple-effect" href="{{route('car.page', ['id' => $vehicle->id, 'slug' => $vehicle->slug])}}">@lang('page.rent')</a>
                                </div>
                                <table class="table">
                                    <tr>
                                        @if(!empty($vehicle->car_year))
                                        <td><i class="fa fa-car" data-toggle="tooltip" data-original-title="Tekstas"></i> {{$vehicle->car_year}}</td>
                                        @endif
                                        @if(!empty($vehicle->fuel_type))
                                        <td><i class="fa fa-dashboard" data-toggle="tooltip" data-original-title="Tekstas"></i> {{__('car.'.$vehicle->fuel_type)}}</td>
                                        @endif
                                        @if(!empty($vehicle->gearbox))
                                        <td><i class="fa fa-cog" data-toggle="tooltip" data-original-title="Tekstas"></i> {{__('car.'.$vehicle->gearbox)}}</td>
                                        @endif
                                        @if(!empty($vehicle->doors))
                                        <td><i class="fa fa-hdd-o" data-toggle="tooltip" data-original-title="Tekstas"></i> {{$vehicle->doors}}</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
        </div>
    </div>
</section>