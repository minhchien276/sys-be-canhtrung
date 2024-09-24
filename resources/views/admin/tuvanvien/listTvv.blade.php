@extends('master')

@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        @keyframes slideFromRight {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .custom-alert {
            position: fixed;
            top: 800px;
            /* Điều chỉnh vị trí theo mong muốn */
            right: 20px;
            /* Điều chỉnh vị trí theo mong muốn */
            color: aliceblue;
            background-color: #fb7391;
            border: 1px solid #fb7391;
            padding: 10px;
            font-size: 20px;
            animation: slideFromRight 0.5s ease-in-out;
            /* Áp dụng animation */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách tư vấn viên</h6>

                @if ($thongbao)
                    <div class="custom-alert" id="alertBox">
                        {{ $thongbao }}
                    </div>

                    <script>
                        setTimeout(function() {
                            var alertBox = document.getElementById('alertBox');
                            if (alertBox) {
                                alertBox.style.display = 'none';
                            }
                        }, 3000);
                    </script>
                @endif

                <form action="{{ route('find-user') }}" method="post">
                    @csrf
                    <div style="display: flex; justify-content: center">
                        <input style="margin-right: 10px;" type="number" id="phone_number" name="phone_number"
                            class="form-control" placeholder="Nhập số điện thoại khách hàng ..." />
                        <button style="width: 250px; margin-right: 100px;" id="checkButton" class="btn btn-primary">Tìm
                            khách hàng</button>
                    </div>
                </form>

                @php
                    $currentUserIsAdmin = session()->has('user') && session()->get('role') == 1;
                @endphp
                @if ($currentUserIsAdmin)
                    <a href="{{ route('tvv.create') }}" class="btn btn-primary">Thêm mới tư vấn viên</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="accList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên tư vấn viên</th>
                                    <th>Trạng thái hoạt động</th>
                                    <th style="width: 100px;">Khách hàng</th>
                                    <th style="width: 100px;">Sửa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tên tư vấn viên</th>
                                    <th>Trạng thái hoạt động</th>
                                    <th style="width: 100px;">Khách hàng</th>
                                    <th style="width: 100px;">Sửa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tvv as $item)
                                    @php
                                        $currentUserIsAdmin = session()->has('user') && session()->get('role') == 1;
                                        $currentUserIsTuvanvien = session()->has('user');
                                    @endphp

                                    @if ($currentUserIsAdmin || ($currentUserIsTuvanvien && $item->maTvv == session()->get('maNguoiDung')))
                                        <tr>
                                            <td>{{ $item->tenTvv }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    Sẵn sàng hỗ trợ
                                                @elseif ($item->status == 0)
                                                    Không hoạt động
                                                @endif
                                            </td>
                                            <td>
                                                <a style=" margin-left: 45px;"
                                                    href="{{ URL::to('/admin/tuvanvien/tvv-nguoidung/' . $item->maTvv) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="far fa-user"></i>
                                                </a>
                                            </td>
                                            <td style="display: flex; justify-content: center;">
                                                <a href="{{ URL::to('/admin/tuvanvien/edit/' . $item->maTvv) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if ($user)
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="display: flex; align-items: center;">
                    <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Thông tin khách hàng</h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                @php
                                    $currentUserIsTuvanvien = session()->has('user') && session()->get('role') == 2;
                                @endphp
                                <tr>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Năm sinh</th>
                                    <th>Chiều cao</th>
                                    <th>Cân nặng</th>
                                    <th>Ngày dự sinh</th>
                                    <th>Biểu đồ LH</th>
                                    <th>Nhật ký</th>

                                    @if ($currentUserIsTuvanvien)
                                        <th>Add</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Năm sinh</th>
                                    <th>Chiều cao</th>
                                    <th>Cân nặng</th>
                                    <th>Ngày dự sinh</th>
                                    <th>Biểu đồ LH</th>
                                    <th>Nhật ký</th>

                                    @if ($currentUserIsTuvanvien)
                                        <th>Add</th>
                                    @endif
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->tenNguoiDung }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->taiKhoan }}</td>
                                        <td>{{ $item->namSinh }}</td>
                                        <td>{{ $item->chieuCao }}</td>
                                        <td>{{ $item->canNang }}</td>
                                        <td>{{ $item->ngayDuSinh }}</td>
                                        <td>
                                            <a href="{{ URL::to('/admin/chart/details-user/' . $item->maNguoiDung) }}"
                                                style="margin-left: 40px;" class="btn btn-sm btn-primary information"
                                                data-id="" data-toggle="tooltip" title="">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/admin/chart/answers/' . $item->maNguoiDung) }}"
                                                style="margin-left: 30px;" class="btn btn-sm btn-primary information"
                                                data-id="" data-toggle="tooltip" title="">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>

                                        @php
                                            $currentUserIsTuvanvien = session()->has('user') && session()->get('role') == 2;
                                        @endphp
                                        @if ($currentUserIsTuvanvien)
                                            <td>
                                                <a href="{{ URL::to('/admin/tuvanvien/add-user/' . $item->maNguoiDung) }}"
                                                    style="margin-left: 15px;" class="btn btn-sm btn-primary information"
                                                    data-id="" data-toggle="tooltip" title="">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endif
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
