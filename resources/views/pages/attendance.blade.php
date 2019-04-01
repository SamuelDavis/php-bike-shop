<?php /** @var Google_Service_Calendar_Event $event */ ?>
@extends("layouts/default")

@section("body")
    <div class="container">
        <h1 class="text-center">{{ $event->summary }}</h1>
        <p class="text-center">{{ $event->description }}</p>
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
    </div>
@endsection