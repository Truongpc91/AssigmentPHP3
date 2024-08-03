@extends('admin.layouts.master')

@section('title')
    Add New Product
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add new Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Add new Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.products.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        {{-- Information Product --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information Product</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" value="0" class="form-control" id="price_regular"
                                            name="price_regular">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" value="0" class="form-control" id="price_sale"
                                            name="price_sale">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catelogue_id" class="form-label">Catalogues</label>
                                        <select type="text" class="form-select" id="catelogue_id" name="catelogue_id">
                                            @foreach ($catelogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="image_thumbnail" class="form-label">Img Thumbnail</label>
                                        <input type="file" class="form-control" id="image_thumbnail"
                                            name="image_thumbnail">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        @php
                                            $is = [
                                                'is_active' => 'primary',
                                                'is_hot_deal' => 'danger',
                                                'is_good_deal' => 'warning',
                                                'is_new' => 'success',
                                                'is_show_home' => 'info',
                                            ];
                                        @endphp

                                        @foreach ($is as $key => $color)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-{{ $color }}">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="{{ $key }}" value="1" id="{{ $key }}"
                                                        @if ($key == 'is_active') checked @endif>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ \Str::convertCase($key, MB_CASE_TITLE) }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" id="material" name="material" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="user_manual" class="form-label">User Manual</label>
                                            <textarea class="form-control" id="user_manual" name="user_manual" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Variants --}}
        {{-- <div class="row" style="height: 300px; overflow:scroll">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Variants Products</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <table class="table-responsive">
                                    <tr >
                                        <th class="text-center">Size</th>
                                        <th>Color</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Image</th>
                                    </tr>

                                    @foreach ($sizes as $sizeID => $sizeName)
                                        @php($flagRowspan = true)

                                        @foreach ($colors as $colorID => $colorName)
                                            <tr class="text-center">

                                                @if ($flagRowspan)
                                                    <td style="vertical-align: middle;" rowspan="{{ count($colors) }}">
                                                        <b>{{ $sizeName }}</b></td>
                                                @endif
                                                @php($flagRowspan = false)

                                                <td>
                                                    <div
                                                        style="width: 50px; height: 50px; background: {{ $colorName }};">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="0"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quatity]">
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Variants Products</h4>
                    </div><!-- end card header -->
                    <div class="card-body" style="height: 450px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="text-center">
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                        </tr>

                                        @foreach ($sizes as $sizeID => $sizeName)
                                            @php($flagRowspan = true)

                                            @foreach ($colors as $colorID => $colorName)
                                                <tr class="text-center">

                                                    @if ($flagRowspan)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}"><b>{{ $sizeName }}</b></td>
                                                    @endif
                                                    @php($flagRowspan = false)

                                                    <td>
                                                        <div class="rounded rounded-circle border border-dark"
                                                            style="width: 30px; height: 30px; background: {{ $colorName }};">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="100"
                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->

            {{-- Gallery --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                            <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4" id="gallery_list">
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                id="gallery_default">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

            {{-- Select Tag --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="tags" class="form-label">Tags</label>
                                            <select class="form-control" id="tags" name="tags[]" multiple>
                                                @foreach ($tags as $id => $name)
                                                    <option value="{{ $id }}"> {{ $name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <button style="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

@section('style-libs')
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-md-4" id="${id}_item">
                <label for="${id}" class="form-label">Image</label>
                <div class="d-flex">
                    <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                    <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                        <span class="bx bx-trash"></span>
                    </button>
                </div>
            </div>
        `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
