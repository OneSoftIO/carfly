<?php

namespace App\Http\Controllers\Admin;

use App\Subscribers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
   	public function Page(Subscribers $subscribers){
        $subscribers = $subscribers->all();

		return view('admin.subscribers.subscribers', compact('subscribers'));
	}
	public function PageMail(){
		return view('admin.subscribers.mail');
	}
    public function remove($id){
	    Subscribers::destroy($id);

	    return back()->with('success', 'Pašalinta sėkmingai');
    }

}
