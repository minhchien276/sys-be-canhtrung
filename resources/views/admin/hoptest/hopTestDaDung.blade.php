@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Số lượng que test còn lại của người dùng</h6>

                <form action="{{ route('count-hoptest') }}" method="get">
                    <div style="display: flex; justify-content: center">
                        <input style="margin-right: 10px;" type="date" id="ngayTao" name="ngayTao"
                            class="form-control"
                            @if ($ngayTao) value="{{ old('ngayTao', $ngayTao) }}" @endif />
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Kiểm tra</button>

                        <input type="text" style="width: 50px; margin-left: 10px; text-align: center;"
                            value="{{ $count_hoptest }}" disabled>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hopTestList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Số điện thoại</th>
                                    <th>Que thai còn lại</th>
                                    <th>Que trứng còn lại</th>
                                    {{-- <th>Ngày quét mã</th> --}}
                                    <th>Thêm lượt test</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Số điện thoại</th>
                                    <th>Que thai còn lại</th>
                                    <th>Que trứng còn lại</th>
                                    {{-- <th>Ngày quét mã</th> --}}
                                    <th>Thêm lượt test</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    use App\Helpers\QrCodeHelper;
                                @endphp
                                @foreach ($hoptest as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tenNguoiDung }}</td>
                                        <td>{{ $item->taiKhoan }}</td>
                                        <td>{{ $item->soLuongQueThai }}</td>
                                        <td>{{ $item->soLuongQueTrung }}</td>
                                        {{-- <td>{{ $item->ngayTao }}</td> --}}
                                        <td>
                                            <a href="{{ URL::to('/admin/quan-ly-hop-test/add-luot-test/' . $item->maQuanLyQueTest) }}"
                                                style="margin-left: 30px;" class="btn btn-sm btn-primary information"
                                                data-id="" data-toggle="tooltip" title="">
                                                <i class="fa fa-plus"></i>
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

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
@endsection
