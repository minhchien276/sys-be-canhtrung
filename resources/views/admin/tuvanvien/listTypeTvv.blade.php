<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Loại tư vấn viên</th>
            <th style="width: 100px;">Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Loại tư vấn viên</th>
            <th style="width: 100px;">Xóa</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($loaitvv as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->type }}</td>
                <td style="display: flex; justify-content: center;">
                    <a href="#" class="btn btn-sm btn-primary information delete-button"
                        data-id="{{ $item->id }}" data-toggle="tooltip" title
                        data-toggle="tooltip" title="Xóa">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>