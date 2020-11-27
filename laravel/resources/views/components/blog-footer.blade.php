<div class="footer-widgets">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget"><h4 class="widget-title text-uppercase">@lang('page.about.title')</h4>
                    <p>@lang('page.about.short_title')</p>
                </div>
            </div>
            <div class="col-md-4"><div class="widget"><h4 class="widget-title text-uppercase">@lang('page.newsletter')</h4>
                    <form action="{{route('subscribe')}}" class="form-subscribe2 form-subscribe">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="formSubscribeEmail" class="sr-only" >@lang('page.enter_email_address')</label>
                            <input type="text" name="email" class="form-control subsciber_email" id="formSubscribeEmail" placeholder="@lang('page.email_address')" data-toggle="tooltip" title="@lang('page.enter_email_address')">
                        </div>
                        <div class="checkbox" data-toggle="tooltip" title="@lang('page.required_checkbox_terms')">
                            <input id="accept" type="checkbox" name="privacy_policy" value="1">
                            <label for="accept">@lang('page.privacy_policy') <a target="_blank" href="https://www.carfly.lt/lt/puslapis/privatumo-politika">@lang('page.privacy_policy_url_title').</a></label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-theme btn-theme-dark subscriber_go text-uppercase btn-radio"> @lang('page.take') </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"><div class="widget">
                    <div class="widget-categories">
                        <h4 class="widget-title text-uppercase">@lang('page.useful_links')</h4>
                        <div class="menu-information-container">
                            <ul id="menu-information" class="menu">
                                <li id="menu-item-10350" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10350"><a href="/">@lang('page.menu.main')</a></li>
                                <li id="menu-item-10349" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10349"><a href="{{route('cars.page')}}">@lang('page.vehicles')</a></li>
                                <li id="menu-item-10320" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10320"><a href="{{route('other.page', 'nuomos-salygos')}}">@lang('page.menu.conditions')</a></li>
                                <li id="menu-item-10335" class="menu-item menu-item-type-post_type menu-item-object-page page-item-10147"><a href="{{route('contact.page')}}">@lang('page.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>