<?php

namespace App\Imports;

use App\Models\DungLuongSanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DungLuongSanPhamImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DungLuongSanPham([
            'sanpham_id' => $row['sanpham_id'],
            'dungluong' => $row['dungluong'],
            'soluongton' => $row['soluongton'],
            'giatridungluong' => $row['giatridungluong']
        ]);
    }
}
