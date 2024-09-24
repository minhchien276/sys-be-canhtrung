@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; justify-content: space-between; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>

                <form action="{{ route('chart.filter-phase') }}" method="post">
                    @csrf
                    <div style="display: flex; justify-content: center; margin-right: 10px;">
                        <input style="width: 150px; margin-right: 10px;" type="date" id="thoiGianTu" name="thoiGianTu"
                            class="form-control"
                            @if ($thoiGianTu) value="{{ old('thoiGianTu', $thoiGianTu) }}" @endif />
                        <input style="width: 150px; margin-right: 10px;" type="date" id="thoiGianDen" name="thoiGianDen"
                            class="form-control"
                            @if ($thoiGianDen) value="{{ old('thoiGianDen', $thoiGianDen) }}" @endif />

                        <select style="margin-right: 10px; width: 200px;" id="phase" name="phase"
                            class="form-control">
                            <option value="0" {{ old('phase', $phase) == '0' ? 'selected' : '' }}>Chọn phase</option>
                            <option value="2" {{ old('phase', $phase) == '2' ? 'selected' : '' }}>Tính Ngày An Toàn
                            </option>
                            <option value="1" {{ old('phase', $phase) == '1' ? 'selected' : '' }}>Hỗ Trợ Mang Thai
                            </option>
                            <option value="3" {{ old('phase', $phase) == '3' ? 'selected' : '' }}>Theo Dõi Thai Kỳ
                            </option>
                            <option value="4" {{ old('phase', $phase) == '4' ? 'selected' : '' }}>Theo Dõi Sữa Mẹ
                            </option>
                            <option value="5" {{ old('phase', $phase) == '5' ? 'selected' : '' }}>Quản Lý Chu Kỳ Kinh
                            </option>
                        </select>
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Kiểm tra</button>

                        <input type="text" style="width: 50px; margin-left: 10px; text-align: center;"
                            value="{{ $countUserPhase }}" disabled>
                    </div>
                </form>

                <form action="{{ route('chart.filter-age') }}" method="post">
                    @csrf
                    <div style="display: flex; justify-content: center; float: right;">
                        <input style="margin-right: 10px; width: 150px;" type="number" id="age" name="age"
                            class="form-control" value="{{ old('age') }}" placeholder="Nhập tuổi ..." />
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Lọc tuổi</button>

                        <input type="text" style="width: 50px; margin-left: 10px; text-align: center;"
                            value="{{ $countUserAge }}" disabled>
                    </div>
                </form>

                <form action="{{ route('export-users') }}" method="get">
                    <div style="display: flex; justify-content: center; float: right;">
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Excel</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <form action="{{ route('search-user') }}" method="get">
                    <div style="display: flex; justify-content: center; float: right; margin-bottom:10px" >
                        <input type="text" name="searchUser" class="form-control" style="width: 250px; margin-right: 10px;">
                        <button style="width: 150px;" id="checkButton" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Năm sinh</th>
                                <th>Ngày dự sinh</th>
                                <th>Biểu đồ LH</th>
                                <td style = "display:none"></td>
                                <th>Kích sữa</th>
                                <td style = "display:none"></td>
                                <th>Nhật ký</th>
                                <th>Thông tin con</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Năm sinh</th>
                                <th>Ngày dự sinh</th>
                                <th>Biểu đồ LH</th>
                                <td style = "display:none"></td>
                                <th>Kích sữa</th>
                                <td style = "display:none"></td>
                                <th>Nhật ký</th>
                                <th>Thông tin con</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->tenNguoiDung }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->taiKhoan }}</td>
                                    <td>{{ $item->namSinh }}</td>
                                    <td>{{ $item->ngayDuSinh }}</td>
                                    <td>
                                        <a href="{{ URL::to('/admin/chart/details-user/' . $item->maNguoiDung) }}"
                                            style="margin-left: 40px;
                                            @if(property_exists($item, 'ketQua') && $item->ketQua !== null)
                                                @if($item->ketQua == 0)
                                                    background-color: #e7c7ce;
                                                @elseif($item->ketQua == 1)
                                                    background-color: #fb7391;
                                                @elseif($item->ketQua == 2)
                                                    background-color: #f5083c;
                                                @else
                                                    background-color: #fb7391;
                                                @endif
                                            @else
                                                background-color: #fb7391;
                                            @endif
                                            " class="btn btn-sm btn-primary information"
                                            data-id="" data-toggle="tooltip" title="">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </td>
                                    <td style = "display:none">{{ $item->ketQua ?? null }}</td>
                                    <td>
                                        <a href="{{ URL::to('/admin/chart/breast-milk/' . $item->maNguoiDung) }}"
                                            style="margin-left: 30px;" class="btn btn-sm btn-primary information"
                                            data-id="" data-toggle="tooltip" title="">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td style = "display:none">{{ $item->timeKich ?? null }}</td>
                                    <td>
                                        <a href="{{ URL::to('/admin/chart/answers/' . $item->maNguoiDung) }}"
                                            style="margin-left: 30px;" class="btn btn-sm btn-primary information"
                                            data-id="" data-toggle="tooltip" title="">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('/admin/chart/show-con/' . $item->maNguoiDung) }}"
                                            style="margin-left: 30px;" class="btn btn-sm btn-primary information"
                                            data-id="" data-toggle="tooltip" title="">
                                            <i class="fas fa-baby"></i>
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
            // Kiểm tra xem DataTable đã được khởi tạo chưa
            if ($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable().destroy();
            }

            // Định nghĩa hàm sắp xếp tùy chỉnh
            $.fn.dataTable.ext.order['custom-result-order'] = function (settings, data, dataIndex) {
                var resultMap = { '2': 1, '1': 2, '0': 3, '': 4 };
                var value = data[6];
                return resultMap[value] || 6;
            };

            $.fn.dataTable.ext.order['custom-timeKich-order'] = function (settings, data, dataIndex) {
                var timeValue = data[8];
                return parseFloat(timeValue) || 0;
            };

            $('#dataTable').DataTable({
                "columnDefs": [
                    {
                        "targets": 5,
                        "orderData": 6,
                        "orderDataType": "custom-result-order"
                    },
                    {
                        "targets": 7,
                        "orderData": 8,
                        "orderDataType": "custom-timeKich-order",

                    }
                ],
                "order": []
            });
        });
    </script>
@endsection
