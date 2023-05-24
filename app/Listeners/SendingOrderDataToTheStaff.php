<?php

namespace App\Listeners;

use App\Events\NewOrder;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendingOrderDataToTheStaff
{
    use InteractsWithQueue;

    public $tries = 5;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrder $event): void
    {
        try{
            $event->purchaseOrder->notify(new NewOrderNotification());
        }catch(\Exception $e){

        }
    }
}
