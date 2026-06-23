<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\SendOrderConfirmationEmailJob;

class SendOrderConfirmationListener
{
    public function handle(OrderPlaced $event): void
    {
        SendOrderConfirmationEmailJob::dispatch(
            $event->order
        );
    }
}