@extends('master')

@section('css')
    <style>
        .table-responsive {
            max-height: 400px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Số lượng người dùng: {{ $count }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Số lượng hộp test : {{ $countHopTest }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800">Đã dùng:
                                    {{ $countHopTestDaDung }} | Còn lại: {{ $conLai }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Số người có ngày dự
                                    sinh: {{ $countNgayDuSinh }}
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div style="font-size: 13px;" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-baby fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Số lượng loại bài viết: {{ $countTypeBlog }}</div>
                                <div style="font-size: 13px;" class="h5 mb-0 font-weight-bold text-gray-800">Số lượng bài
                                    viết: {{ $countBlog }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-blog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($DatDinhDetails->count() > 0)
                            <div class="col-xl-12 col-md-6 mb-1 carddatdinh"
                                data-detail="{{ json_encode($DatDinhDetails[0]) }}">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"
                                                    style="color: #A11043">
                                                    Đạt đỉnh</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $countDatDinhDetails }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-egg fa-2x" style="color: #A11043"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($CaoDetails->count() > 0)
                            <div class="col-xl-12 col-md-6 mb-1 cardcao" data-detail="{{ json_encode($CaoDetails[0]) }}">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"
                                                    style="color: #F63D68">
                                                    Cao</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countCaoDetails }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-egg fa-2x" style="color: #F63D68"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($ThapDetails->count() > 0)
                            <div class="col-xl-12 col-md-6 mb-1 cardthap" data-detail="{{ json_encode($ThapDetails[0]) }}">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1"
                                                    style="color: #FECDD6">
                                                    Thấp</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countThapDetails }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-egg fa-2x" style="color: #FECDD6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tỉ lệ đạt đỉnh</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart" width="100" height="50"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #A11043"></i> Đạt đỉnh
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #F63D68"></i> Cao
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #FECDD6"></i> Thấp
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
        var labels = @json($labels);
        var counts = @json($counts);

        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: ['#A11043', '#F63D68', '#FECDD6'],
                    hoverBackgroundColor: ['#A11043', '#F63D68', '#FECDD6'],
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
