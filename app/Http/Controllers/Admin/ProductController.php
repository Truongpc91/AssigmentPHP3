<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';

    public function index()
    {

        $data = Product::query()->with(['catelogue', 'tags'])->latest('id')->get();

        // $category = Catelogue::query()->first();

        // dd($category->product);

        // dd($data->first()->tags->toArray());    
        // dd($data->first()->catelogue());
        // dd($data->first()->catelogue->name);

        // foreach ($data as $datum){
        //     $datum->catelogue->name;
        // }

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $tags = Tag::query()->pluck('name', 'id')->all();

        // dd($tags);

        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active']       ??= 0;
        $dataProduct['is_hot_deal']     ??= 0;
        $dataProduct['is_good_deal']    ??= 0;
        $dataProduct['is_new']          ??= 0;
        $dataProduct['is_show_home']    ??= 0;
        $dataProduct['slug']            = Str::slug($dataProduct['name'] . '-' . $dataProduct['sku']);

        // dd($dataProduct);

        if ($dataProduct['image_thumbnail']) {
            $dataProduct['image_thumbnail'] = Storage::put('products', $dataProduct['image_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id'   => $tmp[0],
                'product_color_id'  => $tmp[1],
                'quantity'          => $item['quantity'],
                'image'             => $item['image'] ?? null,
            ];

            // dd($key, $item);
        }
        // dd($dataProductVariants);

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();

            /** @var Product $product  */
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;

                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTags);

            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $product_tags = $product->tags;

        // $product_galleries = $product->galleries;

        // $product_variants = $product->variants;
        
        $productShow = Product::query()->where('id', '=', $product->id)->with(['catelogue','tags','galleries','variants'])->get();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $tags = Tag::query()->pluck('name', 'id')->all();

        // dd($productShow->toArray());

        return view(self::PATH_VIEW . __FUNCTION__, compact('productShow','colors','sizes','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product->tags()->sync([]));

        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);

                $product->galleries()->delete();

                $product->variants()->delete();

                $product->delete();
            }, 3);

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            return back();
        }
    }
}
