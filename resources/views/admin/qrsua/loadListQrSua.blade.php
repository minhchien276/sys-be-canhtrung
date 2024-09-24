<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã QR</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Mã QR</th>
        </tr>
    </tfoot>
    <tbody>
        @php
            use App\Helpers\QrCodeHelper;
        @endphp

        @foreach ($qrsua as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ QrCodeHelper::maskQrCode($item->maQr) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
