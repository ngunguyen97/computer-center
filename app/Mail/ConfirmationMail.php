<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $personalDetail, $product;

  /**
   * Create a new message instance.
   *
   * @param $data
   * @param $product
   */
    public function __construct($data, $product)
    {
        $this->personalDetail = $data;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->markdown('emails.conformation')->with([
//          'personalDetail',$this->personalDetail,
//          'product' => $this->product
//        ]);
        return $this->view('emails.conformation',)->with([
          'personalDetail',$this->personalDetail,
          'product' => $this->product
        ]);
    }
}
