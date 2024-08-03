<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OnlinePaymentController extends Controller
{
    public function vnpay_payment(Request $request){

    $data = $request->totalAmount;

    // error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    // date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://127.0.0.1:8000/thankyou";
    $vnp_TmnCode = "IS5MKMIW";//Mã website tại VNPAY 
    $vnp_HashSecret = "3HJA93HSBPP5MG2WJSHZXL22ELVBX2ZZ"; //Chuỗi bí mật
    
    $vnp_TxnRef = rand(0,50000);  //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán đơn hàng";
    $vnp_OrderType = "sdasdasd";
    $vnp_Amount = $data * 100;
    $vnp_Locale = "VN";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
   
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            // header('Location: ' . $vnp_Url);
            // die();
            try {
                DB::transaction(function () {
                    $testUser = User::query()->where('email', '=', \request('user_email'))->first();
    
                    if (!empty($testUser)) {
                        $user = $testUser;
                    } else {
                        $user = User::query()->create([
                            'name' => \request('user_name'),
                            'email' => \request('user_email'),
                            'password' => bcrypt(\request('user_email')),
                            'is_active' => false,
                        ]);
                    }
                   
                    $totalAmount = \request('totalAmount');
                    $dataItem = [];
    
                    foreach (session('cart') as $variantID => $item) {
                        // $totalAmount += $item['quantity_cart'] * ($item['price_sale'] ?: $item['price_regular']);
    
                        $dataItem[] = [
                            'product_variant_id' => $variantID,
                            'quantity' => $item['quantity_cart'],
                            'product_name' => $item['name'],
                            'product_sku' => $item['sku'],
                            'product_img_thumbnail' => $item['image_thumbnail'],
                            'product_price_regular' => $item['price_regular'],
                            'product_price_sale' => $item['price_sale'],
                            'variant_size_name' => $item['size']['name'],
                            'variant_color_name' => $item['color']['name'],
                        ];
                    }
    
                    
    
                    $order = Order::query()->create([
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                        'user_phone' => \request('user_phone'),
                        'user_address' => \request('user_address'),
                        'user_note' => \request('user_note'),
                        'total_price' => $totalAmount,
                    ]);
    
                    // dd($dataItem, $order);
    
                    foreach ($dataItem as $item) {
                        $item['order_id'] = $order->id;
    
                        OrderItem::query()->create($item);
                    }
                });
    
                session()->forget('cart');
                if(Session::get('totalAmountCounpon')){
                    session()->forget('totalAmountCounpon');
                }else{
                    session()->forget('totalAmount');
    
                }
    
                DB::commit();
    
                return redirect()->route('thankyou')->with('success', 'Đặt hàng thành công');
            } catch (\Exception $exception) {
                // return back()->with('error', 'Lỗi đặt hàng');
                // return redirect()->route('welcome');
    
                dd($exception);
            }
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
}
