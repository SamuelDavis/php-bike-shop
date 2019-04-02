<?php

namespace App\Views;

use App;
use Exception;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Collection;
use Str;
use View;
use function explode;

class ViewModel
{
    private $template;

    public function __construct(string $template = null)
    {
        $this->template = $template ?: Collection::make(explode("\\", static::class))
            ->slice(2)
            ->map(function (string $chunk) {
                return Str::kebab($chunk);
            })
            ->join(".");
    }

    public function __toString()
    {
        try {
            return (string)App::call(function () {
                return View::make($this->template, ['vm' => $this])->render();
            });
        } catch (Exception $e) {
            $handler = new HandleExceptions;
            $handler->bootstrap(app());
            $handler->handleException($e);
            die();
        }
    }
}