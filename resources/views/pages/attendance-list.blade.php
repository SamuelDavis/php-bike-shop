<?php /** @var App\Views\Pages\AttendanceList $vm */ ?>
@extends("layouts.default")

@section("body")
    <div class="card text-center mb-2">
        <h2 class="card-title">{{ $vm->event->name }}</h2>
        <div class="card-text">{{ $vm->event->description }}</div>
        <small>{{ $vm->event->timeRange }}</small>
    </div>
    <div class="d-inline-flex flex-row flex-wrap">
        @foreach($vm->people as $person)
            <div class="card m-1">
                <form action="/event/{{ $vm->event->id }}/{{ $person->id }}" method="post">
                    @csrf
                    <button type="submit"
                            class="btn btn-lg btn-{{ $vm->isActive($person) ? "default" : "secondary" }}">{{ $person->name }}</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection