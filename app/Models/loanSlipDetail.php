<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loanSlipDetail extends Model
{
    protected $fillable = [
        'loan_slip_id',
        'book_id',
        'fee_amount',
        'status',
    ];

    public function loanSlip()
    {
        return $this->belongsTo(loanSlip::class, 'loan_slip_id');
    }

    public function book()
    {
        return $this->belongsTo(book::class, 'book_id');
    }
}