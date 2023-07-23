<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeleteUserRelations
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
    public function handle(UserDeleted $event): void
    {
        $user = $event->user;

        // usuwanie grupy, których użytkownik był administratorem
        DB::table('groups')->where('admin_id', $user->id)->delete();

        // usuwanie relacji pomiędzy grupą a użytkownikiem
        $user->groups()->detach();
    }
}
