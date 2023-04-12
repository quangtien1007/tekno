<?php

namespace App\Imports;

use App\Models\DungLuong_Mau;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DungLuongMauImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DungLuong_Mau([
            'sanpham_id' => $row['sanpham_id'],
            'dungluong_id' => $row['dungluong_id'],
            'mau_id' => $row['mau_id'],
            'soluongton' => $row['soluongton'],
        ]);
    }
}
