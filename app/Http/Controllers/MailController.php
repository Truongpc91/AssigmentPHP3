<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailOrder;
use App\Models\Order;
use App\Models\OrderItem;

class MailController extends Controller
{
    public function index(){

        $mailData = [
            'title' => 'Gửi xem có gửi được không :))',
            'body' => 'Con cá D<D '
        ];

        Mail::to('truongpcph43675@fpt.edu.vn')->send(new SendMailOrder($mailData));

        dd('Gửi mail thành công');
    }

    public function senMailBill(string $idOrder, string $emailUser){
        $order = Order::query()->where('id',$idOrder)->first();

        $orderDetail = OrderItem::query()->where('order_id', '=',$idOrder)->get();


        $mailData = [
            'title' => 'Mail Xác Nhận đơn Hàng :  Đơn hàng của bạn đã được xác nhận thành công !!!',
            'body' => 'Con cá D<D',
            'order' => $order,
            'orderDetail' => $orderDetail
        ];

        // dd($mailData);

        // dd($idOrder, $emailUser);

        Mail::to($emailUser)->send(new SendMailOrder($mailData));

        // dd('Gửi mail thành công');

        return redirect()->route('admin.bills.index');
    }
}
