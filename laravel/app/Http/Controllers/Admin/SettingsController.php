<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;

class SettingsController extends Controller{
    public function Page(){
        $options = Settings::all();
        return view('admin.settings.settings', compact('options'));
    }

    public function SettingsSave(Request $request){
        $option_name = array('online_payments', 'delivery', 'email', 'members', 'testimonials', 'social', 'faq');

        for ($a = 0; $a < sizeof($option_name); $a++){
            $option = $option_name[$a];
            Settings::updateOrCreate(
                ['option_name' => $option_name[$a]],
                [
                    'option_value' => $request->$option
                ]
            );
        }

        $this->UploadMultiImages($request);
        return back()->with('success', 'Nustatymai atnaujinti');
    }
    public function DeleteDelivery($name, Request $request){
        $option_name = array('delivery', 'members', 'testimonials', 'faq');
        for ($a = 0; $a < sizeof($option_name); $a++){
            $option = $option_name[$a];
            if($option == $name ):
                Settings::updateOrCreate(
                    ['option_name' => $option_name[$a]],
                    [
                        'option_value' => $request->$option
                    ]
                );
            endif;

        }
        return $name;
    }

    public function UploadMultiImages($request){
        $imagesArr = $request->images;
        $photosArr = $request->photos;
        $paths = [];
        if($imagesArr):
            foreach ($imagesArr as $image):
                if($image):
                    $imageName = $image->getClientOriginalName();
                    $image->storeAs('storage/tms', $imageName);
                endif;
            endforeach;
        endif;
        if($photosArr):
            foreach ($photosArr as $image):
                if($image):
                    $imageName = $image->getClientOriginalName();
                    $image->storeAs('storage/team', $imageName);
                endif;
            endforeach;
        endif;
    }
}
