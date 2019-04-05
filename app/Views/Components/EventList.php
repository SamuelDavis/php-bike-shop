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
    public $withForm;
    public $withPost;

    private $hrefGen;

    public function __construct(Collection $events, callable $hrefGen, $withForm = false, $withPost = false)
    {
        parent::__construct();
        $this->events = $events;
        $this->hrefGen = $hrefGen;
        $this->withForm = $withForm;
        $this->withPost = $withPost;
    }

    public function href(Event $event): string
    {
        return call_user_func($this->hrefGen, $event);
    }
}