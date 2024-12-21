<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banner = "Banner";
        $sale = "Sale";
        $product = "Product";
        $bannerSale = "BannerSale";
        $blog = "Blog";
        $title = "Home";
        return view('pages.home.index', compact('banner', 'sale', 'product', 'bannerSale', 'blog', 'title'));
    }
}