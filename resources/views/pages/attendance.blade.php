<?php /** @var Google_Service_Calendar_Event $event */ ?>
@extends("layouts/default")

@section("body")
    <div class="card text-center mb-2">
        <h2 class="card-title">{{ $event->name }}</h2>
        <div class="card-text">{{ $event->description }}</div>
        <small>{{ $event->timeRange }}</small>
    </div>
    <div class="d-inline-flex flex-row flex-wrap">
        @foreach($people as $person)
            <div class="card m-1">
                <form action="/event/{{ $event->id }}/{{ $person->id }}" method="post">
                    @csrf
                    <button type="submit"
                            class="btn btn-lg btn-{{ $attendance->contains($person->id) ? "default" : "secondary" }}">{{ $person->name }}</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection