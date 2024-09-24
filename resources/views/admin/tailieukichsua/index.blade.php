@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách tài liệu kích sữa</h6>

                @if (session('success'))
                    <p style="margin-right: 200px" class="alert alert-success">
                        {{ session('success') }}
                    </p>
                @endif

                <a href="{{ route('tailieukichsua.create') }}" class="btn btn-primary">Tạo mới</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Ảnh bìa</th>
                                    <th>Link</th>
                                    <th>Loại tài liệu</th>
                                    <th>Thời gian tạo</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Ảnh bìa</th>
                                    <th>Link</th>
                                    <th>Loại tài liệu</th>
                                    <th>Thời gian tạo</th>
                                    <th>Sửa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tailieu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td><img style="width: 150px;" src="{{ $item->image }}" alt=""></td>
                                        <td>{{ $item->link }}</td>
                                        <td>
                                            @if ($item->type == 0)
                                                Ảnh
                                            @elseif ($item->type == 1)
                                                Video
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ URL::to('/admin/tailieukichsua/edit/' . $item->id) }}"
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
