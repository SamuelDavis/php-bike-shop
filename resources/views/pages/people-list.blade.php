<?php /** @var App\Views\Pages\PeopleList $vm */ ?>
@extends("layouts/default")

@section("body")
    <div class="d-inline-flex flex-row flex-wrap">
        <div class="card m-1">
            <a href="{!! $vm->personFormHref() !!}" class="btn btn-primary btn-lg">New Person</a>
        </div>
        @foreach($vm->people as $person)
            <div class="card m-1">
                <a href="{!! $vm->personFormHref($person) !!}" class="btn btn-lg">{{ $person->name }}</a>
            </div>
        @endforeach
    </div>
@endsection