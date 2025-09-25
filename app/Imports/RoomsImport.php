<?php

namespace App\Imports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoomsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Room([
            'room_number' => $row['room_number'],
            'bed_type'    => $row['bed_type'],
            'facilities'  => $row['facilities'],
            'price'       => $row['price'],
            'status'      => $row['status'] ?? 'tersedia',
        ]);
    }
}
