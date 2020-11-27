<section class="page-section dark about-us-section">
    <div class="container">
        <h2 class="section-title">
            <span>@lang('page.about.title')</span>
        </h2>
        <p class="text-center">@lang('page.about.content')
        </p>
        <ul class="list-icons">
            <li><i class="fa fa-check-circle"></i>@lang('page.about.list.1')</li>
            <li><i class="fa fa-check-circle"></i>@lang('page.about.list.2')</li>
            <li><i class="fa fa-check-circle"></i>@lang('page.about.list.3')</li>
            <li><i class="fa fa-check-circle"></i>@lang('page.about.list.4')</li>
            <li><i class="fa fa-check-circle"></i>@lang('page.about.list.5')</li>
        </ul>
        <p class="btn-row text-center">
            <a href="#form-search" class="btn btn-theme btn-radio js-reserve-btn ripple-effect btn-theme-md">@lang('page.about.reserve_now')</a>
            <a href="{{route('cars.page')}}" class="btn btn-theme btn-radio btn-theme-dark btn-dark-hover ripple-effect btn-theme-md">@lang('page.about.see_all_vehicles')</a>
        </p>
    </div>
</section>