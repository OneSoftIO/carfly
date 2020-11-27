@extends('general')
@section('head','contact-page')
@section('content')
    <section class="page-section color">
        <div class="container">

            <div class="row">

                <div class="col-md-4">
                    <div class="contact-info">

                        <h2 class="block-title"><span>@lang('page.contact')</span></h2>

                        <div class="media-list">
                            <div class="media">
                                <div class="media-body content">
                                    @lang('page.contact_content')
                                </div>
                            </div>
                            <div class="media">
                                <i class="pull-left fa fa-user"></i>
                                <div class="media-body">
                                    <strong>@lang('page.company_field'):</strong><br>
                                    „Top Limo“, UAB,
                                </div>
                            </div>
                            <div class="media">
                                <i class="pull-left fa fa-home"></i>
                                <div class="media-body">
                                    <strong>@lang('page.address'):</strong><br>
                                    Respublikos 28, LT-35174, Panevėžys
                                </div>
                            </div>
                            <div class="media">
                                <i class="pull-left fa fa-phone"></i>
                                <div class="media-body">
                                    <strong>@lang('page.phone_nr'):</strong><br>
                                    +370 640 80000
                                </div>
                            </div>
                            <div class="media">
                                <i class="pull-left fa fa-envelope-o"></i>
                                <div class="media-body">
                                    <strong>@lang('page.email_address'):</strong><br>
                                    <a href="mailto:info@carfly.lt">info@carfly.lt</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-8 text-left">

                    <h2 class="block-title"><span>@lang('page.connect')</span></h2>

                    <!-- Contact form -->
                    <form name="contact-form" method="post" action="{{route('send.email')}}" class="contact-form" id="contact-form">
                    {{csrf_field()}}
                        <div class="outer required">
                            <div class="form-group af-inner">
                                <label class="sr-only" for="name">@lang('page.name')</label>
                                <input
                                        type="text" name="name" id="name" placeholder="@lang('page.name')" value="" size="30"
                                        data-toggle="tooltip" title="@lang('page.name_surname_required')"
                                        class="form-control placeholder"/>
                            </div>
                        </div>

                        <div class="outer required">
                            <div class="form-group af-inner">
                                <label class="sr-only" for="email">@lang('page.email_address')</label>
                                <input
                                        type="text" name="email" id="email" placeholder="@lang('page.email_address')" value="" size="30"
                                        data-toggle="tooltip" title="@lang('page.name_surname_required')"
                                        class="form-control placeholder"/>
                            </div>
                        </div>

                        <div class="form-group af-inner">
                            <label class="sr-only" for="input-message">@lang('page.message')</label>
                            <textarea name="message" id="input-message" placeholder="@lang('page.message')" rows="10" cols="50"
                                    data-toggle="tooltip" title="@lang('page.name_surname_required')"
                                    class="form-control placeholder"></textarea>
                        </div>
                        @include('components.recaptcha')
                        <div class="outer required">
                            <div class="form-group af-inner">
                                <input type="submit" name="submit" class="form-button btn-radio form-button-submit btn btn-theme btn-theme-dark" id="submit_btn" value="@lang('page.send_msg_bnt')" />
                            </div>
                        </div>

                    </form>
                    <!-- /Contact form -->

                </div>

            </div>

        </div>
    </section>
@endsection
@if(!empty($set_meta->getMeta('contacts')->description))
    @section('meta-description', $set_meta->getMeta('contacts')->description)
@endif
@if(!empty($set_meta->getMeta('contacts')->keywords))
    @section('meta-keywords', $set_meta->getMeta('contacts')->keywords)
@endif
@if(!empty($set_meta->getMeta('contacts')->name))
@section('title', $set_meta->getMeta('contacts')->name)
@endif