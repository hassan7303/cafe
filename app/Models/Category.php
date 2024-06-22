<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'url',
        'order',
    ];
    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id');//با این متد والد را پیدا میکنیم
    }
    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

}
