<?php

namespace App\Http\Controllers;
use App\Models\Name;
use App\Models\View;
use App\Models\Usage;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function getIndex(){
        $usages=Usage::where('index',1)->where('status',1)->orderBy('index_sort','asc')->get();
        $tops=Name::join('views','views.names_id','=','names.id')->
        groupBy('names_id')->selectRaw('names.* ,sum(count) as sum')->orderBy('sum','desc')->get();
        $name_masculine=$tops->where('genders_id',1)->take(10);
        $name_femenine=$tops->where('genders_id',2)->take(10);
        $top_name=$tops->first();
        if(!$top_name){
            $top_name=new Name();
        }
        return View('front.pages.index',compact('usages','name_masculine','name_femenine','top_name'));
    }

    public function getNames(){
        return View ('front.pages.names');
    }

    public function getContactUsForm(){
        return View ('front.pages.contact');
    }

    public function getName($slug){
        $item=Name::where('slug',$slug)->firstOrFail();
        $count=\App\Http\Controllers\Admin\NamesController::incViews($item->id);
        return View ('front.pages.name',compact('item','count'));
    }

    public function getCategories(){
        return View('front.pages.categories');
    }

    function Usage(){
        $usages_all=['9'=>'All African',117=>'All Mythology',151=>'All Biblical'];
        $usages=Usage::where('status',1)->where('id_parent','!=',0)->orderBy('name','asc')->get();
        $items=new Name();
        if(isset($_GET['usage']) && !is_array($_GET['usage']) && strlen($_GET['usage'])){
            $items=$items->where('names.usages','LIKE','%'.$_GET['usage'].'%');
        }

        if(isset($_GET['gender']) && !is_array($_GET['gender']) && strlen($_GET['gender'])){
            if($_GET['gender']=='masculine'){
                $sex=1;
            }else if($_GET['gender']=='femenine'){
                $sex=2;
            }else{
                $sex=3;
            }
            $items=$items->where('genders_id',$sex);
        }
        $items=$items->orderBy('names.prefix','asc')
            ->paginate(20);
        return view('front.pages.usages',compact('usages','usages_all','items'));
    }

    function Categories(){
        $usages=Usage::where('status',1)->where('id_parent',0)->where('id_category',0)->orderBy('sort','asc')->get();
        foreach($usages as $niv1){
            $niv1['niv2']=Usage::where('status',1)->where('id_parent',$niv1->id)->where('id_category',0)->orderBy('sort','asc')->get();
            foreach($niv1['niv2'] as $niv2){
                $niv2['niv3']=Usage::where('status',1)->where('id_parent',$niv1->id)->where('id_category',$niv2->id)->orderBy('sort','asc')->get();
            }
        }
        return view('front.pages.categories',compact('usages'));
    }
}
