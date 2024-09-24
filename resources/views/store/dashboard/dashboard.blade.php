@extends('master_store')

@section('css')
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng vouchers: {{ $countVouchers }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng sản phẩm: {{ $countProducts }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng đơn hàng: {{ $countOrders }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-first-order fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng slides: {{ $countSlides }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sliders-h fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng đơn hàng chưa xử lý: {{ $dangXuLy }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng đơn hàng đã xác nhận: {{ $daXacNhan }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng đơn hàng đang vận chuyển: {{ $dangVanChuyen }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-first-order fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng số lượng đơn hàng đã giao: {{ $daGiaoHang }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sliders-h fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Pie Chart đơn hàng theo ngày-->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng trong ngày</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="PieChart_orders_date" width="100" height="50"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED77A1"></i> Đang xử lý
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED9A77"></i> Đã xác nhận
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #6DA2F1"></i> Đang vận chuyển
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #62CF9B"></i> Đã giao hàng
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED7777"></i> Đã hủy
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart đơn hàng theo tháng-->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng trong tháng</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="PieChart_orders_month" width="100" height="50"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED77A1"></i> Đang xử lý
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED9A77"></i> Đã xác nhận
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #6DA2F1"></i> Đang vận chuyển
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #62CF9B"></i> Đã giao hàng
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED7777"></i> Đã hủy
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart đơn hàng theo tháng-->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng trong năm</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="PieChart_orders_year" width="100" height="50"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED77A1"></i> Đang xử lý
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED9A77"></i> Đã xác nhận
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #6DA2F1"></i> Đang vận chuyển
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #62CF9B"></i> Đã giao hàng
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #ED7777"></i> Đã hủy
                            </span>
                        </div>
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
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

    <script>
        var labels_day = @json($labels_day);
        var counts_day = @json($counts_day);

        var ctx = document.getElementById("PieChart_orders_date");
        var PieChart_orders_date = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels_day: labels_day,
                datasets: [{
                    data: counts_day,
                    backgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBackgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 80,
            },
        });
    </script>

    <script>
        var labels_month = @json($labels_month);
        var counts_month = @json($counts_month);

        var ctx = document.getElementById("PieChart_orders_month");
        var PieChart_orders_month = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels_month: labels_month,
                datasets: [{
                    data: counts_month,
                    backgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBackgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 80,
            },
        });
    </script>

    <script>
        var labels_year = @json($labels_year);
        var counts_year = @json($counts_year);

        var ctx = document.getElementById("PieChart_orders_year");
        var PieChart_orders_year = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels_year: labels_year,
                datasets: [{
                    data: counts_year,
                    backgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBackgroundColor: ['#ED77A1', '#ED9A77', '#6DA2F1', '#62CF9B', '#ED7777'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endsection
