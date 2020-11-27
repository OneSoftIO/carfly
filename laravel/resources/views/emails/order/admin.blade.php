@extends('emails.general')
@section('content')
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">@lang('emails.order.admin.headline')</p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><b>@lang('emails.order.admin.orderNo')</b>{{$id}}</p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"><b>@lang('emails.order.admin.orderUrl') <a href="{{$url}}" target="_blank" >@lang('emails.order.admin.orderUrlTitle')</a></b></p>
@endsection