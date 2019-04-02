<?php

namespace App\Views\Pages;

use App\Views\ViewModel;

class Container extends ViewModel
{
    private $args;

    public function __construct(...$args)
    {
        parent::__construct();
        $this->args = $args;
    }

    public function getArgs(): array
    {
        return array_filter($this->args, function ($arg) {
            return !($arg instanceof ViewModel);
        });
    }

    public function getVMs(): array
    {
        return array_filter($this->args, function ($arg) {
            return $arg instanceof ViewModel;
        });
    }
}