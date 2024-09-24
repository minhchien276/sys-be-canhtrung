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
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách quảng cáo</h6>

                {{-- <button id="createButton" class="btn btn-primary">Tạo mới</button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thêm mới quảng cáo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="createForm" action="{{ route('quangcao.create') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        <input type="text" id="image" class="form-control" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="phase">Phase:</label>
                                        <input type="text" id="phase" class="form-control" name="phase">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Loại:</label>
                                        <input type="text" id="type" class="form-control" name="type">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Link:</label>
                                        <input type="text" id="link" class="form-control" name="link">
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="listQuangCao">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Phase</th>
                                    <th>Loại</th>
                                    <th>Trạng thái</th>
                                    <th>Lượt click</th>
                                    <th style="width: 40px;">Sửa</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Phase</th>
                                    <th>Loại</th>
                                    <th>Trạng thái</th>
                                    <th>Lượt click</th>
                                    <th style="width: 40px;">Sửa</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($quangcao as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img style="width: 200px;" src="{{ $item->image }}"></td>
                                        <td>
                                            @if ($item->phase == 1)
                                                Quản lý kỳ kinh
                                            @elseif ($item->phase == 2)
                                                Hỗ trợ mang thai
                                            @elseif ($item->phase == 3)
                                                Theo dõi thai kì
                                            @elseif ($item->phase == 4)
                                                Chăm số mẹ bé
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->type == 0)
                                                Quảng cáo tổng
                                            @elseif ($item->type == 1)
                                                Quảng cáo ngày kinh
                                            @elseif ($item->type == 2)
                                                Quảng cáo ngày an toàn
                                            @elseif ($item->type == 3)
                                                Quảng cáo ngày rụng trứng
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                Hiện
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td>{{ $item->count_records }}</td>
                                        <td>
                                            <a href="{{ URL::to('/admin/quangcao/edit/' . $item->id) }}"
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

    {{-- <script>
        document.getElementById('createButton').addEventListener('click', function() {
            $('#createModal').modal('show');
        });

        $(document).ready(function() {
            $('#saveButton').click(function(e) {
                e.preventDefault();

                // Lấy dữ liệu từ form
                var image = $('#image').val();
                var phase = $('#phase').val();
                var type = $('#type').val();
                var link = $('#link').val();

                // Gửi yêu cầu Ajax
                $.ajax({
                    url: $('#createForm').attr('action'),
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        image: image,
                        phase: phase,
                        type: type,
                        link: link
                    },
                    success: function(response) {
                        console.log(response)
                        // Xử lý phản hồi thành công
                        // Đóng modal và làm sạch form
                        $('#createModal').modal('hide');
                        $('#image').val('');
                        $('#phase').val('');
                        $('#type').val('');
                        $('#link').val('');

                        // Cập nhật danh sách hôp test
                        loadListQuangCao();
                        alertify.success('Thêm mới quảng cáo thành công');

                    },
                    error: function(xhr, status, error) {
                        // Xử lý phản hồi lỗi
                        console.log(xhr.responseText);
                        // alertify.error('Thêm mới quảng cáo thất bại');
                        var errors = xhr.responseJSON.error;
                        var errorMessage = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessage += errors[key][0] + '\n';
                            }
                        }
                        alertify.error(errorMessage);
                    }
                });
            });
        });

        function loadListQuangCao() {
            $.ajax({
                url: '{{ route('load-quang-cao-list') }}',
                type: 'GET',
                success: function(response) {
                    $('#listQuangCao').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script> --}}
@endsection
