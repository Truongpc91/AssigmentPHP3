<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class BillController extends Controller
{
    const PATH_VIEW = 'admin.bills.';

    public function index(){
        $data = Order::query()->get();

        // dd($data);

        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
    }

    public function confirmBill(string $id){

        $model = Order::query()->where('id',$id)->first();

        // dd($model);

        $data = [
            'status_order' => 'confirmed'
        ];

        $model->update($data);

        return redirect()->route('admin.bills.index');

    }
}
