<section class="page-section team-section">
    <div class="container">
        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>Mūsų profesionalų komanda</small>
            <span>Komanda</span>
        </h2>
        <div class="row">
            @foreach($members['option_value']['name'] as $key => $member)
                @if($member)
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                @if(!empty($members['option_value']['image'][$key]))
                                <div class="media-object team-avatar" style="background-image: url('{{asset("storage/team/".$members['option_value']['image'][$key])}}');"></div>
                                @endif
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">{{$member}} <small>{{$members['option_value']['position'][$key]}}</small></h4>
                                <ul class="team-details">
                                    @if($members['option_value']['phone'][$key])
                                        <li>Tel: {{$members['option_value']['phone'][$key]}}</li>
                                    @endif
                                    @if($members['option_value']['email'][$key])
                                        <li><a href="mailto:{{$members['option_value']['email'][$key]}}">{{$members['option_value']['email'][$key]}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>