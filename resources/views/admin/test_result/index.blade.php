@extends('master')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary" style="flex: 1;">Danh sách kết quả</h6>

                @if (session('success'))
                    <p style="margin-right: 200px" class="alert alert-success">
                        {{ session('success') }}
                    </p>
                @endif

                <a href="{{ route('test-result.create') }}" class="btn btn-primary">Tạo mới</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="linkList">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    {{-- <th>backgroundColor</th> --}}
                                    {{-- <th>imageUrl</th> --}}
                                    <th>titleText</th>
                                    <th>subText</th>
                                    {{-- <th>textColor</th> --}}
                                    {{-- <th>progressColor</th> --}}
                                    {{-- <th>testEnum</th> --}}
                                    <th>phase</th>
                                    {{-- <th>type</th> --}}
                                    <th>isBefore</th>
                                    {{-- <th>notification</th> --}}
                                    {{-- <th>imageType</th> --}}
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    {{-- <th>backgroundColor</th> --}}
                                    {{-- <th>imageUrl</th> --}}
                                    <th>titleText</th>
                                    <th>subText</th>
                                    {{-- <th>textColor</th> --}}
                                    {{-- <th>progressColor</th> --}}
                                    {{-- <th>testEnum</th> --}}
                                    <th>phase</th>
                                    {{-- <th>type</th> --}}
                                    <th>isBefore</th>
                                    {{-- <th>notification</th> --}}
                                    {{-- <th>imageType</th> --}}
                                    <th>Edit</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($test_result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->backgroundColor }}</td> --}}
                                        {{-- <td>{{ $item->imageUrl }}</td> --}}
                                        <td>{{ $item->titleText }}</td>
                                        <td>{{ $item->subText }}</td>
                                        {{-- <td>{{ $item->textColor }}</td> --}}
                                        {{-- <td>{{ $item->progressColor }}</td> --}}
                                        {{-- <td>
                                            @if ($item->testEnum == 0)
                                                Thấp
                                            @elseif ($item->testEnum == 1)
                                                Cao
                                            @elseif ($item->testEnum == 2)
                                                Đạt đỉnh
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($item->phase == 1)
                                                Trứng
                                            @elseif ($item->phase == 2)
                                                An toàn
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if ($item->type == 1)
                                                Trứng
                                            @elseif ($item->type == 2)
                                                Thai
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($item->isBefore == 0)
                                                Trước đạt đỉnh
                                            @elseif ($item->isBefore == 1)
                                                Sau đạt đỉnh
                                            @endif
                                        </td>
                                        {{-- <td>{{ $item->notification }}</td> --}}
                                        {{-- <td>
                                            @if ($item->imageType == 0)
                                                Ảnh
                                            @elseif ($item->imageType == 1)
                                                Json
                                            @endif
                                        </td> --}}
                                        <td style="display: flex; justify-content: center;">
                                            <a href="{{ URL::to('/admin/test-result/edit/' . $item->id) }}"
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
