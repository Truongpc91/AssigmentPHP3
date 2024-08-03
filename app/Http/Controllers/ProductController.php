<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\slider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug){
        $sliders = slider::query()->latest('id')->where('status', '=', 1)->get();

        $product = Product::query()->with('variants')->where('slug', $slug)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $galleries = ProductGallery::query()->where('product_id', '=', $product->id)->get();

        // dd($galleries);

        return view('product-detail', compact('sliders','product', 'colors', 'sizes', 'galleries'));
    }
}
