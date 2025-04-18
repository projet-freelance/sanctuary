<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReligiousItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'price', 'category_id', 'stock', 'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
