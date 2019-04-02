<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBikeToDoRequest;
use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;
use Flash;
use Redirect;
use function compact;

class SaveBikeTodo extends Controller
{
    public function __invoke(SaveBikeToDoRequest $request, Bike $bike, BikeTodo $bikeTodo = null)
    {
        /** @var Bike $bike */
        $bikeTodo = $bikeTodo ?: new BikeTodo;
        $completedBy = Person::query()->find($request->completed_by_id);
        $confirmedBy = Person::query()->find($request->confirmed_by_id);

        $bikeTodo
            ->fill($request->input())
            ->setRelations([
                BikeTodo::RELATION_BIKE => $bike,
                BikeTodo::RELATION_COMPLETED_BY => $completedBy,
                BikeTodo::RELATION_CONFIRMED_BY => $confirmedBy,
            ])
            ->save();
        Flash::success("Bike Todo Saved.");

        return Redirect::route(ShowBikeForm::class, compact("bike"));
    }
}
