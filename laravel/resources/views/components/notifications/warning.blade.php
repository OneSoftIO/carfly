@if (session()->has('warning'))
    <div class="alert alert-warning alert-styled-left alert-bordered" style="width: 100%;">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Uždaryti</span></button>
        {!! session()->get('warning') !!}
    </div>
@endif