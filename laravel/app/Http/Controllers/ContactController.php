<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Settings;
use App\Subscribers;
class ContactController extends Controller
{

    public function Page(){
        return view('contact.contact');
    }
    public function SendMail(Request $request){
        $adminEmail = Settings::where('option_name', 'email')->first()->option_value;

        $this->validate($request, [
            'name' => 'required',
            'message' => 'required',
            'email' => 'required|email'
        ]);
        $response = $request->captcha;
        $secret = config('app.recaptcha');

        $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");

        $captcha_success=json_decode($verify);

        if ($captcha_success->success === false)
            return response()->json(['status' => false, 'message' => trans('page.validate_recaptcha')]);

        $data =  array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('message'),
            'adminEmail' => $adminEmail,
        );

        Mail::send('emails.contact',$data, function($message) use ($data){
            $message->from($data['email']);
            $message->to($data['adminEmail']);
            $message->subject('Nauja žinutė');
        });

        return response()->json(['status' => true, 'message' => trans('page.message_was_send')]);
    }
    public function Subscribe(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'privacy_policy' => 'required'
        ]);
        $email = $request->email;
        if(Subscribers::where('email',$email)->first())
            return response()->json(['message' => 'Toks el.paštas jau registruotas', 'status' => 'danger']);

            $sub = new Subscribers;
            $sub->email = $email;
            $sub->privacy_policy = $request->privacy_policy;
            $sub->ip = $request->ip();
            $sub->save();

        return response()->json(['message' => 'Ačiū! El.paštas užregistruotas', 'status' => 'success']);
    }
}
