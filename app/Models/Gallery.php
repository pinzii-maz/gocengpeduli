<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'donation_id'
    ];

    public function donation() {
        return $this->belongsTo(\App\Models\donasi::class, 'donation_id');
    }
}
