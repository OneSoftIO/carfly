@if(!empty($vehicles) && count($vehicles) > 0)
<section class="page-section cars-list-section">
    <div class="container">
        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <span>@lang('page.select_what_you_want')</span>
        </h2>
        @if(\App\Vehicle::getClasses() !== null && count(\App\Vehicle::getClasses()))
        <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <ul id="tabs1" class="nav">
                @foreach(\App\Vehicle::getClasses() as $key => $vehicle_class)
                @if(count($vehicles[$key]) > 0)
                    <li class="{{$loop->first?'active':null}}"><a href="#tab-x{{$key}}" data-toggle="tab" aria-expanded="false">{{$vehicle_class['name']}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="tab-content">
            @foreach(\App\Vehicle::getClasses() as $class_key => $vehicle_class)
            @if(count($vehicles[$class_key]) > 0)
            <div class="tab-pane fade {{$loop->first?'active in':null}}" id="tab-x{{$class_key}}">
                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs4" class="nav">
                                    @foreach($vehicles[$class_key] as $key => $car)
                                        <li class="{{($loop->first)?'active':null}}"><a href="#tab-x{{$class_key}}x{{$key++}}" data-toggle="tab">{{$car->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div class="tab-content">
                                    @foreach($vehicles[$class_key] as $key => $car)
                                        <div class="tab-pane fade {{($loop->first)?'active in':null}}" id="tab-x{{$class_key}}x{{$key++}}">
                                            <div class="row">
                                                <div class="col-md-8 car-photo">
                                                        @if(!empty($car->images))
                                                            @foreach($car->images as  $key => $image)
                                                                @if($key == 0)
                                                                    <div class="swiper-slide">
                                                                        <a href="{{asset($image)}}" data-gal="prettyPhoto">
                                                                            <img class="img-responsive" width="100%" src="{{asset($image)}}" alt=""/>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            @lang('page.price_from') <strong>@include('components.discount-price', ['price' => $car->price])</strong> <span>&euro;/@lang('page.for_day')</span>
                                                        </div>
                                                        <div class="list">
                                                            {!! $car->info->information !!}
                                                        </div>
                                                        <div class="button">
                                                            <a href="{{route('car.page', ['id' => $car->id, 'slug' => $car->slug])}}" class="btn btn-radio btn-theme ripple-effect btn-theme-dark btn-block">@lang('page.reserve')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
