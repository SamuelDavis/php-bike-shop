<?php /** @var App\Views\Pages\Container $vm */ ?>
@extends("layouts/default")

@section("body")
    @if($vm->getArgs())
        @dump($vm->getArgs())
    @endif
    @foreach($vm->getVMs() as $child)
        {!! $child !!}
    @endforeach
@endsection
