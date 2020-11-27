@extends('emails.general')
@section('content')
    <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">@lang('emails.hi')</h1>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">@lang('emails.order.accept.content')</p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><strong style="color: #2F3133;">@lang('emails.order.general.orderNoTitle') </strong>{{$id}}</p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><strong style="color: #2F3133;">@lang('emails.order.general.orderUrlTitle') </strong><br><a href="{{$url}}" target="_blank" >@lang('emails.order.general.orderUrl')</a></p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><strong style="color: #2F3133;">@lang('emails.order.accept.info_headline') </strong><br></p>
        <ul>
            <li>@lang('emails.order.accept.info_1')</li>
            <li>@lang('emails.order.accept.info_2')</li>
        </ul>
    <br>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">@lang('emails.order.general.footer')</p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><strong style="color: #2F3133;">@lang('emails.order.general.res_1')</strong> <br> @lang('emails.order.general.res_2')<br></p>
@endsection