<?php

namespace App\Builders;

class Builder extends \Illuminate\Database\Eloquent\Builder
{
    public function toSql()
    {
        return array_reduce($this->getBindings(), function (string $sql, $binding) {
            if (!is_numeric($binding)) {
                $binding = escapeshellarg($binding);
            }
            return preg_replace('/\?/', $binding, $sql, 1);
        }, parent::toSql());
    }
}