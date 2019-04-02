<?php

namespace App\Views\Traits;

trait RendersAttributes
{
    protected function renderSelectedAttribute(bool $selected): string
    {
        return $selected ? "selected=\"selected\"" : "";
    }
}