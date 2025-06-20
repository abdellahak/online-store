<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Home Page - Online Store";
        return view('home.index')->with("viewData", $viewData);
    }

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About us - Online Store";
        $viewData["subtitle"] =  __('messages.home.about.title');
        $viewData["description"] =  __('messages.home.about.text');
        $viewData["author"] =  __('messages.home.about.developed_by');
        return view('home.about')->with("viewData", $viewData);
    }
}
