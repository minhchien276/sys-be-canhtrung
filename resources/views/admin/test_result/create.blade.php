@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Tạo mới kết quả test</h6>

                <div class="card-body">
                    <form action="{{ route('test-result.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="backgroundColor">backgroundColor:</label>
                                        <input type="text" id="backgroundColor" class="form-control"
                                            name="backgroundColor">
                                        @error('backgroundColor')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="imageUrl">imageUrl:</label>
                                        <input type="text" id="imageUrl" class="form-control" name="imageUrl">
                                        @error('imageUrl')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="titleText">titleText:</label>
                                        <input type="text" id="titleText" class="form-control" name="titleText">
                                        @error('titleText')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subText">subText:</label>
                                        <input type="text" id="subText" class="form-control" name="subText">
                                        @error('subText')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="textColor">textColor:</label>
                                        <input type="text" id="textColor" class="form-control" name="textColor">
                                        @error('textColor')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="progressColor">progressColor:</label>
                                        <input type="text" id="progressColor" class="form-control" name="progressColor">
                                        @error('progressColor')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="titleNotification">titleNotification:</label>
                                        <input type="text" id="titleNotification" class="form-control" name="titleNotification">
                                        @error('titleNotification')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="testEnum">testEnum:</label>
                                        <select id="testEnum" class="form-control" name="testEnum">
                                            <option value="0">Thấp</option>
                                            <option value="1">Cao</option>
                                            <option value="2">Đạt đỉnh</option>
                                        </select>
                                        @error('testEnum')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phase">phase:</label>
                                        <select id="phase" class="form-control" name="phase">
                                            <option value="1">Trứng</option>
                                            <option value="2">An toàn</option>
                                        </select>
                                        @error('phase')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type">type:</label>
                                        <select id="type" class="form-control" name="type">
                                            <option value="1">Trứng</option>
                                            <option value="2">Thai</option>
                                        </select>
                                        @error('type')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="isBefore">isBefore:</label>
                                        <select id="isBefore" class="form-control" name="isBefore">
                                            <option value="0">Trước đạt đỉnh</option>
                                            <option value="1">Sau đạt đỉnh</option>
                                        </select>
                                        @error('isBefore')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notification">notification:</label>
                                        <textarea name="notification" id="notification" cols="30" rows="3" class="form-control"></textarea>
                                        @error('notification')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="imageType">imageType:</label>
                                        <select id="imageType" class="form-control" name="imageType">
                                            <option value="0">Ảnh</option>
                                            <option value="1">Json</option>
                                        </select>
                                        @error('imageType')
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
