<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #F2F4F6; color: #74787E; height: 100%; line-height: 1.4; margin: 0; width: 100% !important; -webkit-text-size-adjust: none;">
<style>
    .footer_text {
        font-family: Avenir, Helvetica, sans-serif;
        box-sizing: border-box;
        line-height: 1.5em;
        margin-top: 0;
        color: #AEAEAE;
        font-size: 12px;
        text-align: center;
    }
    @media  only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media  only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>
<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;"><tr>
        <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                <tr>
                    <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center;">
                        <a href="{{URL::to('/')}}">
                            <img src="{{asset('images/logo.svg')}}" width="250px" alt="@lang('general.domain_name') - @lang('general.title')">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; border-bottom: 1px solid #EDEFF2; border-top: 1px solid #EDEFF2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                            <!-- Body content --><tr>
                                <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                   @yield('content')
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;"><tr>
                                <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                    <p class="footer_text" style="font-size:14px; font-weight: 500;">@lang('emails.footer.name')</p>
                                    <p class="footer_text">@lang('emails.footer.address')</p>
                                    <p class="footer_text" style="text-decoration: underline;">@lang('emails.footer.phone')</p>
                                    <p class="footer_text"><a href="@lang('emails.footer.url')" target="_blank">@lang('emails.footer.url')</a></p>
                                    <p class="footer_text">@lang('emails.footer.copyrights')</p>
                                </td>
                            </tr></table>
                    </td>
                </tr>
            </table>
        </td>
    </tr></table>
</body>
</html>