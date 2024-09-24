<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>Quyền</th>
            <th style="width: 120px;">Đổi mật khẩu</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>Quyền</th>
            <th style="width: 120px;">Xóa tài khoản</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($auth as $item)
            <tr id="acc-{{ $item->maNguoiDung }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tenNguoiDung }}</td>
                <td>{{ $item->email }}</td>
                <td style="display: flex; justify-content: center;">
                    <a href="{{ URL::to('/admin/auth/change-password/' . $item->maNguoiDung) }}"
                        class="btn btn-sm btn-primary">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td style="text-align: center;">
                    <a href="#" class="btn btn-sm btn-primary information delete-button"
                        data-id="{{ $item->maNguoiDung }}" data-toggle="tooltip" title data-toggle="tooltip"
                        title="Xóa">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
