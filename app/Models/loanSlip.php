<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loanSlip extends Model
{
    protected $fillable = [
        'admin_id',
        'student_id',
        'start_date',
        'end_date',
        'return_date',
        'total_books',
        'total_fee',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function loanSlipDetails()
    {
        return $this->hasMany(loanSlipDetail::class);
    }
}
