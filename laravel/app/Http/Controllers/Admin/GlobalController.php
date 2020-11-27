<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GlobalController extends Controller
{
    public function DeleteRowFromTable($table, $id){
        DB::table($table)->where('id', $id)->delete();
        return back()->with('success', trans('admin.removed'));
    }
}
