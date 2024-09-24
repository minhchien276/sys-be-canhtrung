@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách tài khoản</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="accList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Quyền tài khoản</th>
                                    <th style="width: 100px;">Chi tiết</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Quyền tài khoản</th>
                                    <th style="width: 100px;">Chi tiết</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($auth as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->loaiQuyen }}</td>
                                        <td style="display: flex; justify-content: center;">
                                            <a href="{{ URL::to('/admin/auth/type-accounts/' . $item->maPhanQuyen) }}"
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

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách loại tư vấn viên</h6>

                <button id="createButton" class="btn btn-primary">Tạo mới</button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm mới loại tư vấn viên</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createForm" action="{{ route('loaitvv.create') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="type">Loại tư vấn viên:</label>
                                        <input type="text" id="type" class="form-control" name="type">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button id="saveButton" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="typeTvvList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Loại tư vấn viên</th>
                                    <th style="width: 100px;">Xóa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Loại tư vấn viên</th>
                                    <th style="width: 100px;">Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($loaitvv as $item)
                                    <tr id="typeTvv-{{ $item->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td style="display: flex; justify-content: center;">
                                            <a href="#" class="btn btn-sm btn-primary information delete-button"
                                                data-id="{{ $item->id }}" data-toggle="tooltip" title
                                                data-toggle="tooltip" title="Xóa">
                                                <i class="fas fa-trash"></i>
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
    
    <script>
        document.getElementById('createButton').addEventListener('click', function() {
            $('#createModal').modal('show');
        });

        $(document).ready(function() {
            $('#saveButton').click(function(e) {
                e.preventDefault();

                // Lấy dữ liệu từ form
                var type = $('#type').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        type: type
                    },
                    success: function(response) {
                        // Xử lý phản hồi thành công

                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#type').val('');

                        // Cập nhật danh sách type
                        loadTypeTvvList();
                        alertify.success('Thêm mới loại tư vấn viên thành công');
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        alertify.error('Thêm mới loại tư vấn viên thất bại');
                    }
                });
            });

            function loadTypeTvvList() {
                $.ajax({
                    url: '{{ route('load-type-tvv-list') }}',
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật danh link trong view
                        $('#typeTvvList').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>

    <script>
        $('.delete-button').click(function(e) {
            e.preventDefault();

            // Lấy ID của bài viết từ thuộc tính "data-id"
            var typeTvvId = $(this).data('id');

            // Hiển thị hộp thoại xác nhận
            var confirmed = confirm("Bạn có chắc chắn muốn xóa loại tư vấn viên này?");

            // Nếu người dùng chọn "OK", thực hiện yêu cầu Ajax để xóa loại tư vấn viên
            if (confirmed) {
                $.ajax({
                    url: '/admin/tuvanvien/delete-type-tvv/' + typeTvvId,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Xóa loại tư vấn viên khỏi giao diện người dùng nếu xóa thành công
                        $('#typeTvv-' + typeTvvId).remove();
                        console.log(response);

                        alertify.success('Xóa loại tư vấn viên thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alertify.error('Xóa loại tư vấn viên thất bại');
                    }
                });
            }
        });
    </script>
@endsection
