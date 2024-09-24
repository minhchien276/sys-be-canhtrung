@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách tài khoản</h6>

                {{-- <button style="margin-right: 100px;" id="createButton" class="btn btn-primary">Thêm quyền</button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm quyền mới</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createForm" action="{{ route('quyen.create') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="maPhanQuyen">Mã quyền:</label>
                                        <input type="text" id="maPhanQuyen" class="form-control" name="maPhanQuyen">
                                    </div>

                                    <div class="form-group">
                                        <label for="loaiQuyen">Tên quyền:</label>
                                        <input type="text" id="loaiQuyen" class="form-control" name="loaiQuyen">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button id="saveButton" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

                <button id="createButtonAcc" class="btn btn-primary">Thêm tài khoản</button>

                <div class="modal fade" id="createModalAcc" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm tài khoản mới</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createFormAcc" action="{{ route('account.create') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="maPhanQuyenAcc">Quyền:</label>
                                        <select id="maPhanQuyenAcc" class="form-control" name="maPhanQuyen">
                                            <option value="" selected disabled>Chọn quyền</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" class="form-control" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="taiKhoan">Tài khoản:</label>
                                        <input type="text" id="taiKhoan" class="form-control" name="taiKhoan">
                                    </div>

                                    <div class="form-group">
                                        <label for="matKhau">Mật khẩu:</label>
                                        <input type="text" id="matKhau" class="form-control" name="matKhau">
                                    </div>

                                    <div class="form-group">
                                        <label for="tenNguoiDung">Tên người dùng:</label>
                                        <input type="text" id="tenNguoiDung" class="form-control" name="tenNguoiDung">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button id="saveButtonAcc" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="accList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Đổi mật khẩu</th>
                                    <th style="width: 120px;">Xóa tài khoản</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Đổi mật khẩu</th>
                                    <th style="width: 120px;">Xóa tài khoản</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($auth as $item)
                                    <tr id="acc-{{ $item->maNguoiDung }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tenNguoiDung }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td style="display: flex; justify-content: center;">
                                            <a href="{{ URL::to('/admin/auth/change-password/' . $item->maNguoiDung) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="#" class="btn btn-sm btn-primary information delete-button"
                                                data-id="{{ $item->maNguoiDung }}" data-toggle="tooltip" title
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

    {{-- <script>
        document.getElementById('createButton').addEventListener('click', function() {
            $('#createModal').modal('show');
        });

        $(document).ready(function() {
            $('#saveButton').click(function(e) {
                e.preventDefault();

                // Lấy dữ liệu từ form
                var maPhanQuyen = $('#maPhanQuyen').val();
                var loaiQuyen = $('#loaiQuyen').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        maPhanQuyen: maPhanQuyen,
                        loaiQuyen: loaiQuyen
                    },
                    success: function(response) {
                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#maPhanQuyen').val('');
                        $('#loaiQuyen').val('');
                        console.log(response)
                        // Cập nhật danh sách hôp test
                        alertify.success('Thêm quyền mới thành công');
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        console.log(xhr.responseText);
                        alertify.error('Thêm quyền mới thất bại');
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Gửi yêu cầu Ajax để lấy danh sách mã phân quyền
            $.ajax({
                url: '{{ route('quyen.get') }}', // Đặt URL tới hàm lấy danh sách mã phân quyền trong controller của bạn
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var selectElement = $('#maPhanQuyenAcc');

                    // Xóa các tùy chọn hiện tại (nếu có)
                    selectElement.empty();

                    // Tạo tùy chọn mặc định với giá trị rỗng
                    selectElement.append('<option value="" selected disabled>Chọn quyền</option>');

                    // Thêm các tùy chọn từ danh sách mã phân quyền vào phần tử select
                    response.forEach(function(quyen) {
                        selectElement.append('<option value="' + quyen.maPhanQuyen + '">' +
                            quyen.loaiQuyen + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Không thể lấy danh sách mã phân quyền.');
                }
            });
        });
    </script>

    <script>
        document.getElementById('createButtonAcc').addEventListener('click', function() {
            $('#createModalAcc').modal('show');
        });

        $(document).ready(function() {
            $('#saveButtonAcc').click(function(e) {
                e.preventDefault();

                // Lấy dữ liệu từ form
                var maPhanQuyenAcc = $('#maPhanQuyenAcc').val();
                var email = $('#email').val();
                var taiKhoan = $('#taiKhoan').val();
                var matKhau = $('#matKhau').val();
                var tenNguoiDung = $('#tenNguoiDung').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createFormAcc').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        maPhanQuyen: maPhanQuyenAcc,
                        email: email,
                        taiKhoan: taiKhoan,
                        matKhau: matKhau,
                        tenNguoiDung: tenNguoiDung,
                    },
                    success: function(response) {
                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#maPhanQuyenAcc').val('');
                        $('#email').val('');
                        $('#taiKhoan').val('');
                        $('#matKhau').val('');
                        $('#tenNguoiDung').val('');

                        // Cập nhật danh sách tài khoản
                        loadListAcc()
                        alertify.success('Thêm tài khoản mới thành công');
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        console.log(xhr.responseText);
                        alertify.error('Thêm tài khoản mới thất bại');
                    }
                });
            });
        });

        // Hàm để tải lại danh sách tài khoản
        function loadListAcc() {
            $.ajax({
                url: '{{ route('load-list-acc') }}',
                type: 'GET',
                success: function(response) {
                    // Cập nhật danh sách tài khoản trong view
                    $('#accList').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        $('.delete-button').click(function(e) {
            e.preventDefault();

            // Lấy ID của bài viết từ thuộc tính "data-id"
            var accId = $(this).data('id');

            // Hiển thị hộp thoại xác nhận
            var confirmed = confirm("Bạn có chắc chắn muốn xóa tài khoản này?");

            // Nếu người dùng chọn "OK", thực hiện yêu cầu Ajax để xóa tài khoản
            if (confirmed) {
                $.ajax({
                    url: '/admin/auth/delete/' + accId,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Xóa tài khoản khỏi giao diện người dùng nếu xóa thành công
                        $('#acc-' + accId).remove();
                        console.log(response);

                        alertify.success('Xóa tài khoản thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alertify.error('Xóa tài khoản thất bại');
                    }
                });
            }
        });
    </script>
@endsection
