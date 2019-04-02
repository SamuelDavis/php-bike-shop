<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\EditBikeRequest;
use App\Models\Bike;
use App\Models\Person;
use Flash;
use Redirect;
use View;

class BikeController extends Controller
{
    public function listBikes()
    {
        $bikes = Bike::query()->get();
        return View::make("pages/list-bikes", compact("bikes"));
    }

    public function showBike(Bike $bike = null)
    {
        $bike = $bike ?: new Bike;
        $people = Person::query()->get();
        return View::make("pages/edit-bike", compact("bike", "people"));
    }

    public function saveBike(EditBikeRequest $request, Bike $bike = null)
    {
        $bike = $bike ?: new Bike;
        $bike
            ->fill($request->input())
            ->save();
        Flash::success("Person saved.");
        return Redirect::to("/bike/{$bike->id}");
    }
}
