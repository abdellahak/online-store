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
        $viewData["subtitle"] =  "About us";
        $viewData["description"] = "Welcome to our Online Store! We offer a wide selection of quality products at competitive prices. Our mission is to provide a seamless and enjoyable shopping experience for all our customers. Thank you for choosing us for your shopping needs.";
        $viewData["author"] = "Developed by: abderrahim besaid - abdelilah ouslimane - ikram gouskar - abdellah khouden";
        return view('home.about')->with("viewData", $viewData);
    }
}
