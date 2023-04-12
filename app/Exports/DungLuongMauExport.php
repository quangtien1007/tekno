<?php

namespace App\Exports;

use App\Models\DungLuong_Mau;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DungLuongMauExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'sanpham_id',
            'dungluong_id',
            'mau_id',
            'soluongton',
        ];
    }

    public function map($row): array
    {
        return [
            $row->sanpham_id,
            $row->dungluong_id,
            $row->mau_id,
            $row->soluongton,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DungLuong_Mau::all();
    }
}
