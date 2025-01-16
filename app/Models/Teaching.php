<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'partner_link',
        'category',
        'duration',
        'type',
        'url',
        'is_live',
        'live_start_at',
    ];

    protected $casts = [
        'is_live' => 'boolean',
        'live_start_at' => 'datetime',
    ];
}
