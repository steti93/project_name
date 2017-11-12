<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Models\MailModel;
use App;
use League\Flysystem\Exception;
use Validator;
use Mail;
use Image;
use Illuminate\Support\Facades\File;
use Lang;
use Illuminate\Validation\Rule;
use Config;
use Illuminate\Support\Facades\Schema;
use App\Models\SectionPage;
use App\Models\Section;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use DB;

class AdminController extends Controller
{
    static $lang_data=['en'=>'EN'];
    public function __construct(){
        $this->middleware('admin');
    }

    function Admin(){

        return view('admin.admin');
    }

    function returnEncode($string){
        if(mb_detect_encoding($string)=='ASCII'){
            return trim( html_entity_decode($string, ENT_QUOTES, 'UTF-8'));
        }else{
            return  trim(mb_convert_encoding ($string,'Windows-1252'));
        }

    }

    function insertSlug($item,&$input,$model,$subsidary=null){
        if(!is_null($subsidary)){
            $routeCollection = Route::getRoutes();
            $routes_array=[];
            foreach($routeCollection as $route){
                $routes_array[]=$route->getAction()['as'];
            }
        }
        foreach(self::$lang_data as $lang=>$key){
            $slug='slug_'.$lang;
            if(empty($input[$slug])){
                $name=isset($input['name_'.$lang])? str_slug($input['name_'.$lang]) : str_slug($input['title_'.$lang]);
                $temp=$model::where($slug,$name)->where('id','!=',$input['id'])->first();
                if($temp){
                    $input['exists_slug']=true;
                    $item->$slug=$name.'-'.$input['id'];
                }else{
                    $input['exists_slug']=false;
                    $item->$slug=$name;
                }
                if(!is_null($subsidary) && in_array($name,$routes_array)){

                    $obj=App\Models\Branch::where($slug,$input[$slug])->first();

                    if($obj){
                        if($obj->id!=$input['id']){
                            $item->$slug=$name.'-'.$input['id'];
                        }
                    }else{
                        $item->$slug=$name.'-'.$input['id'];
                    }
                }
            }else{
                $temp=$model::where('id','!=',$input['id'])->where($slug,$input[$slug])->first();
                if($temp){
                    $input['exists_slug']=true;
                    $item->$slug=$input[$slug].'-'.$input['id'];
                }else{
                    $input['exists_slug']=false;
                    $item->$slug=$input[$slug];
                }
                if(!is_null($subsidary) && in_array($input[$slug],$routes_array)){
                    $obj=App\Models\Branch::where($slug,$input[$slug])->first();
                    if($obj){
                        if($obj->id!=$input['id']){
                            $item->$slug=$input[$slug].'-'.$input['id'];
                        }
                    }else{
                        $item->$slug=$input[$slug].'-'.$input['id'];
                    }
                }
            }
        }
        return $item;
    }
    function setSort(&$item,$input,$object){
        if(empty($input['sort'])){
            $max=$object;
            if(isset($input['id_parent'])){
                $max=$max->where('id_parent',$input['id_parent'])->max('sort');
            }else {
                $columns = Schema::getColumnListing($object->getTable());

                if (in_array('id_parent',$columns)) {
                    $max=$max->where('id_parent',0)->max('sort');
                } else {
                    $max=$max->max('sort');
                }
            }

            $item->sort=$max+1;
        }else{
            $item->sort=$input['sort'];
        }
        return $item;
    }
    function getInput(&$item,$input,$data){
        foreach($data as $value){
            foreach(self::$lang_data as $lang=>$va){
                $temp=$value.$lang;
                if(isset($input[$temp])){
                    $item->$temp=isset($input[$temp])? $input[$temp] : '';
                }
            }
        }
        return $item;
    }
    //===============EMAIL========================//
    function Email(){
        $mail=MailModel::first();
        return view('admin.mail',compact('mail'));
    }
    function EditEmail(Request $request){
        $input=$request->all();

        $rules=[
            'driver'    =>'required|string|max:10|min:2',
            'host'      =>'required|string|min:5|max:30',
            'port'      =>'numeric|min:1|max:9999',
            'from_name'     =>'required|string|min:3|max:50',
            'encryption'    =>'required|string|min:2|max:10',
            'username'      =>'required|string|min:5|max:50|email',
            'password'      =>'required|string|min:5|max:50',
        ];

        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        $save=MailModel::first();
        $edit=MailModel::first();
        $edit->driver=$input['driver'];
        $edit->host=$input['host'];
        $edit->port=$input['port'];
        $edit->from_address=$input['username'];
        $edit->from_name=$input['from_name'];
        $edit->encryption=$input['encryption'];
        $edit->username=$input['username'];
        $edit->password=$input['password'];
        $edit->save();
        try{
            Mail::send('email.test', $data=[], function ($message) use ($data) {
                $message->to('test@gmail.com')->subject('test');
            });

            return back()->with('success',trans('trans.data_save'));

        }
        catch(\Exception $e){
            $edit->driver=$save->driver;
            $edit->host= $save->host;
            $edit->port= $save->port;
            $edit->from_address=$save->username;
            $edit->from_name=$save->from_name;
            $edit->encryption=$save->encryption;
            $edit->username= $save->username;
            $edit->password= $save->password;
            $edit->save();
            return back()->withInput()->withErrors('Connection failed');
        }

    }
    function ValidateMail(Request $request)
    {
        $input = $request->all();

        $save = MailModel::first();
        $edit = MailModel::first();
        $edit->driver = $input['driver'];
        $edit->host = $input['host'];
        $edit->port = $input['port'];
        $edit->from_address = $input['username'];
        $edit->from_name = $input['from_name'];
        $edit->encryption = $input['encryption'];
        $edit->username = $input['username'];
        $edit->password = $input['password'];
        $edit->save();



        try {
            Mail::send('email.test',$data=[], function ($message) use ($data) {
                $message->to('test@gmail.com')->subject('test');
            });
            $data['rs'] = true;
            $data['message'] = 'Connection success';
            $edit->driver = $save->driver;
            $edit->host = $save->host;
            $edit->port = $save->port;
            $edit->from_address = $save->username;
            $edit->from_name = $save->from_name;
            $edit->encryption = $save->encryption;
            $edit->username = $save->username;
            $edit->password = $save->password;
            $edit->save();
            echo json_encode($data);
            return;

        } catch (\Exception $e) {
            $data['rs'] = false;
            $data['message'] = 'Connection failed';
            $edit->driver = $save->driver;
            $edit->host = $save->host;
            $edit->port = $save->port;
            $edit->from_address = $save->from_address;
            $edit->from_name = $save->username;
            $edit->encryption = $save->encryption;
            $edit->username = $save->username;
            $edit->password = $save->password;
            $edit->save();
            echo json_encode($data);
            return;
        }
    }
    //===============EMAIL========================//
    //==========================translater=======================//
    //test
    public function test(){
        return view('admin.translation.index');
    }
    public function set( Request $request){
        $input = $request->all();
        $resources = resource_path();
        $trans='l.php';
        foreach(self::$lang_data as $keylang=>$value)
        {
            $path = $resources.'/lang/'.$keylang.'/'.$trans;
            if( file_exists( $path )){
                $array = [];
                $string = "<?php ".PHP_EOL;
                $string .= "return [".PHP_EOL;
                foreach( $input as $key=>$item ){
                    $l=explode('_',$key);
                    if( $key == '_token' ||($keylang!=$l[0]) ) continue;
                    $key=substr($key,3);
                    $array[$key]= $item;
                    $string.="\t'".$key."' => '".str_replace("'","\'",$item)."',".PHP_EOL;
                }

                $string.="];";
                file_put_contents($path, $string);
            }
        }

        return redirect()->back();
    }
    //==========================translater=======================//

