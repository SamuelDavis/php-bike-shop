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

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PersonController;

Route::get("/", EventController::toRoute("listEvents"));
Route::get("/event/{event}", AttendanceController::toRoute("showAttendance"));
Route::post("/event/{event}/{person}", AttendanceController::toRoute("toggleAttendance"));
Route::get("/people", PersonController::toRoute("listPeople"));
Route::get("/person/{person?}", PersonController::toRoute("showPerson"));
Route::post("/person/{person?}", PersonController::toRoute("savePerson"));
Route::get("/bikes", BikeController::toRoute("listBikes"));
Route::get("/bike/{bike?}", BikeController::toRoute("showBike"));
Route::post("/bike/{bike?}", BikeController::toRoute("saveBike"));
