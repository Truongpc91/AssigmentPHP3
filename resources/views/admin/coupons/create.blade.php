@extends('admin.layouts.master')

@section('title')
    Add New Coupon
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add New Coupon</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Coupon</a></li>   
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Code</label>
                                        <input type="text" class="form-control" name="code" id="name">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Type</label>
                                        <select name="type" id="" class="form-select">
                                            <option value="giamtheotien">Giảm theo tiền</option>
                                            <option value="giamtheophantram">Giảm theo phần trăm</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Expired time</label>
                                        <input type="date" class="form-control" name="expired_time" id="name">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="name">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Value Counpon</label>
                                        <input type="number" class="form-control" name="value" id="name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div><!-- end card header -->
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

    </form>

@endsection