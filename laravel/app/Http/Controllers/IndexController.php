<?php

namespace App\Http\Controllers;

use App\PostMeta;
use App\Price;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Settings;
use App\Post;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function MainPage(){
        $members = Settings::where('option_name', 'members')->first();
        $faq = Settings::where('option_name', 'faq')->first();
        $articles = Post::getActivePost()->take(2)->get();
        $discounts = Vehicle::Discount()->with('price')->get();
        $vehicles = [];
        foreach(Vehicle::getClasses() as $key => $vehicle_class){
            $vehicles[$key] = Vehicle::getActiveVehicles()->with('price')->where('class', $key)->orderBy('ord', 'ASC')->limit(5)->get();
        }
        
        return view('main.main', compact('members', 'articles', 'faq', 'vehicles', 'discounts'));
    }
    public function Logout(){
        Auth::logout();
        return redirect('/');
    }
    public function OtherPage($slug){
        $post = Post::GetActivePageBySlug($slug)->first();
        if(!empty($post->translation))
            return view('other', compact('post'));
        else
            abort(404);
    }

    public function getVehicles(){

        return response()->json([
            'vehicles' => Vehicle::getActiveVehicles()->get(),
        ]);
    }
}
