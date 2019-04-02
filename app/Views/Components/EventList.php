<?php

namespace App\Views\Components;

use App\Models\Event;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use function call_user_func;

class EventList extends ViewModel
{
    /** @var Collection|Event[] */
    public $events;
    public $withPost;
    private $hrefGen;

    public function __construct(Collection $events, callable $hrefGen, $withPost = false)
    {
        parent::__construct();
        $this->events = $events;
        $this->hrefGen = $hrefGen;
        $this->withPost = $withPost;
    }

    public function href(Event $event): string
    {
        return call_user_func($this->hrefGen, $event);
    }
}