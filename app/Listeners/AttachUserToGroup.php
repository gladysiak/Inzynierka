<?php

namespace App\Listeners;

use App\Events\GroupCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class AttachUserToGroup implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(GroupCreated $event)
    {
        $user = Auth::user();
        $group = $event->group;
        $group->users()->attach($user);
    }
}
