<section class="page-section contact contact-section">
    <div class="container">
        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>@lang('page.have_questions')</small>
            <span>@lang('page.connect')</span>
        </h2>
        @include('components.notifications.all')
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <!-- Contact form -->
                <form name="contact-form" method="post" action="{{route('send.email')}}" class="contact-form" id="contact-form">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">

                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="name">@lang('page.name')</label>
                                    <input
                                            type="text" name="name" id="name" placeholder="@lang('page.name')" value="" size="30"
                                            data-toggle="tooltip" title="Laukelis privalomas"
                                            class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="email">@lang('page.email_address')</label>
                                    <input
                                            type="text" name="email" id="email" placeholder="@lang('page.email_address')" value="" size="30"
                                            data-toggle="tooltip" title="Laukelis privalomas"
                                            class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group af-inner has-icon">
                        <label class="sr-only" for="input-message">@lang('page.message')</label>
                        <textarea name="message" id="input-message" placeholder="@lang('page.message')" rows="10" cols="50"
                                data-toggle="tooltip" title="Laukelis privalomas"
                                class="form-control placeholder"></textarea>
                        <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                    </div>
                    @include('components.recaptcha')
                    <div class="outer required">
                        <div class="form-group af-inner">
                            <input type="submit" name="submit" class="form-button form-button-submit btn-transparent btn-radio btn btn-block btn-theme ripple-effect btn-theme-dark" id="submit_btn" value="@lang('page.send_msg_bnt')" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">

                <p>
                    @lang('page.contact_content')
                </p>

                <ul class="media-list contact-list">
                    <li class="media">
                        <div class="media-left"><i class="fa fa-user"></i></div>
                        <div class="media-body">„Top Limo“, UAB,</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-home"></i></div>
                        <div class="media-body">@lang('page.address'): Respublikos 28, LT-35174, Panevėžys</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-phone"></i></div>
                        <div class="media-body">@lang('page.phone_nr'): +370 640 80000</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-envelope"></i></div>
                        <div class="media-body">@lang('page.email_address'): <a href="mailto:info@toplimo.lt"> info@toplimo.lt</a></div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->