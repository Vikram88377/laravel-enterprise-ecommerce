<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
class SendOrderConfirmationEmailJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(
        public $order
    ) {
    }

    public function handle(): void
    {

    $this->order->load('user', 'items');

    Mail::to($this->order->user->email)
        ->send(new OrderConfirmationMail($this->order));

        
        Log::info('Order confirmation email job executed', [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'grand_total' => $this->order->grand_total,

            


        ]);
    }
}