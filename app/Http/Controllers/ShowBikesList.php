<?php

namespace App\Http\Controllers;

use App;
use App\Models\Bike;
use App\Views\Pages\BikesList;

class ShowBikesList extends Controller
{
    public function __invoke()
    {
        $bikes = Bike::query()->get();
        return new BikesList($bikes);
    }
}
