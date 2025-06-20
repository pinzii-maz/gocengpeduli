<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function donasi() {
        return $this->hasMany(\App\Models\donasi::class);
    }
}
