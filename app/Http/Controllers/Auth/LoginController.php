<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Lang;
use League\Flysystem\Exception;
use App\Models\Location;
use App\Models\MailModel;
use Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest_user')->except(['logout','register']);
    }

    function LoginUser(Request $request){

            $input=$request->all();
            $rules=[
                'email' =>'required|email|max:255',
                'password'  =>'required|string|min:6|max:20',
            ];
            $v=Validator::make($input,$rules);
            if($v->fails()){
                $data['rs']='false';
                return;
            }
            if (Auth::guard('user')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
                \App\Http\Controllers\CartController::setProductsLogin(Auth::guard('user')->user()->id);
                $data['rs']='true';
            }else{
                $data['rs']='user_not_exists';
            }
            echo  json_encode($data);

    }

    function Logout(){
            Auth::guard('user')->logout();
            $sub=Branch::where('type',1)->firstOrFail();
            $slug_user='slug_'.Lang::getLocale();
            return redirect()->route('subsidiary',$sub->$slug_user);
    }

    function Register(Request $request){

        $input=$request->all();
        $rules=[
            'name'  =>'required|string|min:2|max:50',
            'phone'  =>'nullable|string|min:6|max:12',
            'password'  =>'required|confirmed|min:6|max:20',
            'password_confirmation'  =>'required|min:6|max:20',
            'email'                  =>'required|email|max:255'
        ];
        $data['rs']='false';
        $v=Validator::make($input,$rules);
        if($v->fails()){
            echo json_encode($data);
            return;
        }
        $rules=['email'=>'required|email|max:255|unique:users,email'];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['rs']='email_exists';
            echo json_encode($data);
            return;
        }

        $user=new \App\User();
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->phone=$input['phone'];
        $pasword=$input['password'];
        $user->password=bcrypt($pasword);
        $user->save();
        $rs['rs']='true';
        echo  json_encode($rs);
        $mail=MailModel::first();
        $data=[
            'email_admin'=>$mail->from_name,
            'email'     =>$input['email'],
            'name'      =>$user->name,
            'password'  =>$pasword,
        ];
       self::AuthUser($user);
        Mail::send('email.register', $data, function ($message) use ($data) {
            $message->to($data['email'])->from($data['email_admin'], 'Piramida')->subject(trans('l.register_subject'));
        });

    }

    static function AuthUser($user){
        Auth::guard('user')->login($user);
        \App\Http\Controllers\CartController::setProductsLogin(Auth::guard('user')->user()->id);
        return redirect()->back();
    }

}
