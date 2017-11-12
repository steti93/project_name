<?php

namespace App\Http\Controllers;
use App\Models\Name;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class SearchController extends BaseController
{
    public function getSearchElements(){
        return null;
    }

    function getSearchString($string){

        $string=strtolower($string);
        $items=Name::join('genders','genders.id','=','names.genders_id')
            ->where('names.prefix','LIKE',$string.'%')
            ->select('names.*','genders.name as genders_name')
            ->orderBy('names.prefix','asc')
            ->paginate(20);
        return view('front.pages.names',compact('items'));
    }

}
