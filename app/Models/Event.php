<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date_time',
        'location',
        'ticket_price',
        'available_seats',
        'image',
        'category',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'ticket_price' => 'decimal:2',
        'available_seats' => 'integer',
    ];

    protected $appends = [
        'formatted_date',
        'is_upcoming',
        'days_until_event',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date_time->format('d/m/Y H:i');
    }

    public function getIsUpcomingAttribute()
    {
        return $this->date_time->isFuture();
    }

    public function getDaysUntilEventAttribute()
    {
        return now()->diffInDays($this->date_time, false);
    }

    public function hasAvailableSeats()
    {
        return $this->available_seats > 0;
    }

    public function decrementAvailableSeats($quantity = 1)
    {
        $this->available_seats -= $quantity;
        $this->save();
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date_time', '>', now())
            ->orderBy('date_time', 'asc');
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days))
            ->orderBy('created_at', 'desc');
    }
}