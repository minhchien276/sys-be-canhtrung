<?php

namespace App\Exports;

use App\Models\nguoidung;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $startDate = (Carbon::now()->subMonthNoOverflow()->startOfMonth()->addDays(20)->startOfDay()->timestamp) * 1000;
        $endDate = (Carbon::now()->startOfMonth()->addDays(21)->endOfDay()->timestamp) * 1000;

        $recordCountByDate = nguoidung::where('maPhanQuyen', 4)
            ->whereBetween(DB::raw('DATE(FROM_UNIXTIME(ngayTao / 1000))'), [date('Y-m-d', $startDate / 1000), date('Y-m-d', $endDate / 1000)])
            ->select(DB::raw('DATE(FROM_UNIXTIME(ngayTao / 1000)) as ngay'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('DATE(FROM_UNIXTIME(ngayTao / 1000))'))
            ->orderBy(DB::raw('DATE(FROM_UNIXTIME(ngayTao / 1000))'), 'asc')
            ->get();

        return $recordCountByDate;
    }

    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array
    {
        return [
            'Ngày',
            'Số lượng bản ghi mới'
        ];
    }

    public function map($record): array
    {
        return [
            $record->ngay,
            $record->total,
        ];
    }
}
