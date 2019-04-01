@extends("layouts/default")

@section("body")
    <form action="" method="get" class="form-inline">
        <div class="form-group mr-1">
            <label for="from" class="m-1">From</label>
            <input type="date" class="form-control" name="from" id="from"
                   value="{{ Request::query("from", now()->format("Y-m-d")) }}">
        </div>
        <div class="form-group m-1">
            <label for="to" class="mr-1">To</label>
            <input type="date" class="form-control" name="to" id="to"
                   value="{{ Request::query("to", now()->format("Y-m-d")) }}">
        </div>
        <button class="btn btn-success">Filter</button>
    </form>
    <div class="d-inline-flex flex-row flex-wrap">
        @foreach($events as $event)
            <div class="card m-1">
                <a href="/event/{{ $event->id }}" class="btn btn-lg">
                    {{ $event->summary }}
                    <div class="card-text">{{ $event->description }}</div>
                    <small>
                        {{ $event->startDateTime->format("M, d h:i a") }} &dash; {{ $event->endDateTime->format("M, d h:i a") }}
                    </small>
                </a>
            </div>
        @endforeach
    </div>
@endsection