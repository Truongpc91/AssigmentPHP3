@extends('admin.layouts.master')

@section('title')
    Show Product
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Show Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Show Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    {{-- @dd($product->toArray()) --}}


    @foreach ($productShow as $item)
        {{-- @dd($item) --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-lg-5">
                            <div class="col-xl-4 col-md-8 mx-auto">
                                <div class="product-img-slider sticky-side-div">
                                    <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                        <div class="swiper-wrapper">
                                            @foreach ($item->galleries as $gallery)
                                                <div class="swiper-slide">
                                                    <img src="{{ \Storage::url($gallery->image) }}" alt=""
                                                        class="img-fluid d-block" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>                   
                                    </div>

                                    <!-- end swiper thumbnail slide -->
                                    <div class="swiper product-nav-slider mt-2">
                                        <div class="swiper-wrapper">
                                            @foreach ($item->galleries as $gallery)
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item">
                                                        <img src="{{ \Storage::url($gallery->image) }}" alt=""
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- end swiper nav slide -->
                                </div>

                            </div>
                            <!-- end col -->

                            <div class="col-xl-8">
                                <div class="mt-xl-0 mt-5">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h4>{{ $item->name }}</h4>
                                        </div>
                                        <a href="{{ route('admin.products.index') }}" class=" btn btn-warning">List
                                            Products</a>
                                        <div class="flex-shrink-0">
                                            <div>
                                                <a href="apps-ecommerce-add-product.html" class="btn btn-light"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                        class="ri-pencil-fill align-bottom"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                        <div class="text-muted fs-16">
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                        </div>
                                        <div class="text-muted">( {{ $item->view }} Customer Review )</div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-money-dollar-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Price Regular</p>
                                                        <h5 class="mb-0">{{ number_format($item->price_regular) }}</h5>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                            <i class="ri-money-dollar-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Price sale</p>
                                                        <h5 class="mb-0">{{ number_format($item->price_sale) }}</h5>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mt-4">
                                                <h5 class="fs-14">Sizes :</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($sizes as $key => $value)
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                            data-bs-placement="top" title="Out of Stock">
                                                            <input type="radio" class="btn-check" name="productsize-radio"
                                                                id="productsize-radio1">
                                                            <label
                                                                class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center"
                                                                for="productsize-radio1">{{ $value }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-xl-6">
                                            <div class=" mt-4">
                                                <h5 class="fs-14">Colors :</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($colors as $key => $color)
                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                            data-bs-placement="top" title="Out of Stock">
                                                            <button type="button"
                                                                class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-primary"
                                                                disabled>

                                                                <span style="color: {{ $color }}" class=""><i
                                                                        class="ri-checkbox-blank-circle-fill"></i></span>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="mt-4 text-muted">
                                        <h5 class="fs-14">Description :</h5>
                                        <p>{{ $item->description }}</p>
                                    </div>

                                    <div class="product-content mt-5">
                                        <h5 class="fs-14 mb-3">Product Description :</h5>
                                        <nav>
                                            <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab"
                                                        href="#nav-speci" role="tab" aria-controls="nav-speci"
                                                        aria-selected="true">Specification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab"
                                                        href="#nav-detail" role="tab" aria-controls="nav-detail"
                                                        aria-selected="false">Details</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                                aria-labelledby="nav-speci-tab">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 200px;">Category</th>
                                                                <td>{{ $item->catelogue->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Material</th>
                                                                <td>{{ $item->material }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                                aria-labelledby="nav-detail-tab">
                                                <div>
                                                    <h5 class="font-size-16 mb-3">{{ $item->name }}
                                                    </h5>
                                                    <p>{{ $item->content }}</p>
                                                    <div>
                                                        <h5 class="font-size-16 mb-3">Tags</h5>
                                                        @foreach ($item->tags as $item)
                                                            <p class="mb-2"><i
                                                                    class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                                {{ $item->name }}</p>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product-content -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    @endforeach
@endsection

@section('style-libs')
    {{-- <script src="{{ asset('theme/admins/velzon/assets/js/layout.js') }}"></script> --}}
    <link href="{{ asset('theme/admins/velzon/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('theme/admins/velzon/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/admins/velzon/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/admins/velzon/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admins/velzon/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admins/velzon/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />


@endsection

@section('script-libs')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('theme/admins/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admins/velzon/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admins/velzon/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/admins/velzon/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/admins/velzon/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('theme/admins/velzon/assets/js/plugins.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('theme/admins/velzon/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
@endsection

@section('scripts')
    <!-- ecommerce product details init -->
    <script src="{{ asset('theme/admins/velzon/assets/js/pages/ecommerce-product-details.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('theme/admins/velzon/assets/js/app.js') }}"></script>
@endsection
