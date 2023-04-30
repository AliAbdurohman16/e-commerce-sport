<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\DiscountMail;

class DiscountNotification extends Notification
{
    use Queueable;

    private $discount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($discount)
    {
        $this->discount = $discount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $productName = $this->discount->product->name;
        $discount = $this->discount->discount_percentage;
        $start_date = $this->discount->start_date;
        $end_date = $this->discount->end_date;

        return (new DiscountMail($productName, $discount, $start_date, $end_date))->to($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
