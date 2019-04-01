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

use App\Http\Controllers\Controller;

Route::get("/", Controller::toRoute("listEvents"));
Route::get("/event/{event}", Controller::toRoute("showAttendance"));
Route::post("/event/{event}/{person}", Controller::toRoute("toggleAttendance"));
Route::get("/people", Controller::toRoute("listPeople"));
Route::get("/person/{person?}", Controller::toRoute("showPerson"));
Route::post("/person/{person?}", Controller::toRoute("savePerson"));
