@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật chi tiết sản phẩm</h6>

                <div class="card-body">
                    <form action="{{ route('product.create-product-details', ['id' => $productDetails->product_id]) }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="text" id="image" class="form-control" name="image" value="{{ old('image', $productDetails->image) }}">
                                @error('image')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá:</label>
                                <input type="text" id="price" class="form-control" name="price"
                                    value="{{ old('price', $productDetails->price) }}">
                                @error('price')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sale">Giá giảm:</label>
                                <input type="text" id="sale" class="form-control" name="sale"
                                    value="{{ old('sale', $productDetails->sale) }}">
                                @error('sale')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả:</label>
                                <textarea name="description" id="description" cols="100" rows="3" class="form-control">{{ old('description', $productDetails->description) }}</textarea>
                                @error('description')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">Thành phần:</label>
                                <textarea name="content" id="content" cols="100" rows="3" class="form-control">{{ old('content', $productDetails->content) }}</textarea>
                                @error('content')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="guide">Hướng dẫn sử dụng:</label>
                                <textarea name="guide" id="guide" cols="100" rows="3" class="form-control">{{ old('guide', $productDetails->guide) }}</textarea>
                                @error('guide')
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
