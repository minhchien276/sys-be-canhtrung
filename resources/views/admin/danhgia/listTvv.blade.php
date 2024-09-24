@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách tư vấn viên</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="accList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    {{-- <th>Ảnh</th> --}}
                                    <th>Tên tư vấn viên</th>
                                    <th style="width: 200px;">Chi tiết đánh giá</th>
                                    <th style="width: 150px;">Sửa sao</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    {{-- <th>Ảnh</th> --}}
                                    <th>Tên tư vấn viên</th>
                                    <th style="width: 200px;">Chi tiết đánh giá</th>
                                    <th style="width: 150px;">Sửa sao</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tvv as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td><img style="width: 200px;" src="{{ $item->linkAnh }}"></td> --}}
                                        <td>{{ $item->tenTvv }}</td>
                                        <td style="display: flex; justify-content: center;">
                                            <a href="{{ URL::to('/admin/danhgia/show-danh-gia/' . $item->maTvv) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-file"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a style="margin-left: 75px" href="{{ URL::to('/admin/danhgia/edit-sao/' . $item->maTvv) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-star"></i>
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
