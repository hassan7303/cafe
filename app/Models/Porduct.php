<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Porduct extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
