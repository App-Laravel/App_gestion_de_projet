<?php

namespace App\Listeners;

use App\Events\InviteMembers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvitationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InviteMembers  $event
     * @return void
     */
    public function handle(InviteMembers $event)
    {
        
    }
}
