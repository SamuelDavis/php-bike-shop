<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\SaveBikeRequest;
use App\Models\Bike;
use Flash;
use Redirect;
use function compact;

class SaveBike extends Controller
{
    public function __invoke(SaveBikeRequest $request, Bike $bike = null)
    {
        $bike = $bike ?: new Bike;
        $bike
            ->fill($request->input())
            ->save();
        Flash::success("Bike saved.");
        return Redirect::route(ShowBikeForm::class, compact("bike"));
    }
}
