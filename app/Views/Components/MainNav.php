<?php

namespace App\Views\Components;

use App\Http\Controllers\ShowAdminEventList;
use App\Http\Controllers\ShowBikesList;
use App\Http\Controllers\ShowEventsList;
use App\Http\Controllers\ShowPeopleList;
use App\Views\ViewModel;
use Config;
use Route;
use URL;
use function uniqid;

class MainNav extends ViewModel
{
    public $id;
    public $homeHref;
    public $brand;
    /** @var array[] */
    public $mainNav;
    /** @var array[] */
    public $adminNav;

    public function __construct()
    {
        parent::__construct();
        $this->id = uniqid("nav_");
        $this->homeHref = URL::route(ShowEventsList::class);
        $this->brand = Config::get("app.name");
        $this->mainNav = [
            [URL::route(ShowEventsList::class), "Events"],
            [URL::route(ShowPeopleList::class), "People"],
            [URL::route(ShowBikesList::class), "Bikes"],
        ];
        $this->adminNav = [
            [URL::route(ShowAdminEventList::class), "Attendance"],
        ];
    }

    public function renderActiveClass($href): string
    {
        return in_array(Route::current()->uri, [$href, ltrim($href, "/")]) ? "active" : "";
    }
}