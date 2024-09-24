@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Quản lý lượt nhấn link</h6>
                <form action="{{ route('check.clicks-month') }}" method="post">
                    @csrf
                    <div style="display: flex; justify-content: center; margin-right: 50px;">
                        <input style="margin-right: 10px;" type="date" id="thoiGianTu" name="thoiGianTu"
                            class="form-control"
                            @if ($thoiGianTu) value="{{ old('thoiGianTu', $thoiGianTu) }}" @endif />
                        <input style="margin-right: 10px;" type="date" id="thoiGianDen" name="thoiGianDen"
                            class="form-control"
                            @if ($thoiGianDen) value="{{ old('thoiGianDen', $thoiGianDen) }}" @endif />
                        <button style="width: 200px;" id="checkButton" class="btn btn-primary">Kiểm tra</button>
                    </div>
                </form>

                <form action="{{ route('check.clicks') }}" method="post">
                    @csrf
                    <div style="display: flex; justify-content: center">
                        <input style="margin-right: 10px;" type="date" id="thoiGian" name="thoiGian"
                            class="form-control"
                            @if ($thoiGian) value="{{ old('thoiGian', $thoiGian) }}" @endif />
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Theo ngày</button>
                    </div>
                </form>

                <form action="{{ route('export-click-link') }}" method="get">
                    <div style="display: flex; justify-content: center; float: right; margin-left: 10px;">
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Excel</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Đường link</th>
                                    <th>Lượt nhấn</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Đường link</th>
                                    <th>Lượt nhấn</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($click as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><u><a href="{{ $item->tenLink }}" target="_blank">{{ $item->title }}</a></u></td>
                                        <td>{{ $item->count_records }}</td>
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

    <script>
        $(document).ready(function() {
            $('#checkButton').click(function() {
                var selectedDate = $('#dateInput').val();

            });
        });
    </script>
@endsection