    function Pages(){
        $pages=Page::orderBy('type','asc')->get();
        return view('admin.pages.pages',compact('pages'));
    }

    function Page($id=null){
        if(is_null($id)){
            return view('admin.pages.page');
        }
        $item=Page::findOrFail($id);
        return view('admin.pages.page',compact('item'));
    }

    function PagePost(Request $request){
        $input=$request->all();
        $rules=[
            'title_ro'=>'required|string|max:255',
            'title_ru'=>'required|string|max:255',
            'title_en'=>'required|string|max:255',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        $array_no_position=[1,2,3,4,5,8,11,13];
        if(isset($input['id'])){
            $item=Page::find($input['id']);
        }else{
            $item=new Page();
        }
        $data=['title_','meta_description_','slug_','description_'];
        $langs= config('app.locales');
        foreach($langs as $lang =>$value ){
            foreach($data as $t1){
                $t2=$t1.$lang;
                if(isset($input[$t2])){
                    $item->$t2=$input[$t2];
                }
            }
        }

        $array_no_sort=[1,2,3,4,5,8,11,13];
        if(!in_array($item->id,$array_no_sort)){
            $item=self::setSort($item,$input,new Page());
        }
        $item->save();
        if($item->type!=1){
            $item->status=isset($input['status'])? $input['status'] : 1;
        }
        $item->save();
        $input['id']=$item->id;
        $item=$this->insertSlug($item,$input,new Page());

        $item->save();

        if(!in_array($item->id,$array_no_position)){
            SectionPage::where('id_page',$item->id)->delete();
            if(isset($input['position']) && is_array($input['position'])){
                foreach($input['position'] as $t){
                    $obj=new SectionPage();
                    $obj->id_page=$item->id;
                    $obj->id_section=$t;
                    $obj->save();
                }
            }
        }


        return redirect()->route('admin/pages')->with('success',trans('trans.data_save'));

    }

    function PagesDelete(Request $request){
        $input=$request->all();
        $rules=[
            'id'=>'required|exists:pages,id'
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withErrors($v);
        }

        $item= Page::find($input['id']);
        if($item->type!=1){
            $item->delete();
        }

        return back()->with('success',trans('trans.data_delete'));
    }

    function Image(&$item,$request,$image,$address,$width_user,$array=null){

        if(is_null($array)){
            if($request->hasFile($image)) {
                $img = $request->file($image);
                $this->DeleteImage($item, $request, $image, $address);
            }
        }else{
                $img=$array;
        }

            if(isset($img) && !is_null($img)){
                $origName = $img->getClientOriginalExtension();
                $nameImg = str_random(10) . '.' . $origName;
                $item->$image=$nameImg;
                $image = \Image::make($img);
                $path =public_path().'/images/'.$address.'/'.($item->id) . '/';
                list($width, $height) = getimagesize($img);
                if( $width > $width_user )
                {
                    $image->resize($width_user, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                if(!File::exists($path)){
                    File::makeDirectory($path);
                }
                $image->save($path.$nameImg);
                $image->destroy();
            }



    }

    Function DeleteImage($item,$request,$image,$address){
            if (!empty($item->$image) && isset($request[$image])) {
                if (file_exists(public_path() . '/images/'.$address.'/' . ($item->id) . '/' . $item->$image)) {
                    unlink(public_path() . '/images/'.$address.'/' . ($item->id) . '/' . $item->$image);
                }
            }
    }
}
