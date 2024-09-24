@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật quảng cáo</h6>

                <div class="card-body">
                    <form action="{{ route('quangcao.update', ['id' => $quangcao->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="text" id="image" class="form-control" name="image"
                                    value="{{ old('image', $quangcao->image) }}">
                                @error('image')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phase">Phase:</label>
                                <select id="phase" class="form-control" name="phase" disabled>
                                    <option value="1" {{ old('phase', $quangcao->phase) == 1 ? 'selected' : '' }}>
                                        Quản lí kỳ kinh</option>
                                    <option value="0" {{ old('phase', $quangcao->phase) == 2 ? 'selected' : '' }}>
                                        Hỗ trợ mang thai</option>
                                    <option value="2" {{ old('phase', $quangcao->phase) == 3 ? 'selected' : '' }}>
                                        Theo dõi thai kì</option>
                                    <option value="3" {{ old('phase', $quangcao->phase) == 4 ? 'selected' : '' }}>
                                        Chăm số mẹ bé</option>
                                </select>
                                @error('phase')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Loại:</label>
                                <select id="type" class="form-control" name="type" disabled>
                                    <option value="1" {{ old('type', $quangcao->type) == 1 ? 'selected' : '' }}>
                                        Quảng cáo ngày kinh</option>
                                    <option value="0" {{ old('type', $quangcao->type) == 0 ? 'selected' : '' }}>
                                        Quảng cáo tổng</option>
                                    <option value="2" {{ old('type', $quangcao->type) == 2 ? 'selected' : '' }}>
                                        Quảng cáo ngày an toàn</option>
                                    <option value="3" {{ old('type', $quangcao->type) == 3 ? 'selected' : '' }}>
                                        Quảng cáo ngày rụng trứng</option>
                                </select>
                                @error('type')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái:</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="1" {{ old('status', $quangcao->status) == 1 ? 'selected' : '' }}>
                                        Hiện</option>
                                    <option value="0" {{ old('status', $quangcao->status) == 0 ? 'selected' : '' }}>
                                        Ẩn</option>
                                </select>
                                @error('status')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link:</label>
                                <input type="text" id="link" class="form-control" name="link"
                                    value="{{ old('link', $quangcao->link) }}">
                                @error('link')
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
