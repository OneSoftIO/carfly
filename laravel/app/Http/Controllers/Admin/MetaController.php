<?php

namespace App\Http\Controllers\Admin;

use App\Meta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaController extends Controller
{
    public function index(){
        $getMetaData = Meta::whereNotNull('page_id')->get();
        $meta = [];

        foreach($getMetaData as $item){
            $meta[$item->page_id] = $item;
        }
        return view('admin.meta.meta', compact('meta'));
    }
    public function updateMetaData(Request $request){
        $meta = Meta::getMetaData();

        foreach($meta as $key => $item){
            $where = ['page_id' => $item['id']];
            $query = [
                'name' => $request->name[$key],
                'description' => $request->description[$key],
                'keywords' => $request->keywords[$key]
            ];

            Meta::updateOrCreate($where, $query);
        }


        return back()->with('success', trans('admin.saved'));
    }

}
