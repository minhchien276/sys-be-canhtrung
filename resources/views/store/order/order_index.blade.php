@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách đơn hàng</h6>

                <form action="{{ route('store.order.search-orders') }}" method="get">
                    <div style="display: flex; justify-content: center; float: right; margin-bottom:10px" >
                        <input type="text" name="search" class="form-control" style="width: 250px; margin-right: 10px;" placeholder="Nhập tên hoặc nội dung ...">
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Nội dung</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th>Chi tiết</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Nội dung</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th>Chi tiết</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            @if ($item->payment_method == 0)
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
                                            @if ($item->status == 1)
                                                <div class="alert alert-secondary">
                                                    Đang xử lý
                                                </div>
                                            @elseif ($item->status == 2)
                                                <div class="alert alert-primary">
                                                    Đã xác nhận
                                                </div>
                                            @elseif ($item->status == 3)
                                                <div class="alert alert-warning">
                                                    Đang vận chuyển
                                                </div>
                                            @elseif ($item->status == 4)
                                                <div class="alert alert-success">
                                                    Đã giao hàng
                                                </div>
                                            @else
                                                <div class="alert alert-danger">
                                                    Đã hủy
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->final_price) }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ URL::to('/store/orders/order-details/' . $item->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/store/orders/edit-status/' . $item->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
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
