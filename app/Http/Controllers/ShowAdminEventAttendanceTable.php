<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Views\Pages\Admin\EventAttendanceTable;

class ShowAdminEventAttendanceTable extends Controller
{
    public function __invoke(Event $event)
    {
        return new EventAttendanceTable($event);
    }
}
