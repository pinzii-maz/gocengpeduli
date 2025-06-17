<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [
        'order_id',
        'donation_id',
        'donor_name',
        'donor_email',
        'amount',   
        'status',
    ];

    public function donasi()
    {
        return $this->belongsTo(donasi::class, 'donation_id');
    }
}
