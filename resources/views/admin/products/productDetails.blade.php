@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Chi tiết sản phẩm</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Giá giảm</th>
                                    <th>Mô tả</th>
                                    <th>Thành phần</th>
                                    <th>Hướng dãn sử dụng</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Giá giảm</th>
                                    <th>Mô tả</th>
                                    <th>Thành phần</th>
                                    <th>Hướng dãn sử dụng</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($productDetails as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img style="width: 200px" src="{{ $item->image }}" alt=""></td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                        <td>{{ number_format($item->sale, 0, ',', '.') }} VND</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>{{ $item->guide }}</td>
                                        <td>
                                            <a href="{{ URL::to('/admin/product/edit-product-details/' . $item->id) }}"
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
