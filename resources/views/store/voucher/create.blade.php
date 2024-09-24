@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Tạo mã giảm giá</h6>

                <div class="card-body">
                    <form action="{{ route('store.vouchers.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="discount">Discount:</label>
                                <input type="text" id="discount" class="form-control" name="discount">
                                @error('discount')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="minPrice">Min price:</label>
                                <input type="text" id="minPrice" class="form-control" name="minPrice">
                                @error('minPrice')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="maxPrice">Max price:</label>
                                <input type="text" id="maxPrice" class="form-control" name="maxPrice">
                                @error('maxPrice')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select id="status" class="form-control" name="status">
                                        <option value="1">Unactive</option>
                                        <option value="0">Active</option>
                                </select>
                                @error('status')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idTypeVoucher">Type voucher:</label>    
                                <select id="idTypeVoucher" class="form-control" name="idTypeVoucher">
                                        <option value="1">Ship</option>
                                        <option value="2">Sale</option>
                                        <option value="3">Game</option>
                                </select>
                                @error('idTypeVoucher')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expired">Expired:</label>
                                <input type="date" id="expired" class="form-control" name="expired">
                                @error('expired')
                                    <span style="color: red; width: 100%">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Quay lại</button>
                            <button type="submit" class="btn btn-primary">Tạo mới</button>
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
