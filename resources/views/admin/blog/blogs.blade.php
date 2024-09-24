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
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách loại bài viết</h6>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a id="createButton" class="font-weight-bold text-primary" style="margin-right: 100px; cursor: pointer;">Tạo
                    mới</a>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm mới bài viết</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createForm" action="{{ route('type-blog.create') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="type_blog">Loại bài viết:</label>
                                        <input type="text" id="type_blog" class="form-control" name="type_blog">
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

                <a href="javascript:history.back()" class="m-0 font-weight-bold text-primary" style="float: right;">Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="listTypeBlog">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Id</th>
                                    <th>Loại bài viết</th>
                                    <th>Tên loại bài viết</th>
                                    <th>Trạng thái</th>
                                    <th>Dạng</th>
                                    <th style="width: 100px;">Chi tiết</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Id</th>
                                    <th>Loại bài viết</th>
                                    <th>Tên loại bài viết</th>
                                    <th>Trạng thái</th>
                                    <th>Dạng</th>
                                    <th style="width: 100px;">Chi tiết</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($blogs as $item)
                                    <tr id="blog-{{ $item->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                Hiện
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->isHorizontal == 1)
                                                Ngang
                                            @else
                                                Dọc
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/admin/blog/find-by-type/' . $item->id) }}"
                                                class="btn btn-sm btn-primary information" data-id=""
                                                data-toggle="tooltip" title="Chi tiết">
                                                <i class="far fa-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-primary information edit-button"
                                                data-id="{{ $item->id }}" data-type_blog="{{ $item->type }}"
                                                data-name="{{ $item->name }}" data-status="{{ $item->status }}"
                                                data-isHorizontal="{{ $item->isHorizontal }}"
                                                data-url="{{ URL::to('/admin/type-blog/update/' . $item->id) }}"
                                                data-toggle="modal" data-target="#editModal">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <!-- Modal content -->
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Sửa bài viết</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="editForm" action="" method="POST">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="blog_id" id="blog_id">
                                                                <div class="form-group">
                                                                    <label for="type_blog">Thể loại:</label>
                                                                    <input type="text" id="type_blog"
                                                                        class="form-control" name="type_blog"
                                                                        value="{{ $item->type }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Tên thể loại bài
                                                                        viết:</label>
                                                                    <select name="name" id="name"
                                                                        class="form-control">
                                                                        <option value="biquyet"
                                                                            {{ old('name', $item->name) == 'biquyet' ? 'selected' : '' }}>
                                                                            biquyet</option>
                                                                        <option value="quanhe"
                                                                            {{ old('name', $item->name) == 'quanhe' ? 'selected' : '' }}>
                                                                            quanhe</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Trạng thái:</label>
                                                                    <select name="status" id="status"
                                                                        class="form-control">
                                                                        <option value="1"
                                                                            {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                                                            Hiện</option>
                                                                        <option value="0"
                                                                            {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                                                            Ẩn</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="isHorizontal">Dạng:</label>
                                                                    <select name="isHorizontal" id="isHorizontal"
                                                                        class="form-control">
                                                                        <option value="1"
                                                                            {{ old('isHorizontal', $item->isHorizontal) == 1 ? 'selected' : '' }}>
                                                                            Ngang</option>
                                                                        <option value="0"
                                                                            {{ old('isHorizontal', $item->isHorizontal) == 0 ? 'selected' : '' }}>
                                                                            Dọc</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Đóng</button>
                                                                <button class="btn btn-primary saveEditButton">Lưu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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
                var type_blog = $('#type_blog').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        type_blog: type_blog,
                    },
                    success: function(response) {
                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#type_blog').val('');

                        // Hiển thị thông báo thành công
                        alertify.success('Thêm mới loại bài viết thành công');

                        // Tải lại trang để cập nhật danh sách loại bài viết
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        console.log(xhr.responseText);
                        alertify.error('Thêm mới loại bài viết thất bại');
                    }
                });
            });
        });


        ////////////////////////////////////////////////////////////////////////
        $('.delete-button').click(function(e) {
            e.preventDefault();

            // Lấy ID của bài viết từ thuộc tính "data-id"
            var blogId = $(this).data('id');

            // Hiển thị hộp thoại xác nhận
            var confirmed = confirm("Bạn có chắc chắn muốn xóa thể loại này?");

            // Nếu người dùng chọn "OK", thực hiện yêu cầu Ajax để xóa thể loại
            if (confirmed) {
                $.ajax({
                    url: '/admin/type-blog/delete/' + blogId,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Xóa thể loại khỏi giao diện người dùng nếu xóa thành công
                        $('#blog-' + blogId).remove();

                        alertify.success('Xóa thể loại thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alertify.error('Xóa thể loại thất bại');
                    }
                });
            }
        });

        ////////////////////////////////
        $(document).ready(function() {
            $('.edit-button').click(function(e) {
                e.preventDefault();

                var typeBlogId = $(this).data('id');
                var type_blog = $(this).data('type_blog');
                var name = $(this).data('name');
                var status = $(this).data('status');
                var isHorizontal = $(this).data('isHorizontal');
                var url = $(this).data('url'); // Lấy URL từ data-url

                $('#editModal').modal('show');
                $('#editModal').find('#blog_id').val(typeBlogId); // Đặt giá trị cho trường blog_id
                $('#editModal').find('#type_blog').val(type_blog);
                $('#editModal').find('#name').val(name);
                $('#editModal').find('#status').val(status);
                $('#editModal').find('#isHorizontal').val(isHorizontal);

                // Hủy sự kiện click cũ của .saveEditButton (nếu có)
                $('.saveEditButton').off('click');

                // Lắng nghe sự kiện click mới của .saveEditButton
                $('.saveEditButton').on('click', function(e) {
                    e.preventDefault();

                    // Lấy dữ liệu từ form
                    var type_blog = $('#editModal').find('#type_blog').val();
                    var name = $('#editModal').find('#name').val();
                    var status = $('#editModal').find('#status').val();
                    var isHorizontal = $('#editModal').find('#isHorizontal').val();

                    // Kiểm tra xem url có giá trị hay không
                    if (!url) {
                        alertify.error('URL cập nhật không hợp lệ');
                        return;
                    }

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            type_blog: type_blog,
                            name: name,
                            status: status,
                            isHorizontal: isHorizontal,
                        },
                        success: function(response) {
                            // Cập nhật lại thông tin của blog trên giao diện
                            var blogRow = $('#blog-' + typeBlogId);
                            blogRow.find('td:nth-child(3)').text(type_blog);
                            blogRow.find('td:nth-child(4)').text(name);
                            blogRow.find('td:nth-child(5)').text(status);
                            blogRow.find('td:nth-child(6)').text(isHorizontal);

                            // Đóng modal sau khi sửa thành công
                            $('#editModal').modal('hide');
                            alertify.success('Sửa thể loại bài viết thành công');
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi (nếu cần)
                            console.log(xhr.responseText);
                            alertify.error('Sửa thể loại bài viết thất bại');
                        }
                    });
                });
            });
        });
    </script>
@endsection
