@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật sản phẩm</h6>

                <div class="card-body">
                    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm:</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    value="{{ old('image', $product->name) }}">
                                @error('name')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Link ảnh:</label>
                                <input type="text" id="image" class="form-control" name="image" value="{{ old('image', $product->image) }}">
                                @error('image')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="loaisanpham_id">Loại sản phẩm:</label>
                                <select id="loaisanpham_id" class="form-control" name="loaisanpham_id">
                                    <option value="4" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '4') ? 'selected' : '' }}>Hỗ Trợ Sinh Sản</option>
                                    <option value="7" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '7') ? 'selected' : '' }}>Chăm Sóc Da & Làm Đẹp</option>
                                    <option value="10" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '10') ? 'selected' : '' }}>Chăm Sóc Mẹ & Bé</option>
                                    <option value="13" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '13') ? 'selected' : '' }}>Dành Cho Tuổi Dậy Thì</option>
                                    <option value="15" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '15') ? 'selected' : '' }}>Que thử OvumB</option>
                                    <option value="18" {{ (old('loaisanpham_id', $product->loaisanpham_id) == '18') ? 'selected' : '' }}>Que thử an toàn OvumB</option>
                                </select>
                                @error('loaisanpham_id')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keyword">Từ khóa tìm kiếm:</label>
                                <input type="text" id="keyword" class="form-control" name="keyword"
                                    value="{{ old('keyword', $product->keyword) }}">
                                @error('keyword')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sold">Đã bán:</label>
                                <input type="text" id="sold" class="form-control" name="sold"
                                    value="{{ old('sold', $product->sold) }}">
                                @error('sold')
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
