@extends('admin.layouts.master')

@section('title')
    List Bills
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Bills</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Bills</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">List Bills</h5>

                    {{-- <a href="{{ route('admin.bills.create') }}" class="btn btn-primary mb-3">Add New</a> --}}
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Uname</th>
                                <th>Uemail</th>
                                <th>Uphone</th>
                                <th>Uaddress</th>
                                <th>Unote</th>
                                <th>Status</th>
                                <th>Status payment</th>
                                <th>Total price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->user_email }}</td>
                                    <td>{{ $item->user_phone }}</td>
                                    <td>{{ $item->user_address }}</td>
                                    <td>{{ $item->user_note }}</td>
                                    <td>
                                        @if ($item->status_order == 'pending')
                                            <span class="badge bg-warning">{{ $item->status_order }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $item->status_order }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_payment == 'unpaid')
                                            <span class="badge bg-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="badge bg-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->total_price) }} vnđ</td>
                                    <td>
                                        @if ($item->status_order == 'pending')
                                            <div class="h2 text-center">
                                                <a onclick="return confirm('Xác nhận đơn hàng này ?')"
                                                    href="{{ route('admin.confirmBill', $item->id) }}" class="text-success"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="Xác nhận đơn hàng"><i class="fas fa-check"></i></a>
                                            </div>
                                        @else
                                            <div class="h2 text-center">
                                                <a onclick="return confirm('Gửi mail hóa đơn !')"
                                                    href="{{ route('admin.sendmailbill', [$item->id, $item->user_email]) }}"
                                                    class="text-primary" data-toggle="tooltip" data-placement="bottom"
                                                    title="Gửi hóa đơn"><i class="fas fa-mail-bulk"></i></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
