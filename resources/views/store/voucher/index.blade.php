@extends('master_store')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách mã giảm giá</h6>

                <a href="{{ route('store.vouchers.create') }}" class="btn btn-primary">Tạo mới mã giảm giá</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Discount</th>
                                    <th>Min price</th>
                                    <th>Max price</th>
                                    <th>Status</th>
                                    <th>Type voucher</th>
                                    <th>Expired</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Discount</th>
                                    <th>Min price</th>
                                    <th>Max price</th>
                                    <th>Status</th>
                                    <th>Type voucher</th>
                                    <th>Expired</th>
                                    <th>Update</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($vouchers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->minPrice }}</td>
                                        <td>{{ $item->maxPrice }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <div class="alert alert-secondary">
                                                    Unactive
                                                </div>
                                            @else
                                                <div class="alert alert-primary">
                                                    Active
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->idTypeVoucher == 1)
                                                <div class="alert alert-secondary">
                                                    Ship
                                                </div>
                                            @elseif ($item->idTypeVoucher == 2)
                                                <div class="alert alert-primary">
                                                    Sale
                                                </div>
                                            @else
                                                <div class="alert alert-danger">
                                                    Game
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $item->expired }}</td>
                                        <td>
                                            <a href="{{ URL::to('/store/vouchers/edit/' . $item->id) }}"
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
@endsection
