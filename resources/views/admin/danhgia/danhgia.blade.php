@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Chi tiết đánh giá tư vấn viên @if ($danhgia && $danhgia->count() > 0)
                        {{ $danhgia->first()->tenTvv }}
                    @endif
                </h6>

                <a href="javascript:history.back()" class="m-0 font-weight-bold text-primary" style="float: right;">Back</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="accList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Số điện thoại</th>
                                    <th>Đánh giá</th>
                                    <th>Sao</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Số điện thoại</th>
                                    <th>Đánh giá</th>
                                    <th>Sao</th>
                                    <th>Thời gian</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($danhgia as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tenNguoiDung }}</td>
                                        <td>{{ $item->taiKhoan }}</td>
                                        <td>{{ $item->danhgia }}</td>
                                        <td>{{ $item->sao }}</td>
                                        <td>{{ $item->thoiGian }}</td>
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
