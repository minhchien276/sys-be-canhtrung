<?php

namespace App\Exports;

use App\Models\nguoidung;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClickLinkExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = Carbon::now()->subMonthNoOverflow()->startOfMonth()->addDays(20)->toDateString();
        $endDate = Carbon::now()->startOfMonth()->addDays(21)->toDateString();
        
        $click = DB::table('clicklink')
            ->join('link', 'clicklink.id_link', '=', 'link.maLink')
            ->select('link.tenLink as link', 'clicklink.thoiGian as ngay', DB::raw('COUNT(*) as total'))
            ->whereBetween('clicklink.thoiGian', [$startDate, $endDate])
            ->groupBy('clicklink.thoiGian', 'link.tenLink')
            ->orderBy('clicklink.thoiGian', 'asc')
            ->get();
    
        return $click;
    }
    
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'Ngày',
            'Link',
            'Số lượt nhấn mới'
        ];
    }
 
    public function map($record): array {
        return [
            $record->ngay,
            $record->link,
            $record->total,
        ];
    }
}
