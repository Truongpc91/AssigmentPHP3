<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    // public $totalAmount;

    public function list(){
        $sliders = slider::query()->latest('id')->where('status', '=', 1)->get();

        $cart = session('cart');

        $totalAmount = 0;
        
        // dd($cart);

        if(!empty($cart)){
            foreach ($cart as $item) {
                $totalAmount += $item['quantity_cart'] * ($item['price_sale'] ?: $item['price_regular']);
            }

            Session::put('totalAmount', $totalAmount);
        }

        return view('cart-list', compact('sliders','totalAmount'));
    }

    public function add(){
        $product = Product::query()->findOrFail(\request('product_id'));
        $productVariant = ProductVariant::query()
            ->with(['color', 'size'])
//            ->where('product_id', \request('product_id'))
//            ->where('size_id', \request('size_id'))
//            ->where('color_id', \request('color_id'))
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size_id'),
                'product_color_id' => \request('product_color_id'),
            ])
            ->firstOrFail();
                

        // dd($productVariant);
        if (!isset( session('cart')[$productVariant->id] ) ) {
            $productVariant = [
                "id_variant" => $productVariant->id,
                "product_id" => $productVariant->product_id,
                "product_size_id" => $productVariant->product_size_id,
                "product_color_id" => $productVariant->product_color_id,
                "quantity" => $productVariant->quantity,
                "image" => $productVariant->image,
                "color" => $productVariant->color,
                "size" => $productVariant->size,
            ];

            $data = $product->toArray()
                + $productVariant
                + ['quantity_cart' => \request('quantity_cart')];
            // dd($productVariant);
                
            // dd($data);

            session()->put('cart.' . $productVariant['id_variant'],  $data);
        } else {
            $data = session('cart')[$productVariant['id_variant']];
            $data['quantity_cart'] = \request('quantity_cart');

            session()->put('cart.' . $productVariant['id_variant'],  $data);

        }

        // dd(session('cart'));

        return redirect()->route('cart.list');
    }

    public function addCoupon(Request $request){

        $value = Session::get('totalAmount');

        $voucher = Coupon::query()->where('code', '=', $request->toArray())->first();

        if($voucher->type == 'giamtheotien'){
            $totalPrice = $value - $voucher->value;

            // dd($totalPrice);
           
        }else if($voucher->type == 'giamtheophantram'){
            $totalPrice = $value - ($value * $voucher->value / 100);

            // dd($totalPrice);
        }

        Session::put('totalAmountCounpon', $totalPrice);

        // dd(Session::get('totalAmount', $totalPrice));

        return redirect()->route('cart.list')->onlyInput('coupon');
    }

    public function delete(string $id_delete){
        // dd($id_delete);

        $cart = session('cart');

        session()->forget('cart.' . $id_delete);

        session()->forget('totalAmountCounpon');
        session()->forget('totalAmountCounpon');


        // dd($cart);
        return redirect()->route('cart.list');
    }
}
