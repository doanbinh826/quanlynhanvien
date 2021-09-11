<?php

namespace App\Exports;

use App\Models\all_salary_employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalaryExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            'Họ và tên' ,
            'user_name',
            'Chức vụ',
            'Lương cứng',
            'Lương làm thêm',
            'Lương thưởng dự án',
            'Lương onsite',
            'Lương khác',
            'Số giờ đi muộn',
            'Tiền phạt đi muộn',
            'Số ngày nghỉ',
            'Tiền trừ ngày nghỉ',
            'Tổng Lương',
            'Tháng',
            'Năm',
            'Tổng Lương toàn công ty'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return all_salary_employee::all();
        return collect(all_salary_employee::getSalary());
    }
}
