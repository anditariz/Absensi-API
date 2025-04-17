<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    //
    protected $fillable = [
        'office_id',
        'lat_from_employee',
        'long_from_employee',
        'lat_from_office',
        'long_from_office',
        'attendance_in',
        'attendance_out',
        'status',
        'description',
    ];

    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        // untuk nampilin keluar klo 1 berarti active
        switch ($this->status) {
            case '1':
                $label = "Attendance In and Out";
                break;
            case '0':
                $label = "Attendance In";
                break;

            default:
                $label = "Attendance Out";
                break;
        }
        return $label;
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Offices::class, 'office_id', 'id');
    }
}
