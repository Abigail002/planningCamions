<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserCreated as MailUserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreatedListener
{
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
    public function handle(UserCreated $event): void
    {
        Mail::to($event->user)->send(new MailUserCreated($event->user));
    }
}
