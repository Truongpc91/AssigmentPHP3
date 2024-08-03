@extends('admin.layouts.master')

@section('title')
    Add New Banner
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add New Banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Banner</a></li>   
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="mt-3">
                                        <label for="image" class="form-label">Image banner</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                    {{-- <div class="form-check form-switch form-switch-primary mt-3">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               name="status" id="status" checked value="1">
                                        <label class="form-check-label" for="status">Status</label>
                                    </div> --}}
                                    <div>
                                        <label for="name" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" id="name">
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