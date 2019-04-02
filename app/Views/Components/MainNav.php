<?php

namespace App\Views\Components;

use App\Http\Controllers\ShowBikesList;
use App\Http\Controllers\ShowEventsList;
use App\Http\Controllers\ShowPeopleList;
use App\Views\ViewModel;
use Route;
use URL;
use function uniqid;

class MainNav extends ViewModel
{
    /** @var string */
    public $id;
    /** @var array[] */
    public $mainNav;
    /** @var array[] */
    public $adminNav;

    public function __construct()
    {
        parent::__construct();
        $this->id = uniqid("nav_");
        $this->mainNav = [
            [URL::route(ShowEventsList::class), "Events"],
            [URL::route(ShowPeopleList::class), "People"],
            [URL::route(ShowBikesList::class), "Bikes"],
        ];
        $this->adminNav = [
            ["#", "Example"],
        ];
    }

    public function renderActiveClass($href): string
    {
        return in_array(Route::current()->uri, [$href, ltrim($href, "/")]) ? "active" : "";
    }
}