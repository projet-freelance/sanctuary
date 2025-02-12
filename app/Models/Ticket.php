<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'ticket_code'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function getQrCodePathAttribute()
    {
        return "qrcodes/ticket_{$this->ticket_code}.png";
    }

    public function generateQrCode()
    {
        $path = public_path($this->qr_code_path);
        QrCode::size(300)->format('png')->generate(route('tickets.show', $this->ticket_code), $path);
    }
}
