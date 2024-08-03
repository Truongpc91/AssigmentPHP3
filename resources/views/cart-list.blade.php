@extends('clients.layouts.master')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price regular</th>
                            <th>Price Sale</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">
                        @if (session()->has('cart'))
                            @foreach (session('cart') as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ number_format($item['price_regular']) }}</td>
                                    <td>{{ number_format($item['price_sale']) }}</td>
                                    <td>{{ $item['color']['name'] }}</td>
                                    <td>{{ $item['size']['name'] }}</td>
                                    <td>
                                        {{-- Nút giảm --}}
                                        {{ $item['quantity_cart'] }}
                                        {{-- Nút tăng --}}
                                    </td>
                                    <td class="align-middle"><a
                                            onclick="return confirm('Are you want to delete this product ?')"
                                            href="{{ route('cart.delete', $item['id_variant']) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="8">
                                <div class="mt-4 mb-4">
                                    <h4 class="text-danger mb-3">Không có sản phẩm nào trong giỏ hàng</h4>
                                    <a href="{{ route('welcome') }}">Vui lòng đặt hàng</a>
                                </div>
                            </td>
                        @endif
                        {{-- <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                Colorful Stylish Shirt</td>
                            <td class="align-middle">$150</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                        value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">$150</td>
                            <td class="align-middle"><button class="btn btn-sm btn-primary"><i
                                        class="fa fa-times"></i></button></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <form class="mb-3 mt-3" action="{{ route('cart.addcoupon') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control p-4" placeholder="Coupon Code" name="coupon" autocomplete="coupon" autofocus>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <div class="pl-2">
                        <form action="{{ route('order.save') }}" method="POST">
                            @csrf
                            <div class="mt-3 mb-2">
                                <label for="user_name"> {{ \Str::convertCase('user_name', MB_CASE_TITLE) }}</label>
                                <input type="text" name="user_name" id="user_name" value="{{ auth()->user()?->name }}"
                                    class="form-control">
                            </div>
                            <div class="mt-3 mb-2">
                                <label for="user_email"> {{ \Str::convertCase('user_email', MB_CASE_TITLE) }}</label>
                                <input type="text" name="user_email" id="user_email"
                                    value="{{ auth()->user()?->email }}" class="form-control">
                            </div>
                            <div class="mt-3 mb-2">
                                <label for="user_phone"> {{ \Str::convertCase('user_phone', MB_CASE_TITLE) }}</label>
                                <input type="text" name="user_phone" id="user_phone" class="form-control">
                            </div>
                            <div class="mt-3 mb-2">
                                <label for="user_address"> {{ \Str::convertCase('user_address', MB_CASE_TITLE) }}</label>
                                <input type="text" name="user_address" id="user_address" class="form-control">
                            </div>
                            <div class="mt-3 mb-2">
                                <label for="user_note"> {{ \Str::convertCase('user_note', MB_CASE_TITLE) }}</label>
                                <input type="text" name="user_note" id="user_note" class="form-control">
                            </div>
                            {{-- <button class="btn btn-primary" type="submit">Đặt hàng</button> --}}
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total</h5>
                                    <h5 class="font-weight-bold">
                                        @if (Session::get('totalAmountCounpon'))
                                            @php
                                                $totalAmount = Session::get('totalAmountCounpon');
                                                echo number_format($totalAmount);
                                            @endphp
                                        @else
                                            @php
                                                echo number_format($totalAmount);
                                            @endphp
                                        @endif
                                    </h5>
                                    @if (Session::get('totalAmountCounpon'))
                                        @php
                                            $totalAmount = Session::get('totalAmountCounpon');
                                            echo number_format($totalAmount);
                                        @endphp
                                        <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                                    @else
                                        <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                                    @endif
                                </div>
                                @if (session()->has('cart'))
                                    <button type="submit" class="btn btn-block btn-primary my-3 py-3">Đặt hàng</button>
                                    <button type="submit" name="redirect" class="btn btn-block btn-success my-3 py-3">Online Payment</button>
                                @else
                                    <button type="submit" class="btn btn-block btn-primary my-3 py-3" disabled>Đặt
                                        hàng</button>
                                @endif
                            </div>
                        </form>
                    </div>
                    {{-- <div class="">
                        <form action="{{ route('onlinepayment') }}" method="POST">
                            @csrf
                            <input type="hidden" class="" name="totalAmount" value="{{ $totalAmount }}">
                            <button type="submit" name="redirect" class="btn btn-block btn-success my-3 py-3">Online Payment</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
