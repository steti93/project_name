<?php

namespace App\Http\Controllers\Admin;

use App\Models\Date;
use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Size;
use Image;
use Response;
use App\Models\Image as ImageModel;
class NamesController extends Controller
{
    function Names(){
        $items=new Name();
        if(isset($_GET['name']) && strlen($_GET['name'])>2){
            $items=$items->where('name','like',$_GET['name'].'%');
        }
        $items=$items->paginate(30);
        $items->appends(Input::except('page'));
        return view('admin/names/names',compact('items'));
    }

    function Name($id=null){

        if(is_null($id)){
         return view('admin.names.name');
        }else{
            $item=Name::findOrFail($id);
            return view('admin.names.name',compact('item','url'));
        }
    }

    static function incViews($id){
        $geoip=GeoIP()->getLocation(GeoIP()->getClientIP());
        $row=View::where('names_id',$id)->where('iso_code',$geoip['iso_code'])->first();
       if($row){
            $row->count=($row->count)+1;
            $row->save();
       }else{
           $row=new View();
           $row->iso_code=$geoip['iso_code'];
           $row->country=$geoip['country'];
           $row->names_id=$id;
           $row->save();
       }
       $date=new Date();
       $date->names_id=$id;
       $date->iso_code=$geoip['iso_code'];
       $date->views_id=$row->id;
       $date->save();
       return View::where('names_id',$id)->sum('count');
    }

    function NamePost(Request $request){
        $input=$request->all();
        $rules=[
            'name'  =>'required|string|max:255',
            'meaning'   =>'nullable|string',
            'genders_id'    =>'required|exists:genders,id',
            'usages'     =>'required|array',
            'id'        =>'exists:names,id'
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        if(isset($input['id'])){
            $item=Name::findOrFail($input['id']);
        }else{
            $item=new Name();
        }

        $item->name=$input['name'];
        $item->genders_id=$input['genders_id'];
        $item->meaning=isset($input['meaning'])?  $input['meaning']:'';
        $array_usages=[];
        if(isset($input['usages'])  && is_array($input['usages'])){
            foreach($input['usages'] as $temp){
                $array_usages[]=json_decode($temp,true);
            }
        }
        $item->usages=json_encode($array_usages);
        $item->prefix=mb_strtolower(str_replace('\'','',$item->name));
        $item->save();
        $object=new \App\Http\Controllers\Admin\AdminController();
        $address='names';
        $image1 = 'image';
        $object->Image($item,$request,$image1,$address,400);
        $item->save();
        return redirect()->route('admin/names',['name'=>$item->name])->with('success',trans('trans.data_save'));
    }

    function NamesDelete(Request $request){
        $item=Name::findOrFail($request->input('id'));
        $image1 = 'image';
        $object=new \App\Http\Controllers\Admin\AdminController();
        $object->DeleteImage($item,$request=[$image1=>'delete'],$image1,'names');
        $item->delete();
        return back()->with('success',trans('trans.data_delete'));
    }

    function DeleteImage(Request $request){
        $input=$request->all();
        if($input['type']=='names'){
            $item=Name::findOrFail($input['id']);
            $object=new \App\Http\Controllers\Admin\AdminController();
            $image1 = 'image';
            $object->DeleteImage($item,$request=[$image1=>'delete'],$image1,$input['type']);
            $item->image='';
            $item->save();
        }
        echo json_encode(['rs'=>'true']);
    }


    static function GetImage($item){
        // create a new empty image resource
        if (file_exists(public_path() . '/images/names/' . ($item->id) . '/' . $item->image) && strlen($item->image)) {
            $url=asset('images/names/'.$item->id.'/'.$item->image);
        }else{
            $error=true;
            $loop=0;
// draw transparent text
            $count=ImageModel::where('genders_id',$item->genders_id)->count();

            if($count){
                while($error && $loop<=5){
                    $images=ImageModel::where('genders_id',$item->genders_id)->orderByRaw("RAND()")->first();
                    if (file_exists(public_path() . '/images/images/' . ($images->id) . '/' . $images->image) && strlen($images->image)) {
                        $url=asset('images/images/'.$images->id.'/'.$images->image);
                        $error=false;

                            // create Image from file
                            $image=Image::make($url);
                            // use callback to define details
                            $image->text($item->name, 15, 75, function ($font) {
                                $font->file(public_path() . '/font/OpenSans-Regular.ttf');
                                $font->size(50);

                            });

                        $url=$image->encode('data-url');
                    }
                    $loop++;
                }
            }else{
                $url=asset('img/no-image-name.png');
            }
        }
        return $url;


    }
}
