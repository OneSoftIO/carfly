<section class="page-section faq-section green-bg">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>Dažniausiai Užduodami Klausimai</small>
            <span>DUK</span>
        </h2>

        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach($faq->option_value['title'] as $key => $item)
                    @if(!empty($item))
                            @if($key % 2 === 0)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$key}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                            <span class="dot"></span> {{$item}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                                    <div class="panel-body">
                                    {{$faq->option_value['content'][$key]}}
                                    </div>
                                </div>
                            </div>
                            @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach($faq->option_value['title'] as $key => $item)
                    @if(!empty($item))
                        @if($key%2 !== 0)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$key}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                            <span class="dot"></span> {{$item}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                                    <div class="panel-body">
                                        {{$faq->option_value['content'][$key]}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>


    </div>
</section>