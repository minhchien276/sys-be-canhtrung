@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Chi tiết đơn hàng {{ $orders->content }}</h6>

                <a href="javascript:history.back()" class="m-0 font-weight-bold text-primary" style="float: right;">Back</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Nội dung</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Phí ship</th>
                                    <th>Giảm giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Thời gian tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $orders->name }}</td>
                                    <td>{{ $orders->content }}</td>
                                    <td>
                                        @if ($orders->payment_method == 0)
                                            <div class="alert alert-success">
                                                Chuyển khoản
                                            </div>
                                        @else
                                            <div class="alert alert-primary">
                                                Tiền mặt
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($orders->status == 1)
                                            <div class="alert alert-secondary">
                                                Đang xử lý
                                            </div>
                                        @elseif ($orders->status == 2)
                                            <div class="alert alert-primary">
                                                Đã xác nhận
                                            </div>
                                        @elseif ($orders->status == 3)
                                            <div class="alert alert-warning">
                                                Đang vận chuyển
                                            </div>
                                        @elseif ($orders->status == 4)
                                            <div class="alert alert-success">
                                                Đã giao hàng
                                            </div>
                                        @else
                                            <div class="alert alert-danger">
                                                Đã hủy
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $orders->phone }}</td>
                                    <td>{{ $orders->address }}</td>
                                    <td>{{ number_format($orders->ship_price) }}</td>
                                    <td>{{ number_format($orders->sale_price) }}</td>
                                    <td>
                                        <div class="alert alert-danger">
                                            {{ number_format($orders->final_price) }}
                                        </div>
                                    </td>
                                    <td>{{ $orders->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách sản phẩm của đơn hàng {{ $orders->content }}
                </h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img style="width: 150px" src="{{ $item->image }}" alt="">
                                        </td>
                                        <td>{{ number_format($item->sale) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endsection
