<?php

namespace App\Http\Controllers;
use App\Models\Name;
use App\Models\Usage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class SearchController extends BaseController
{
    public function getSearchElements($text){
        return null;
    }

    function getSearchString($string=null){
        if(is_null($string)){
            alert(404);
        }
        $string=strtolower(trim($string));
        $letter=$string[0];
        $items=Name::where('names.prefix','LIKE',$string.'%');
        if(isset($_GET['usage']) && !is_array($_GET['usage']) && strlen($_GET['usage'])){
            $items=$items->where('usages','like','%"'.$_GET['usage'].'"%');
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
        $usages_all=['9'=>'All African',117=>'All Mythology',151=>'All Biblical'];
        $usages=Usage::where('status',1)->where('id_parent','!=',0)->orderBy('name','asc')->get();
        $items->appends(Input::except('page'));
        return view('front.pages.names',compact('items','usages','usages_all','string','letter'));
    }

}
