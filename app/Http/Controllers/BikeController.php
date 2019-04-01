<?php

namespace App\Http\Controllers;

use App;
use App\Models\Bike;
use App\Models\Person;
use Flash;
use Illuminate\Http\Request;
use Redirect;
use View;

class BikeController extends Controller
{
    public function listBikes()
    {
        $bikes = Bike::query()->get();
        return View::make("pages/list-bikes", compact("bikes"));
    }

    public function showBike(?string $bikeId = null)
    {
        $bike = Bike::query()->find($bikeId) ?: new Bike;
        $people = Person::query()->get();
        return View::make("pages/edit-bike", compact("bike", "people"));
    }

    public function saveBike(Request $request, ?string $bikeId = null)
    {
        $bike = Bike::query()->find($bikeId) ?: new Bike;
        $bike
            ->fill($request->input())
            ->save();
        Flash::success("Person saved.");
        return Redirect::to("/bike/{$bike->id}");
    }
}
