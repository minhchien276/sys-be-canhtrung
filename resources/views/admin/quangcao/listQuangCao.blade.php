<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Phase</th>
            <th>Loại</th>
            <th>Trạng thái</th>
            <th>Link</th>
            <th style="width: 40px;">Sửa</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Phase</th>
            <th>Loại</th>
            <th>Trạng thái</th>
            <th>Link</th>
            <th style="width: 40px;">Sửa</th>

        </tr>
    </tfoot>
    <tbody>
        @foreach ($quangcao as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->image }}</td>
                <td>{{ $item->phase }}</td>
                <td>{{ $item->type }}</td>
                <td>
                    @if ($item->status == 1)
                        Hiện
                    @else
                        Ẩn
                    @endif
                </td>
                <td>{{ $item->link }}</td>
                <td>
                    <a href="{{ URL::to('/admin/quangcao/edit/' . $item->id) }}" class="btn btn-sm btn-primary">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
