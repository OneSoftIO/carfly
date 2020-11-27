<div class="widget shadow widget-filter-price">
        <div class="widget-title">@lang('page.prices')</div>
        <div class="widget-content">
            @include('components.price-table', ['prices'=>$vehicle->prices])
        </div>
</div>