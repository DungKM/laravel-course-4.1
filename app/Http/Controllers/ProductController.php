<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product.index');
    }
    public function show($id, $name, $price)
    {
        $title = $id;
        $Idproduct = $id;
        $nameProduct = $name;
        $priceProduct = $price;
        return view('pages.product.show', compact('Idproduct', 'title', 'nameProduct', 'priceProduct'));
    }
}
