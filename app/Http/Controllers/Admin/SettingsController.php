<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\Index;
use Lang;
use DB;
class SettingsController extends Controller
{
    function Settings(){
        $title_user='title_'.Lang::getLocale();
        $item=Setting::first();
        $index['recommend']=[];
        $index['new']=[];
        $index['action']=[];
        foreach(Index::get() as $temp){
            if($temp->type==1){
                $index['recommend'][]=$temp->id_product;
            }else if($temp->type==2){
                $index['new'][]=$temp->id_product;
            }else{
                $index['action'][]=$temp->id_product;
            }
        }
        $products=Product::join('categories','categories.id','=','products.id_category')
                            ->where('categories.status',1)
                            ->where('products.status',1)
                            ->orderBy($title_user,'asc')->select('products.*')->get();
        return view('admin.settings.settings',compact('item','index','products'));
    }

    function SettingsPost(Request $request){
        $input=$request->all();
        $item=Setting::first();
        Index::truncate();
        if(isset($input['products_recommend']) && is_array($input['products_recommend'])){
            foreach($input['products_recommend'] as $temp){
                $obj=new Index();
                $obj->id_product=$temp;
                $obj->type=1;
                $obj->save();
            }
        }
        if(isset($input['products_new']) && is_array($input['products_new'])){
            foreach($input['products_new'] as $temp){
                $obj=new Index();
                $obj->id_product=$temp;
                $obj->type=2;
                $obj->save();
            }
        }
        if(isset($input['products_action']) && is_array($input['products_action'])){
            foreach($input['products_action'] as $temp){
                $obj=new Index();
                $obj->id_product=$temp;
                $obj->type=3;
                $obj->save();
            }
        }
        $data=['email_all','email','email_other','email_buy','phone_1','phone_2','cod_1','cod_2','hit_day','hit_qty','day_new'];
        foreach($data as $i){
            $item->$i=isset($input[$i])? $input[$i]:'';
        }
        $data=['delivery_'];
        $object=new \App\Http\Controllers\AdminController();
        $item=$object->getInput($item,$input,$data);
        $item->save();
        return back()->with('success',trans('trans.data_save'));
    }
}
