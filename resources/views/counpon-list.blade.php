@extends('clients.layouts.master')

@section('content')
    <style>
        .card {

            width: 300px;
            border: none;
            height: 320px;
            border-radius: 15px;
            padding: 20px;
            background-color: #D50000;
        }

        .percent {
            color: #fff;
        }

        .discount {

            font-size: 27px;
            color: #fff;
        }


        .line {

            color: #fff;
        }



        .form-check-input:checked {
            background-color: #F44336;
            border-color: #F44336;
        }


        .form-check-input:focus {
            border-color: #d50000;
            outline: 0;
            box-shadow: none;
        }


        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 1.75em;
            margin-bottom: -5px;
        }
    </style>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Counpon Page</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Counpon Page</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container">
        <div class="row justify-content-between">
            @foreach ($data as $item)
                <div class="card m-3 col-3">
                    <div class="text-center">
                        <div class="d-flex flex-row text-center">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/015/452/522/small_2x/discount-icon-in-trendy-flat-style-isolated-on-background-discount-icon-page-symbol-for-your-web-site-design-discount-icon-logo-app-ui-discount-icon-eps-vector.jpg"
                                width="70">
                            <div class="d-flex flex-column ml-1">
                                <p class="mb-0 percent">{{ $item->name }}</p>
                                <span class="discount">Discount</span>

                            </div>
                        </div>
                    </div>
                    <hr class="line">
                    <span class="text-white">Ultimate discount for all customers across all country on all products at
                        bbbootstrap.com</span>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check form-switch mt-3 mb-3">
                            <button class="btn btn-success">Add Coupon</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
