<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\User;
use URL;
use Lang;
use App\Models\MailModel;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest_user');
    }

    function ResetFromEmail(Request $request){
        $input=$request->all();
        $rules=['email'=>'required|max:255|email'];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['rs']='error';
            echo  json_encode($data);
            return;
        }
        $rules=['email'=>'required|max:255|email|exists:users,email'];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['rs']='user_not_exist';
            echo  json_encode($data);
            return;
        }
        $data['rs']='true';
        echo  json_encode($data);
        $user=User::where('email',$input['email'])->first();
        $user->time=Carbon::now()->toDateTimeString();
        $user->remember_token=csrf_token();
        $user->save();
        $sub=Branch::where('type',1)->first();
        $slug_user='slug_'.Lang::getLocale();
        $link=URL::route('subsidiary',$sub->$slug_user).'?code='.$user->remember_token;
        $mail=MailModel::first();

        $data=[
            'link'  =>$link,
            'email' =>$user->email,
            'email_admin'=>$mail->from_name,

        ];
        Mail::send('email.reset', $data, function ($message) use ($data) {
            $message->to($data['email'])->from($data['email_admin'], 'Piramida')->subject(trans('l.forgot_password'));
        });


    }

    function ResetPassword(Request $request){
        $input=$request->all();
        $rules=[
            'password'=>'required|string|min:6|max:20|confirmed',
            'password_confirmation'  =>'required|min:6|max:20',
            'remember_token'        =>'required|exists:users,remember_token'
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['rs']='false1';
            echo  json_encode($data);
            return;
        }
        $us=User::where('remember_token',$input['remember_token'])->first();
        if($us){
            $current =Carbon::now();
            $current=strtotime($current->subMinute(30));
            $time=strtotime($us->time);
            if($current<=$time){
                $user=$us;
                $user->password=bcrypt($input['password']);
                $user->remember_token=csrf_token();
                $user->save();
                $data['rs']='true';
                echo  json_encode($data);
                \App\Http\Controllers\Auth\LoginController::AuthUser($user); //login user delete session
            }else{
                $data['rs']='false4';
                echo  json_encode($data);
            }
        }else{
            $data['rs']='false5';
            echo  json_encode($data);
        }


    }
}
