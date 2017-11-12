<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Size;
use Image;
class ImagesController extends Controller
{
    function Images(){
        $items=ImageModel::paginate(15);
        return view('admin.images.images',compact('items'));
    }

    function Image($id=null){
        if(is_null($id)){
            return view('admin.images.image');
        }
        $item=ImageModel::findOrFail($id);
        return view('admin.images.image',compact('item'));
    }

    function ImagePost(Request $request){
        $input=$request->all();
        $rules=[
            'id'    =>'exists:images,id',
            'genders_id'=>'required|numeric',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        if(isset($input['id'])){
            $item=ImageModel::findOrFail($input['id']);
        }else{
            $item= new ImageModel();
        }
        $item->genders_id=$input['genders_id'];
        $item->save();
        $object=new \App\Http\Controllers\Admin\AdminController();
        $address='images';
        $image1 = 'image';
        $object->Image($item,$request,$image1,$address,400);
        $item->save();
        return redirect()->route('admin/images')->with('success',trans('trans.data_save'));
    }

    function ImagesDelete(Request $request){
        $item=ImageModel::findOrFail($request->input('id'));
        $image1 = 'image';
        $object=new \App\Http\Controllers\Admin\AdminController();
        $object->DeleteImage($item,$request=[$image1=>'delete'],$image1,'images');
        $item->delete();
        return back()->with('success',trans('trans.data_delete'));
    }
}
