<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã link</th>
            <th>Đường link</th>
            <th>Sửa link</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Mã link</th>
            <th>Đường link</th>
            <th>Sửa link</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($link as $item)
            <tr>
                <td>{{ $item->maLink }}</td>
                <td>{{ $item->tenLink }}</td>
                <td>
                    <a href="" style="margin-left: 30px;"
                        class="btn btn-sm btn-primary information" data-id="" data-toggle="tooltip"
                        title="">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>