<?php /** @var App\Views\Pages\Admin\EventAttendanceTable $vm */ ?>
@extends("layouts.default")

@section("body")
    <div class="card text-center mb-2">
        <h2 class="card-title">{{ $vm->event->name }}</h2>
        <div class="card-text">{{ $vm->event->description }}</div>
        <small>{{ $vm->event->timeRange }} ({{ $vm->event->totalTime }})</small>
    </div>
    <table class="table table-responsive-lg">
        <thead>
        <tr>
            <th>{{ $vm->totalPeople() }}</th>
            <th>
                <button class="btn btn-sm btn-primary" data-copy="{!! $vm->copyEmails !!}">Copy Emails</button>
            </th>
            <th>{{ $vm->totalTime() }}</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Signed In</th>
            <th>Total Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vm->event->attendance as $attendance)
            <tr>
                <td>{{ $attendance->person->name }}</td>
                <td>{{ $attendance->signed_in_at->toDateTimeString() }}</td>
                <td>{{ $attendance->total_time }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
