<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ImportGoogleEvents;
use App\Http\Controllers\SaveBike;
use App\Http\Controllers\SaveBikeTodo;
use App\Http\Controllers\SavePerson;
use App\Http\Controllers\ShowAttendanceList;
use App\Http\Controllers\ShowBikeForm;
use App\Http\Controllers\ShowBikesList;
use App\Http\Controllers\ShowBikeTodoForm;
use App\Http\Controllers\ShowEventsList;
use App\Http\Controllers\ShowPeopleList;
use App\Http\Controllers\ShowPersonForm;
use App\Http\Controllers\ToggleAttendance;

Route::get("/", ShowEventsList::toRoute());
Route::post("/", ImportGoogleEvents::toRoute());
Route::get("/event/{event}", ShowAttendanceList::toRoute());
Route::post("/event/{event}/{person}", ToggleAttendance::toRoute());
Route::get("/people", ShowPeopleList::toRoute());
Route::get("/person/{person?}", ShowPersonForm::toRoute());
Route::post("/person/{person?}", SavePerson::toRoute());
Route::get("/bikes", ShowBikesList::toRoute());
Route::get("/bike/{bike?}", ShowBikeForm::toRoute());
Route::post("/bike/{bike?}", SaveBike::toRoute());
Route::get("/bike/{bike}/todos/{bikeTodo?}", ShowBikeTodoForm::toRoute());
Route::post("/bike/{bike}/todos/{bikeTodo?}", SaveBikeTodo::toRoute());
