<?php

namespace App\Http\Controllers\Admin;

use App\Meta;
use App\VehiclesTermTranslation;
use App\VehiclesTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VehiclesTerm;
use App\Vehicle;
use App\Price;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VehiclesController extends Controller
{
    protected $base;

    public function __construct()
    {
        $this->base = new \App\Library\Vehicle();
    }

    public function Page(){
        $vehicles = Vehicle::orderBy('ord', 'ASC')->get();
        return view('admin.auto.list', compact('vehicles'));
    }
    public function PageCreate(){
        $terms = VehiclesTerm::all();
        $vehicles = Vehicle::Translate(Lang::locale())->orderBy('ord', 'ASC')->get();

        return view('admin.auto.create', compact('terms', 'vehicles'));
    }
    public function CreateVehicle(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'photos' => 'required'
        ]);
        $images = $this->UploadMultiImages($request,'photos');
        $resizeImages = $this->UploadResizedMultiImages($request,'photos');

        $this->AddVehicle($request, null, $images, $resizeImages);

        return back()->with('success', 'Automobilis pridėtas');
    }
    public function EditVehicle($id, $lang){
        $vehicle = Vehicle::where('id', $id)->translate($lang)->first();
        $terms = VehiclesTerm::all();
        $prices = Price::where('vehicle_id', $id)->get();

        $vehicles = Vehicle::Translate(Lang::locale())->whereNotIn('id', [$vehicle->id])->orderBy('ord', 'ASC')->get();
        $meta = Meta::where('id', $vehicle->info->meta_id)->first();

        return view('admin.auto.edit', compact('vehicle', 'terms', 'prices', 'meta', 'lang', 'vehicles'));
    }
    public function SaveEditedVehicle(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $images = $this->UploadMultiImages($request,'photos');
        $resizeImages = $this->UploadResizedMultiImages($request,'photos');


        $this->AddVehicle($request, $id, $images, $resizeImages);

        return back()->with('success', 'Automobilis atnaujintas');

    }
    public function AddVehicle($request, $id, $images, $resizeImages)
    {
        $imagePath = array();
        $imageResizePath = array();
        if ($request->status == 'on') $postStatus = true;
        else $postStatus = false;

        $terms['value'] = $request->terms;
        if (is_null($id)) {
            $imagePath = $images;
            $imageResizePath = $resizeImages;
        } else {
            $imagePath = Vehicle::find($id)->images;
            $imageResizePath = Vehicle::find($id)->resize_images;
            if (!empty($images)):
                for ($i = 0; $i < sizeof($images); $i++):
                    $imagePath[] = $images[$i];
                    $imageResizePath[] = $resizeImages[$i];
                endfor;
            endif;
        }

        $slug = Str::slug($request->name, '_');
        $vehicleId = Vehicle::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'slug' => (!empty($request->slug)) ? Str::slug($request->slug) : $slug,
                'status' => $postStatus,
                'images' => (!empty($request->photos)) ? $imagePath : Vehicle::find($id)->images,
                'resize_images' => (!empty($request->photos)) ? $imageResizePath : Vehicle::find($id)->resize_images,
                'terms' => $terms,
                'meta_name' => $request->metadata_name,
                'meta_description' => $request->metadata_description,
                'meta_keywords' => $request->metadata_keywords,
                'car_year' => $request->car_year,
                'gearbox' => $request->gearbox,
                'fuel_type' => $request->fuel_type,
                'class' => $request->class,
                'doors' => $request->line
            ]
        );
        $meta = Meta::updateOrCreate([
            'id' => $request->meta_id
        ], [
            'name' => $request->metadata_name,
            'description' => $request->metadata_description,
            'keywords' => $request->metadata_keywords,
        ]);

        VehiclesTranslation::updateOrCreate([
            'vehicle_id' => $vehicleId->id,
            'lang' => $request->lang
        ],
            [
                'meta_id' => $meta->id,
                'description' => $request->description,
                'information' => $request->info,

            ]
        );

        $this->VehiclePrice($request, $vehicleId->id);
        $this->updateVehiclesPositions($vehicleId->id, $request->ord);
    }
    public function VehiclePrice($request, $vehicle_id){
        $pricesSize = sizeof($request->price['from']);
        $prices = $request->price;
        $discount = false;
        for($i =0; $i < $pricesSize; $i++):
            if($prices['value'][$i]):
                Price::updateOrCreate(
                    ['id' => (!empty($prices['id'][$i]) ? $prices['id'][$i] : null)],
                    [
                        'vehicle_id' => $vehicle_id,
                        'from' => $prices['from'][$i],
                        'to' => $prices['till'][$i],
                        'price' => $prices['value'][$i],
                        'discount' => $prices['discount'][$i]
                    ]
                );
            if(!empty($prices['discount'][$i]))
                $discount = true;

            endif;
        endfor;

        Vehicle::where('id', $vehicle_id)->update(['discount' => $discount]);

    }
    public function UploadResizedMultiImages($request, $file){
        $paths = [];
        if ($request->hasFile($file)):
            $images = $request->file($file);
            foreach ($images as $image):
                $imageName = $image->getClientOriginalName();

                $path = public_path('images/resize/' . $imageName);
                $store = Image::make(public_path('images/' . $imageName))->resize(null, 70, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path);
                $paths[] = 'images/resize/' . $imageName;
            endforeach;
        endif;

        return $paths;
    }
    public function UploadMultiImages($request, $file){
        $paths = [];
        if ($request->hasFile($file)):
            $images = $request->file($file);
            foreach ($images as $image):
                $imageName = $image->getClientOriginalName();
                $path = $image->storeAs('images', $imageName);
                $paths[] = $path;
            endforeach;
        endif;

        return $paths;
    }
    public function PageCategory($lang){
        $terms = VehiclesTerm::translate($lang)->get();

        return view('admin.auto.category', compact('terms', 'lang'));
    }
    public function AddCategory(Request $request){
        $termsName = $request->terms;
        $termsPrice = $request->price;
        $termInfo = $request->info;
        $termAmount = $request->amount;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $id = $request->id;

        $this->validate($request, [
            'terms' => 'required'
        ]);

        foreach ($termsName as $key => $name):
            if(!empty($name)):
                $term = VehiclesTerm::updateOrCreate(
                    ['id' => $id[$key]],
                    [
                        'price' => $termsPrice[$key],
                        'amount' => $termAmount[$key],
                        'min_price' => $min_price[$key],
                        'max_price' => $max_price[$key],
                    ]
                );
                VehiclesTermTranslation::updateOrCreate(
                  [
                      'term_id' => $term->id,
                      'lang' => $request->lang
                  ],
                  [
                      'info' => $termInfo[$key],
                      'name' => $termsName[$key]
                  ]
                );
            endif;
        endforeach;

        return back()->with('success', trans('admin.vehicle_auto_category_saved'));
    }
    public function DeleteVehicleImage($id,$sk){
        $image = Vehicle::find($id)->images;
        $resizeImage = Vehicle::find($id)->resize_images;
        unset($image[$sk]);
        unset($resizeImage[$sk]);
        $update = Vehicle::find($id);
        $update->images = array_values($image);
        $update->resize_images = array_values($resizeImage);
        $update->update();
        return $image;
    }

    protected function updateVehiclesPositions(int $vehicle_id, int $ord){
        $vehicles = Vehicle::orderBy('ord', 'ASC')->whereNotIn('id', [$vehicle_id])->pluck('id');
        $arr = [];
        $status = false;
        foreach($vehicles as $key => $item){
            if($key === $ord){
                array_push($arr, $vehicle_id);
                $status = true;
            }
            array_push($arr, $item);
        }

        if($status === false){
            array_push($arr, $vehicle_id);
        }


        foreach($arr as $key => $car_id){
            Vehicle::where('id', $car_id)
                ->update([
                    'ord' => ++$key
                ]);
        }

    }
}
