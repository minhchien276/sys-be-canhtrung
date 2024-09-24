@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách link</h6>

                <button id="createButton" class="btn btn-primary">Tạo mới</button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm mới đường link</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createForm" action="{{ route('link.create') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="link">Đường link:</label>
                                        <input type="text" id="link" class="form-control" name="link">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tiêu đề:</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả:</label>
                                        <input type="text" id="description" class="form-control" name="description">
                                    </div>
                                    <div class="form-group">
                                        <label for="member">Thành viên:</label>
                                        <input type="number" id="member" class="form-control" name="member">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        <input type="text" id="image" class="form-control" name="image">
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
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Id</th>
                                    <th>Đường link</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>thành viên</th>
                                    <th>Sửa link</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Id</th>
                                    <th>Đường link</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>thành viên</th>
                                    <th>Sửa link</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($link as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->maLink }}</td>
                                        <td>{{ $item->tenLink }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><img  style="width: 200px" src="{{ $item->image }}" alt=""></td>
                                        <td>{{ $item->member }}</td>
                                        <td>
                                            <a style="margin-left: 30px;"
                                                href="{{ URL::to('/admin/link/edit-link/' . $item->maLink) }}"
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
                var link = $('#link').val();
                var title = $('#title').val();
                var description = $('#description').val();
                var member = $('#member').val();
                var image = $('#image').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        link: link,
                        title: title,
                        description: description,
                        member: member,
                        image: image
                    },
                    success: function(response) {
                        // Xử lý phản hồi thành công

                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#link').val('');
                        $('#title').val('');
                        $('#description').val('');
                        $('#member').val('');
                        $('#image').val('');

                        // Cập nhật danh sách link
                        loadLinkList();
                        alertify.success('Thêm mới link thành công');
                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        alertify.error('Thêm mới link thất bại');
                    }
                });
            });

            // Hàm để tải lại danh sách link
            function loadLinkList() {
                $.ajax({
                    url: '{{ route('load-link-list') }}',
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật danh link trong view
                        $('#linkList').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
