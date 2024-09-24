@extends('master')

@section('css')
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 400px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="display: flex; align-items: center;">
                    <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Biểu đồ nồng độ LH</h6>
                </div>
                <div class="card-body" style="display: flex;">
                    <div class="chart-area col-xl-8">
                        <canvas id="myAreaChartUser"></canvas>
                    </div>
                    <div style="margin: auto;" class="col-xl-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kích sữa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Lần Kích</th>
                                    <th>Vú trái</th>
                                    <th>Vú phải</th>
                                    <th>Tổng</th>
                                    <th>Trung bình</th>
                                    <th>Ngày test</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $item->vuTrai}}</td>
                                        <td>{{ $item->vuPhai }}</td>
                                        <td>{{ $item->vuTrai + $item->vuPhai }}</td>
                                        <td>{{ ($item->vuTrai + $item->vuPhai)/2 }}</td>
                                        <td>{{ $item->thoiGian }}</td>
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
        <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>


        <!-- Thẻ canvas để vẽ biểu đồ -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Lấy dữ liệu từ biến PHP và chuyển đổi sang mảng JavaScript
            var data = @json($data);

            // Tạo mảng chứa dữ liệu cho trục hoành (LanTest) và trục tung (ketQua)
            var labels = [];
            var values = [];
            var timeData = [];

            // Duyệt qua mảng data để lấy dữ liệu cho biểu đồ
            data.forEach(function(item) {
                labels.push(labels.length + 1);
                values.push(item.vuTrai+item.vuPhai);
                var timestamp = item.thoiGian;
                var date = new Date(timestamp);
                var formattedDate = formatDate(date); // Chuyển đổi thành dạng chuẩn
                timeData.push(formattedDate);
            });

            // Hàm chuyển đổi dạng ngày/tháng/năm giờ:phút:giây
            function formatDate(date) {
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                return day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds;
            }

            // Tạo biểu đồ Area Chart
            var ctx = document.getElementById("myAreaChartUser").getContext('2d');
            var myAreaChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tổng kích',
                        data: values,
                        backgroundColor: 'rgba(250, 108, 139, 0.5)',
                        borderColor: '#000',
                        borderWidth: 2,
                        pointRadius: 0,
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: 'rgba(78, 115, 223, 1)',
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        lineTension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 0,
                            max: 1000,
                            ticks: {
                                stepSize: 20,
                                callback: function(value, index, values) {
                                    return value.toString();
                                },
                                color: '#fa6c8b'
                            },
                            title: {
                                display: true,
                                text: 'Tổng kích',
                                color: '#fa6c8b'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#fa6c8b'
                            },
                            title: {
                                display: true,
                                text: 'Số lần test',
                                color: '#fa6c8b'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var index = context.dataIndex;
                                    var result = values[index];
                                    var time = timeData[index];
                                    return 'Kết quả: ' + result + ' - Thời gian: ' + time;
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var images = document.querySelectorAll("[id^='zoomable-img-']");
                images.forEach(function(img) {
                    var id = img.id.split('-')[2]; // Lấy id từ id của ảnh
                    var modal = document.getElementById("image-modal-" + id);
                    var modalImg = document.getElementById("img-zoom-" + id);
                    var span = modal.querySelector(".close");

                    img.onclick = function() {
                        modal.style.display = "block";
                        modalImg.src = this.src;
                    }

                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                });
            });
        </script>
    @endsection
