<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function index()
    {
        //
        $productCategory = ProductCategory::withCount('product')->latest()->get();
        return $productCategory;
    }
}
