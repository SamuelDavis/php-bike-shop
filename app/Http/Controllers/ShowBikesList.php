<?php

namespace App\Http\Controllers;

use App;
use App\Models\Bike;
use View;

class ShowBikesList extends Controller
{
    public function __invoke()
    {
        $bikes = Bike::query()->get();
        return View::make("pages/list-bikes", compact("bikes"));
    }
}
