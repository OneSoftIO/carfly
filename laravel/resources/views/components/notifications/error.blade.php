@if ($errors->hasBag())
    <div class="alert alert-danger alert-styled-left alert-bordered" style="width: 100%;">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Uždaryti</span></button>
        @foreach ($errors->unique() as $error)
            <p>{!! $error !!}</p>
        @endforeach
    </div>
@endif