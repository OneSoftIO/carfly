<section class="page-section subscribe subscribe-section green-bg">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>@lang('page.subscribe_top')</small>
            <span>@lang('page.subscribe')</span>
        </h2>
        <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center">@lang('page.subscribe_content')</p>
                <form action="{{route('subscribe')}}" class="form-subscribe">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="formSubscribeEmail" class="sr-only" >@lang('page.enter_email_address')</label>
                        <input type="text" name="email" class="form-control" id="formSubscribeEmail" placeholder="@lang('page.email_address')" data-toggle="tooltip" title="@lang('page.enter_email_address')">
                    </div>
                    <button type="submit" class="btn btn-submit btn-theme ripple-effect btn-theme-dark">@lang('page.take')</button>
                    <div class="checkbox" data-toggle="tooltip" title="@lang('page.required_checkbox_terms')">
                        <input id="accept" type="checkbox" name="privacy_policy" value="1">
                        <label for="accept">@lang('page.privacy_policy') <a target="_blank" href="https://www.carfly.lt/lt/puslapis/privatumo-politika">@lang('page.privacy_policy_url_title').</a></label>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>