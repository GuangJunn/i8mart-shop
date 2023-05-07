<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;

class Gmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('pages.mails.notifi')
                    ->from('duckgg9920@gmail.com','Hệ thống thương mại ISMART')
                    ->subject('[ISMART] Thông báo đơn hàng của bạn')
                    ->with($this->data);
    }
}
