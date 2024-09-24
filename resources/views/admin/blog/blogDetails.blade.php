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
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách bài viết</h6>

                <a id="createButton" class="font-weight-bold text-primary" style="margin-right: 100px; cursor: pointer;">Tạo mới</a>

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
                            <form id="createForm" action="{{ route('blog.create') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        <input type="text" id="image" class="form-control" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tiêu đề:</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội dung:</label>
                                        <textarea name="content" id="content" cols="50" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link:</label>
                                        <input type="text" id="link" class="form-control" name="link">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="date">Thời gian:</label>
                                        <input type="text" id="date" class="form-control" name="date">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="type">Loại bài viết:</label>
                                        <input type="text" id="type_blog_id" class="form-control" name="type_blog_id"
                                            value="{{ $id }}">
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
                    <div id="listBlog">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Link</th>
                                    <th>Thời gian</th>
                                    <th style="width: 100px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Link</th>
                                    <th>Thời gian</th>
                                    <th style="width: 100px;">Thao tác</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($blogs as $item)
                                    <tr id="blog-{{ $item->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img style="width: 200px;" src="{{ $item->image }}"></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary information edit-button"
                                                data-id="{{ $item->id }}" data-image="{{ $item->image }}"
                                                data-title="{{ $item->title }}" data-content="{{ $item->content }}"
                                                data-link="{{ $item->link }}" data-date="{{ $item->date }}"
                                                data-url="{{ URL::to('/admin/blog/update/' . $item->id) }}"
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
                                                                    <label for="image">Ảnh:</label>
                                                                    <input type="text" id="image"
                                                                        class="form-control" name="image">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title">Tiêu đề:</label>
                                                                    <input type="text" id="title"
                                                                        class="form-control" name="title">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="content">Nội dung:</label>
                                                                    <textarea name="content" id="content" cols="50" rows="2"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="link">Link:</label>
                                                                    <input type="text" id="link"
                                                                        class="form-control" name="link">
                                                                </div>
                                                                <div class="form-group" hidden>
                                                                    <label for="date">Thời gian:</label>
                                                                    <input type="text" id="date"
                                                                        class="form-control" name="date">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Đóng</button>
                                                                <button class="btn btn-primary saveEditButton">Lưu</button>
                                                                <!-- Bỏ href và thêm class -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <a href="#" class="btn btn-sm btn-primary information delete-button"
                                                data-id="{{ $item->id }}" data-toggle="tooltip" title="Xóa">
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
                var image = $('#image').val();
                var title = $('#title').val();
                var content = $('textarea#content').val();
                var link = $('#link').val();
                var date = $('#date').val();
                var type_blog_id = $('#type_blog_id').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        image: image,
                        title: title,
                        content: content,
                        link: link,
                        date: date,
                        type_blog_id: type_blog_id
                    },
                    success: function(response) {
                        // Xử lý phản hồi thành công

                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#image').val('');
                        $('#title').val('');
                        $('textarea#content').val('');
                        $('#link').val('');
                        $('#date').val('');
                        $('#type_blog_id').val(type_blog_id);

                        // Cập nhật danh sách hôp test
                        $('#listBlog').html(response.html);

                        alertify.success('Thêm mới bài viết thành công');
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        console.log(xhr.responseText);
                        alertify.error('Thêm mới bài viết thất bại');
                    }
                });
            });

            $('.delete-button').click(function(e) {
                e.preventDefault();

                // Lấy ID của bài viết từ thuộc tính "data-id"
                var blogId = $(this).data('id');

                // Hiển thị hộp thoại xác nhận
                var confirmed = confirm("Bạn có chắc chắn muốn xóa bài viết này?");

                // Nếu người dùng chọn "OK", thực hiện yêu cầu Ajax để xóa bài viết
                if (confirmed) {
                    $.ajax({
                        url: '/admin/blog/delete/' + blogId,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Xóa bài viết khỏi giao diện người dùng nếu xóa thành công
                            $('#blog-' + blogId).remove();

                            alertify.success('Xóa bài viết thành công');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alertify.error('Xóa bài viết thất bại');
                        }
                    });
                }
            });


            ////////////////////////////////
            $(document).ready(function() {
                $('.edit-button').click(function(e) {
                    e.preventDefault();

                    var blogId = $(this).data('id');
                    var image = $(this).data('image');
                    var title = $(this).data('title');
                    var content = $(this).data('content');
                    var link = $(this).data('link');
                    var date = $(this).data('date');
                    var url = $(this).data('url'); // Lấy URL từ data-url

                    $('#editModal').modal('show');
                    $('#editModal').find('#blog_id').val(blogId);
                    $('#editModal').find('#image').val(image);
                    $('#editModal').find('#title').val(title);
                    $('#editModal').find('textarea#content').val(content);
                    $('#editModal').find('#link').val(link);
                    $('#editModal').find('#date').val(date);

                    // Lắng nghe sự kiện click của nút "Lưu" trong modal
                    $('.saveEditButton').click(function(e) {
                        e.preventDefault();

                        var blogId = $('#editModal').find('#blog_id').val();
                        var image = $('#editModal').find('#image').val();
                        var title = $('#editModal').find('#title').val();
                        var content = $('#editModal').find('textarea#content').val();
                        var link = $('#editModal').find('#link').val();
                        var date = $('#editModal').find('#date').val();

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content'),
                                image: image,
                                title: title,
                                content: content,
                                link: link,
                                date: date
                            },
                            success: function(response) {
                                // Cập nhật lại thông tin của blog trên giao diện
                                var blogRow = $('#blog-' + blogId);
                                blogRow.find('td:nth-child(2)').text(image);
                                blogRow.find('td:nth-child(3)').text(title);
                                blogRow.find('td:nth-child(4)').text(content);
                                blogRow.find('td:nth-child(5)').text(link);
                                blogRow.find('td:nth-child(6)').text(date);
                                // Đóng modal sau khi sửa thành công
                                $('#editModal').modal('hide');
                                alertify.success('Sửa bài viết thành công');
                            },
                            error: function(xhr, status, error) {
                                // Xử lý lỗi (nếu cần)
                                console.log(xhr.responseText);
                                alertify.error('Sửa bài viết thất bại');
                            }
                        });
                    });
                });
            });

        });
    </script>
@endsection
