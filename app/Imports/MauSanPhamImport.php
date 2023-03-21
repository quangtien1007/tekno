<?php

namespace App\Imports;

use App\Models\MauSanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MauSanPhamImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MauSanPham([
            'sanpham_id' => $row['sanpham_id'],
            'mau' => $row['mau'],
            'soluongton' => $row['soluongton'],
            'giatrimau' => $row['giatrimau']
        ]);
    }
}
