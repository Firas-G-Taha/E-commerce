<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'craeted_at',
        'update_at'
    ];
    protected function category(){
        return $this->belongsTo(category::class);
    }
    protected function products(){
        return $this->hasMany(Product::class);
    }
}
