@if(isset($_GET['pickup']))
<div class="widget shadow widget-details-reservation">
    <div class="widget-title">@lang('page.detailed_info')</div>
    <div class="widget-content">
        <h5 class="widget-title-sub">@lang('page.take_destination')</h5>
        <div class="media">
            <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
            <div class="media-body"><p>{{(isset($_GET['pickupDate']))? $_GET['pickupDate'] : null}} / {{isset($_GET['pickupTime'])?$_GET['pickupTime']:null}}</p></div>
        </div>
        <div class="media">
            <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
            <div class="media-body"><p>Nuo {{(isset($_GET['pickup']))? $_GET['pickup'] : null}}</p></div>
        </div>
        <h5 class="widget-title-sub">@lang('page.leave_destination')</h5>
        <div class="media">
            <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
            <div class="media-body"><p>{{(isset($_GET['dropoffDate']))? $_GET['dropoffDate'] : null}} / {{isset($_GET['dropoffTime'])?$_GET['dropoffTime']:null}}</p></div>
        </div>
        <div class="media">
            <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
            <div class="media-body"><p>{{(isset($_GET['dropoff']))? $_GET['dropoff'] : null}}</p></div>
        </div>
        @if($btn)
        <div class="button">
            <span class="btn btn-block btn-radio btn-theme btn-theme-dark toggle">@lang('page.update_search')</span>
        </div>
        @endif
    </div>
</div>
@endif