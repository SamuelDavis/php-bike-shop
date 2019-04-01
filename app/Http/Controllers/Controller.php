<?php

namespace App\Http\Controllers;

use App;
use Google_Service_Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Spatie\GoogleCalendar\Event;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function toRoute(string $method = "__invoke")
    {
        return [
            "as" => static::class . "@{$method}",
            "uses" => static::class . "@{$method}"
        ];
    }

    protected function lookupEvent(string $eventId)
    {
        try {
            return Event::find($eventId);
        } catch (Google_Service_Exception $e) {
            if ($e->getCode() === 404) {
                App::abort(404, "Event not found.");
            }
            throw $e;
        }
    }
}
