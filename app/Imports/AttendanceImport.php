<?php

namespace App\Imports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class AttendanceImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'emp_id' => $row['emp_id'],
            'checkin' => date('H:i:s', strtotime($row['checkin'])),
            'checkout' => date('H:i:s', strtotime($row['checkout'])),
            'total_working_hours' => $row['total_working_hours']
        ]);
    }
}
