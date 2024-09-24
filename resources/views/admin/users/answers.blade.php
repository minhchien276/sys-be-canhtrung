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
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách câu trả lời</h6>
                <a href="javascript:history.back()" class="m-0 font-weight-bold text-primary" style="float: right;">Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nhật ký</th>
                                <th>Câu hỏi</th>
                                <th>Câu trả lời</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nhật ký</th>
                                <th>Câu hỏi</th>
                                <th>Câu trả lời</th>
                                <th>Thời gian</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($answers as $item)
                                <tr>
                                    <td>{{ $item->maNhatKy }}</td>
                                    <td>{{ $item->noiDung }}</td>
                                    <td>{{ $item->cauTraLoi }}</td>
                                    <td>{{ $item->thoiGian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
