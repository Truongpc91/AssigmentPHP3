<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = slider::query()->latest('id')->where('status', '=', 1)->get();

        return view('home',compact('sliders'));
    }

    public function thankyou(){
        $sliders = slider::query()->latest('id')->where('status', '=', 1)->get();

        if(isset($_GET['vnp_Amount'])){
            session()->forget('cart');

            if (Session::get('totalAmountCounpon')) {
                session()->forget('totalAmountCounpon');
            } else {
                session()->forget('totalAmount');
            }
        }

        return view('thankyou',compact('sliders'));
    }
}
