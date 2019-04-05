<?php

namespace App\Views\Components;

use App\Views\ViewModel;

class Alert extends ViewModel
{
    public $message;
    public $type;

    public function __construct(string $message = "")
    {
        parent::__construct();
        $this->message = $message;
        $this->type = "default";
    }

    public function info(): self
    {
        $this->type = "info";
        return $this;
    }
}