<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function getIndex(){
        return View('front.pages.index');
    }

    public function getNames(){
        return View ('front.pages.names');
    }

    public function getContactUsForm(){
        return View ('front.pages.contact');
    }

    public function getName(){
        return View ('front.pages.name');
    }

    public function getCategories(){
        return View('front.pages.categories');
    }
}
