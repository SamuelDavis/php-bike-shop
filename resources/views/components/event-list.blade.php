<?php /** @var App\Views\Components\EventList $vm */ ?>
<div>
    @if($vm->withForm)
        <form action="" method="get" class="form-inline float-left">
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
    @endif
    @if($vm->withPost)
        <form action="" method="post" class="form-inline">
            @csrf
            <button class="btn btn-info" type="submit">Refresh</button>
        </form>
    @endif
</div>
<div class="clearfix"></div>
<div class="d-inline-flex flex-row flex-wrap">
    @foreach($vm->events as $event)
        <div class="card m-1">
            <a href="{!! $vm->href($event) !!}" class="btn btn-lg">
                <h5>{{ $event->name }}</h5>
                <small>{{ $event->timeRange }}</small>
            </a>
        </div>
    @endforeach
</div>
