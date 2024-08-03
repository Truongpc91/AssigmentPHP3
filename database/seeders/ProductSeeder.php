<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Stringable;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        //truncate: Xóa trắng dữ liệu bảng
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();

        Tag::factory(15)->create();

        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        foreach (['#0000FF', '#000000', '#FFFFFF', '#00FF00', '#FFFF00', '#FF0000'] as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        for ($i = 0; $i < 1000; $i++) {
            $name = fake()->text(100);

            Product::query()->create([
                'name' => $name,
                'catelogue_id' => rand(1, 8),
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'image_thumbnail' => 'https://product.hstatic.net/1000026602/product/img_5435_6afcdabbf16448eca040cc4bdcf0ba23.jpg',
                'price_regular' => 600000,
                'price_sale' => 490000,
            ]);
        }

        //ID Product 1 - 1000
        for ($i = 1; $i < 1001; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://product.hstatic.net/1000026602/product/img_5435_6afcdabbf16448eca040cc4bdcf0ba23.jpg'
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://bizweb.dktcdn.net/thumb/1024x1024/100/393/859/products/20571729-8b13-4f5d-a61e-c50bf4cb7de3.jpg'
                ]
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15)
                ]
            ]);
        }

        for ($productID = 1; $productID < 1001; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 7; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://bizweb.dktcdn.net/thumb/1024x1024/100/393/859/products/20571729-8b13-4f5d-a61e-c50bf4cb7de3.jpg',
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
