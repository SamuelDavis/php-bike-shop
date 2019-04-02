<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditBikeToDoRequest;
use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;
use Flash;
use Redirect;
use View;

class BikeTodoController extends Controller
{
    public function showBikeTodo(Bike $bike, BikeTodo $bikeTodo = null)
    {
        $bikeTodo = $bikeTodo ?: new BikeTodo;
        $bikeTodo->setRelation(BikeTodo::RELATION_BIKE, $bike);
        $people = Person::query()->get();
        return View::make("pages/edit-bike-todo", compact("bikeTodo", "people"));
    }

    public function saveBikeTodo(EditBikeToDoRequest $request, Bike $bike, BikeTodo $bikeTodo = null)
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

        return Redirect::to("/bike/{$bike->id}");
    }
}
