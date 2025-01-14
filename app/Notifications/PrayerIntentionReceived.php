<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class PrayerIntentionReceived extends Notification
{
    use Queueable;

    protected $prayerIntention;

    /**
     * Create a new notification instance.
     *
     * @param $prayerIntention
     */
    public function __construct($prayerIntention)
    {
        $this->prayerIntention = $prayerIntention;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    /**
     * Get the Twilio representation of the notification.
     *
     * @param mixed $notifiable
     * @return TwilioSmsMessage
     */
    
    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
        
            ->from(config('services.twilio.from'))
            ->content("Une nouvelle intention de prière a été soumise : {$this->prayerIntention->message}");

       
    }
    
}
