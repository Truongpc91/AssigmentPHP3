<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Coupon::query()->get();
        $sliders = slider::query()->latest('id')->where('status', '=', 1)->get();

        // dd(Auth::user()->id);

        $user = User::find(Auth::user()->id);
        $coupon = $user->coupons;

        // dd($coupon);

        return view('counpon-list',compact('sliders','data'));
    }
}
