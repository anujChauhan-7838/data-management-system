<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function categories()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }

    protected $fillable = [
        'name',
        'cat_id',
        'img',
        'price',
        'desc'
    ];
}
