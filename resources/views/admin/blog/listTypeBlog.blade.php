<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Id</th>
            <th>Loại bài viết</th>
            <th>Tên loại bài viết</th>
            <th>Trạng thái</th>
            <th>Dạng</th>
            <th style="width: 100px;">Chi tiết</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Id</th>
            <th>Loại bài viết</th>
            <th>Tên loại bài viết</th>
            <th>Trạng thái</th>
            <th>Dạng</th>
            <th style="width: 100px;">Chi tiết</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($blogs as $item)
            <tr id="blog-{{ $item->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    @if ($item->status == 1)
                        Hiện
                    @else
                        Ẩn
                    @endif
                </td>
                <td>
                    @if ($item->isHorizontal == 1)
                        Ngang
                    @else
                        Dọc
                    @endif
                </td>
                <td>
                    <a href="{{ URL::to('/admin/blog/find-by-type/' . $item->id) }}"
                        class="btn btn-sm btn-primary information" data-id="" data-toggle="tooltip" title="Chi tiết">
                        <i class="far fa-eye"></i>
                    </a>

                    <a href="#" class="btn btn-sm btn-primary information edit-button"
                        data-id="{{ $item->id }}" data-type_blog="{{ $item->type }}"
                        data-name="{{ $item->name }}" data-status="{{ $item->status }}"
                        data-isHorizontal="{{ $item->isHorizontal }}"
                        data-url="{{ URL::to('/admin/type-blog/update/' . $item->id) }}" data-toggle="modal"
                        data-target="#editModal">
                        <i class="far fa-edit"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <!-- Modal content -->
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Sửa bài viết</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="editForm" action="" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="blog_id" id="blog_id">
                                        <div class="form-group">
                                            <label for="type_blog">Thể loại:</label>
                                            <input type="text" id="type_blog" class="form-control" name="type_blog"
                                                value="{{ $item->type }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên thể loại bài
                                                viết:</label>
                                            <select name="name" id="name" class="form-control">
                                                <option value="biquyet"
                                                    {{ old('name', $item->name) == 'biquyet' ? 'selected' : '' }}>
                                                    biquyet</option>
                                                <option value="quanhe"
                                                    {{ old('name', $item->name) == 'quanhe' ? 'selected' : '' }}>
                                                    quanhe</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Trạng thái:</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1"
                                                    {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                                    Hiện</option>
                                                <option value="0"
                                                    {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                                    Ẩn</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="isHorizontal">Dạng:</label>
                                            <select name="isHorizontal" id="isHorizontal" class="form-control">
                                                <option value="1"
                                                    {{ old('isHorizontal', $item->isHorizontal) == 1 ? 'selected' : '' }}>
                                                    Ngang</option>
                                                <option value="0"
                                                    {{ old('isHorizontal', $item->isHorizontal) == 0 ? 'selected' : '' }}>
                                                    Dọc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Đóng</button>
                                        <button class="btn btn-primary saveEditButton">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-sm btn-primary information delete-button"
                        data-id="{{ $item->id }}" data-toggle="tooltip" title data-toggle="tooltip" title="Xóa">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Loại bài viết</th>
            <th style="width: 100px;">Chi tiết</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Loại bài viết</th>
            <th style="width: 100px;">Chi tiết</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($blogs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->type }}</td>
                <td>
                    <a href="{{ URL::to('/admin/blog/find-by-type/' . $item->type_blog_id) }}"
                        class="btn btn-sm btn-primary information" data-id="" data-toggle="tooltip" title="">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-sm btn-primary information" data-id=""
                        data-toggle="tooltip" title="Xóa">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
