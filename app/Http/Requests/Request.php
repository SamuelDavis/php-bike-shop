<?php

namespace App\Http\Requests;

use Arr;
use Str;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    private $cache = [];

    public function rules()
    {
        return [];
    }

    public function __get($key)
    {
        $value = parent::__get($key);

        return $this->cache[$key] ?? $this->cache[$key]
                = method_exists($this, $method = 'get' . Str::studly($key) . 'Field')
                ? $this->$method($value)
                : $value;
    }

    public function all($keys = null)
    {
        $results = parent::all($keys) + $this->route()->parameters();

        return $keys
            ? Arr::only($results, $keys)
            : $results;
    }

    public function rewriteUrl(array $query): string
    {
        $query = http_build_query(array_map(function ($value) {
                return (string)$value;
            }, $query) + $this->query());
        return "{$this->getBaseUrl()}?{$query}";
    }
}