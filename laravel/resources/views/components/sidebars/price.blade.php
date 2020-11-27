<div class="widget shadow widget-filter-price">
    <form action="{{route('cars.page')}}" method="get">
        <div class="widget-title">@lang('page.price')</div>
        <div class="widget-content">
            <div id="slider-range"></div>
            <input type="text" name="price" id="amount" readonly />
            <input type="hidden" name="price_from" id="price_from" readonly />
            <input type="hidden" name="price_to" id="price_to" readonly />
            <button type="submit" class="btn btn-radio btn-theme btn-theme-dark">Filtruoti</button>
        </div>
    </form>
</div>
@section('scripts')
<script src="{{asset('assets/js/widget.min.js')}}"></script>
<script src="{{asset('assets/js/mouse.min.js')}}"></script>
<script src="{{asset('assets/js/slider.min.js')}}"></script>
<script>
    jQuery(document).ready(function () {
        var priceSliderRange = $('#slider-range');
        if ($.ui) {
            if ($(priceSliderRange).length) {
                $(priceSliderRange).slider({
                    range: true,
                    min: 0,
                    max: 100,
                    values: [{{(isset($_GET['price_from']))?$_GET['price_from']:0}}, {{(isset($_GET['price_to']))?$_GET['price_to']:100}}],
                    slide: function (event, ui) {
                        $("#amount").val(ui.values[0] + "€ - " + ui.values[1] + "€");
                        $("#price_from").val(ui.values[0]);
                        $("#price_to").val(ui.values[1]);
                    }

                });
                var AmountValue = priceSliderRange.slider("values", 0) + "€ - " +  priceSliderRange.slider("values", 1) + "€";
                var AmountFromValue = priceSliderRange.slider("values", 0);
                var AmountToValue = priceSliderRange.slider("values", 1);

                $("#amount").val(AmountValue);
                $("#price_from").val(AmountFromValue);
                $("#price_to").val(AmountToValue);

            }
        }
    });
</script>
@endsection
@section('style')
<link href="{{asset('assets/css/jquery-ui.css')}}" rel="stylesheet">
@endsection