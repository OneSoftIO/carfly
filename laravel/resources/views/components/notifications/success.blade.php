@if (session()->has('success'))
    <div class="alert alert-success alert-styled-left alert-bordered" style="width: 100%;">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Uždaryti</span></button>
        {!! session()->get('success') !!}
    </div>
@endif