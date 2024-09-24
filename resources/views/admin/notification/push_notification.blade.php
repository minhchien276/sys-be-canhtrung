@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Gửi thông báo tổng</h6>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-alert').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" id="error-alert">
                            {{ Session::get('error') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error-alert').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif
                    <form action="{{ route('notification.send') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="notification">Thông báo:</label>
                                        <select name="notification" id="notification" class="form-control">
                                            <option value="0">Thông báo tổng</option>
                                            <option value="1">Thông báo phase trứng</option>
                                            <option value="2">Thông báo phase an toàn</option>
                                            <option value="3">Thông báo phase bầu</option>
                                            <option value="4">Thông báo phase sữa</option>
                                            <option value="5">Thông báo phase vị thành niên</option>
                                        </select>
                                        @error('notification')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type_noti">Thông báo:</label>
                                        <select name="type_noti" id="type_noti" class="form-control">
                                            <option value="0">Thông báo thường</option>
                                            <option value="2">Thông báo khuyến mãi</option>
                                        </select>
                                        @error('type_noti')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tiêu đề:</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                        @error('title')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội dung:</label>
                                        <input type="text" id="content" class="form-control" name="content">
                                        @error('content')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Quay lại</button>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
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

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    @endsection
