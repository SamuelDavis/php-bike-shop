@extends("layouts/default")

@section("body")
    <div class="container">
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
                        <div class="card-text">{{ $event->start->dateTime }}</div>
                        <div class="card-text">{{ $event->end->dateTime }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection