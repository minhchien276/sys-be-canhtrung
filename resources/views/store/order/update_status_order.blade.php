@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật trạng thái đơn hàng</h6>

                <div class="card-body">
                    <form action="{{ route('store.order.update-status', ['id' => $order->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Tên khách hàng:</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    value="{{ old('name', $order->name) }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" id="phone" class="form-control" name="phone"
                                    value="{{ old('phone', $order->phone) }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="content">Nội dung:</label>
                                <input type="text" id="content" class="form-control" name="content"
                                    value="{{ old('content', $order->content) }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="payment_method">Phương thức thanh toán:</label>
                                <select id="payment_method" class="form-control" name="payment_method" disabled>
                                    <option value="0"
                                        {{ old('payment_method', $order->payment_method) == '0' ? 'selected' : '' }}>Chuyển khoản
                                    </option>
                                    <option value="1"
                                        {{ old('payment_method', $order->payment_method) == '1' ? 'selected' : '' }}>Tiền mặt
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái:</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="1"
                                        {{ old('status', $order->status) == '1' ? 'selected' : '' }}>Đang xử lý
                                    </option>
                                    <option value="2"
                                        {{ old('status', $order->status) == '2' ? 'selected' : '' }}>Đã xác nhận
                                    </option>
                                    <option value="3"
                                        {{ old('status', $order->status) == '3' ? 'selected' : '' }}>Đang
                                        vận chuyển</option>
                                    <option value="4"
                                        {{ old('status', $order->status) == '4' ? 'selected' : '' }}>Đã giao
                                        hàng</option>
                                    <option value="5"
                                        {{ old('status', $order->status) == '5' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                @error('status')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Quay lại</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
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

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    @endsection
