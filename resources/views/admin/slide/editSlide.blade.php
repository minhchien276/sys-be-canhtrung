@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật slide</h6>

                <div class="card-body">
                    <form action="{{ route('slide.update', ['id' => $slide->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề:</label>
                                <input type="text" id="title" class="form-control" name="title"
                                    value="{{ old('image', $slide->title) }}">
                                @error('title')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="text" id="image" class="form-control" name="image"
                                    value="{{ old('image', $slide->image) }}">
                                @error('image')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái:</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="0" {{ old('status', $slide->status) == 'Ẩn' ? 'selected' : '' }}>
                                        Ẩn</option>
                                    <option value="1"
                                        {{ old('status', $slide->status) == 'Hiển thị' ? 'selected' : '' }}>Hiển thị
                                    </option>
                                </select>
                                @error('status')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Quay lại</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
