<?php

namespace App\Views\Pages;

use App\Http\Controllers\ShowBikeForm;
use App\Models\Bike;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use URL;
use function compact;

class BikesList extends ViewModel
{
    /** @var Collection|Bike[] */
    public $bikes;

    public function __construct(Collection $bikes)
    {
        parent::__construct();
        $this->bikes = $bikes;
    }

    public function bikeFormHref(Bike $bike = null): string
    {
        return URL::route(ShowBikeForm::class, compact("bike"));
    }
}