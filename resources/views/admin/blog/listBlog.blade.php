<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Link</th>
            <th>Thời gian</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Link</th>
            <th>Thời gian</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($blogs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img style="width: 200px;" src="{{ $item->image }}"></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>{{ $item->link }}</td>
                <td>{{ $item->date }}</td>
                <td>
                    <a href="" class="btn btn-sm btn-primary information" data-id=""
                        data-toggle="tooltip" title="Sửa">
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