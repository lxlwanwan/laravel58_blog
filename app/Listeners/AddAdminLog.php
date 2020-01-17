<?php

namespace App\Listeners;

use App\Events\AdminLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AddAdminLog
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
     * @param  AdminLog  $event
     * @return void
     */
    public function handle(AdminLog $event)
    {
        Log::alert('测试事件'.$event->admin->name);
    }

}
