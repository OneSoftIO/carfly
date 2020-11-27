<?php

namespace App\Providers;

use App\Meta;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Settings;
use View;
use DateTime;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $socials = Settings::where('option_name', 'social')->first();
        $testimonials = Settings::where('option_name', 'testimonials')->first();
        $nextWeek = Carbon::now()->addDay(2)->format('Y-m-d');
        $nextDate = Carbon::now()->addDay()->format('Y-m-d');
        $deliveries = Settings::select('option_value')->where('option_name', 'delivery')->first()->option_value;
        $otherPages = Post::GetActivePage()->get();
        $aboutPage = Post::where('status', true)->where('id',5)->first();
        $set_meta = new Meta();



        View::share( [
            'socials' => $socials,
            'testimonials' => $testimonials,
            'nextWeek' => $nextWeek,
            'nextDate' => $nextDate,
            'deliveries' => $deliveries,
            'otherPages' => $otherPages,
            'aboutPage' => $aboutPage,
            'set_meta' => $set_meta
            ]
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
