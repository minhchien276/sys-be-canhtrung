@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Cập nhật thông tin tư vấn viên</h6>

                <div class="card-body">
                    <form action="{{ route('tvv.update', ['id' => $tvv->maTvv]) }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tenTvv">Tên tư vấn viên:</label>
                                        <input type="text" id="tenTvv" class="form-control" name="tenTvv"
                                            value="{{ old('tenTvv', $tvv->tenTvv) }}">
                                        @error('tenTvv')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="status">Trạng thái hoạt động:</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1"
                                                    {{ old('status', $tvv->status) == 1 ? 'selected' : '' }}>
                                                    Sẵn sàng hỗ trợ</option>
                                                <option value="0"
                                                    {{ old('status', $tvv->status) == 0 ? 'selected' : '' }}>
                                                    Không hoạt động</option>
                                            </select>
                                            @error('status')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="soDienThoai">Số điện thoại:</label>
                                            <input type="text" id="soDienThoai" class="form-control" name="soDienThoai"
                                                value="{{ old('soDienThoai', $tvv->soDienThoai) }}">
                                            @error('soDienThoai')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="kinhnghiem">Kinh nghiệm:</label>
                                            <input type="text" id="kinhnghiem" class="form-control" name="kinhnghiem"
                                                value="{{ old('kinhnghiem', $tvv->kinhnghiem) }}">
                                            @error('kinhnghiem')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group col-md-4">
                                            <label for="rating">Rating:</label>
                                            <input type="text" id="rating" class="form-control" name="rating"
                                                value="{{ old('rating', $tvv->rating) }}">
                                            @error('rating')
                                                <span style="color: red; width: 100%">{{ $message }}</span>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group col-md-6">
                                            <label for="id_loaitvv">Loại tư vấn viên:</label>
                                            <select id="id_loaitvv" class="form-control" name="id_loaitvv">
                                                @foreach ($listOfLoaitvv as $loaitvv)
                                                    <option value="{{ $loaitvv->id }}"
                                                        {{ $loaitvv->id === $tvv->id_loaitvv ? 'selected' : '' }}>
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
                                        <input type="text" id="linkAnh" class="form-control" name="linkAnh"
                                            value="{{ old('linkAnh', $tvv->linkAnh) }}">
                                        @error('linkAnh')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gioithieu">Giới thiệu:</label>
                                        <textarea id="gioithieu" class="form-control" name="gioithieu" cols="50" rows="4">{{ old('gioithieu', $tvv->gioithieu) }}</textarea>
                                        @error('gioithieu')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="linkZalo">Link zalo:</label>
                                        <input type="text" id="linkZalo" class="form-control" name="linkZalo"
                                            value="{{ old('linkZalo', $tvv->linkZalo) }}">
                                        @error('linkZalo')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="linkFb">Link facebook:</label>
                                        <input type="text" id="linkFb" class="form-control" name="linkFb"
                                            value="{{ old('linkFb', $tvv->linkFb) }}">
                                        @error('linkFb')
                                            <span style="color: red; width: 100%">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
