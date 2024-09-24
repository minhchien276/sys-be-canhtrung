@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Thêm mới tư vấn viên</h6>

                <div class="card-body">
                    <form action="{{ route('tvv.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tenTvv">Tên tư vấn viên:</label>
                                        <input type="text" id="tenTvv" class="form-control" name="tenTvv">
                                        @error('tenTvv')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="status">Trạng thái hoạt động:</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1">
                                                    Sẵn sàng hỗ trợ</option>
                                                <option value="0">
                                                    Không hoạt động</option>
                                            </select>
                                            @error('status')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="soDienThoai">Số điện thoại:</label>
                                            <input type="text" id="soDienThoai" class="form-control" name="soDienThoai">
                                            @error('soDienThoai')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="kinhnghiem">Kinh nghiệm:</label>
                                            <input type="text" id="kinhnghiem" class="form-control" name="kinhnghiem">
                                            @error('kinhnghiem')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group col-md-4">
                                            <label for="rating">Rating:</label>
                                            <input type="text" id="rating" class="form-control" name="rating">
                                            @error('rating')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group col-md-6">
                                            <label for="id_loaitvv">Loại tư vấn viên:</label>
                                            <select id="id_loaitvv" class="form-control" name="id_loaitvv">
                                                @foreach ($listOfLoaitvv as $loaitvv)
                                                    <option value="{{ $loaitvv->id }}">
                                                        {{ $loaitvv->type }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('id_loaitvv')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="linkAnh">Link ảnh:</label>
                                        <input type="text" id="linkAnh" class="form-control" name="linkAnh">
                                        @error('linkAnh')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gioithieu">Giới thiệu:</label>
                                        <textarea id="gioithieu" class="form-control" name="gioithieu" cols="50" rows="4"></textarea>
                                        @error('gioithieu')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="linkZalo">Link zalo:</label>
                                        <input type="text" id="linkZalo" class="form-control" name="linkZalo">
                                        @error('linkZalo')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="linkFb">Link facebook:</label>
                                        <input type="text" id="linkFb" class="form-control" name="linkFb">
                                        @error('linkFb')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" id="email" class="form-control" name="email">
                                        @error('email')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Quay lại</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
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
