<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticVisitor extends Model
{
    protected $fillable = ['statistic_id', 'visitor_hash', 'visit_count'];

    public function statistic()
    {
        return $this->belongsTo(Statistic::class);
    }
}