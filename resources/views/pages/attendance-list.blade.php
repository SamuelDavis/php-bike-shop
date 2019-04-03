<?php /** @var App\Views\Pages\AttendanceList $vm */ ?>
@extends("layouts.default")

@section("body")
    <div class="card text-center mb-2">
        <h2 class="card-title">{{ $vm->event->name }}</h2>
        <div class="card-text">{{ $vm->event->description }}</div>
        <small>{{ $vm->event->timeRange }}</small>
    </div>
    <div class="row">
        <div class="col col-xs-6">
            <h1 class="text-center">Signed In</h1>
            <hr>
            <div class="list-group">
                @foreach($vm->signedInPeople() as $person)
                    <div class="card">
                        <form action="/event/{{ $vm->event->id }}/{{ $person->id }}" method="post">
                            @csrf
                            <button type="submit"
                                    class="btn btn-block btn-secondary">{{ $person->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col col-xs-6">
            <h1 class="text-center">Signed Out</h1>
            <hr>
            <div class="list-group">
                @foreach($vm->signedOutPeople() as $person)
                    <div class="card">
                        <form action="/event/{{ $vm->event->id }}/{{ $person->id }}" method="post">
                            @csrf
                            <button type="submit"
                                    class="btn btn-block btn-secondary">{{ $person->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection