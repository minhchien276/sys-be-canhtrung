<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OvumB</title>
    <link REL="SHORTCUT ICON" HREF="{{ asset('assets/img/be.png') }}">


    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: #fa6c8b">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <img style="width: 100px" src="{{ asset('assets/img/BE_LOGO.png') }}" alt="">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sale
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tvv.index') }}">
                    <i class="fas fa-fw fa-stethoscope"></i>
                    <span>Quản lý tư vấn viên</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Kho
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-eaxpanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý hộp test</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('quan-ly-hop-test.show-hop-test-da-dung') }}">Que test
                            còn lại</a>
                        <a class="collapse-item" href="{{ route('quan-ly-hop-test.show-hop-test-moi') }}">Hộp test
                            mới</a>
                    </div>
                </div>
            </li>


            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="fas fa-fw fas fa-box"></i>
                    <span>Quản lý sản phẩm</span></a> --}}
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                GA & SEO
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('link.index') }}">
                    <i class="fas fa-fw fas fa-link"></i>
                    <span>Quản lý link</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('clicklink.index') }}">
                    <i class="fas fa-fw fa-hand-pointer"></i>
                    <span>Quản lý lượt nhấn link</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.index') }}">
                    <i class="fas fa-fw fas fa-book"></i>
                    <span>Quản lý bài viết</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('quangcao.index') }}">
                    <i class="fas fa-fw fa fa-bullhorn"></i>
                    <span>Quản lý quảng cáo</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('notification.index') }}">
                    <i class="fas fa-fw fa fa-bullhorn"></i>
                    <span>Quản lý thông báo</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('showQrSua') }}">
                    <i class="fas fa-fw fa-qrcode"></i>
                    <span>Quản lý QR sữa</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('tailieukichsua.index') }}">
                    <i class="fas fa-fw fas fa-book"></i>
                    <span>Quản lý tài liệu kích sữa</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('chart.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Quản lý người dùng</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('video.index') }}">
                    <i class='fas fa-video'></i>
                    <span>Quản lý video</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('test-result.index') }}">
                    <i class='fas fa-book'></i>
                    <span>Quản lý nội dung test</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('version.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <span>Quản lý version</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('danhgia.index') }}">
                    <i class="fas fa-fw fas fa-file"></i>
                    <span>Quản lý đánh giá</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.index') }}">
                    <i class="fas fa-fw fas fa-user"></i>
                    <span>Quản lý tài khoản</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        @php
                            $currentUserIsAdmin = session()->has('user') && session()->get('role') == 1;
                        @endphp

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets/img/be.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                @if ($currentUserIsAdmin)
                                    <a class="dropdown-item" href="{{ route('store.index') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        OvumB Store
                                    </a>
                                @endif
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; by team IT</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng xuất</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn "đăng xuất" không?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @yield('scripts')
    {{-- <!-- Bootstrap core JavaScript-->
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
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

</body>

</html>
