<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $productName;
    public $discount;
    public $start_date;
    public $end_date;

    public function __construct($productName, $discount, $start_date, $end_date)
    {
        $this->productName = $productName;
        $this->discount = $discount;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function build()
    {
        return $this->markdown('emails.discount')
                    ->subject('Pemberitahuan Diskon Produk')
                    ->with([
                        'productName' => $this->productName,
                        'discount' => $this->discount,
                        'start_date' => $this->start_date,
                        'end_date' => $this->end_date,
                    ]);
    }
}
