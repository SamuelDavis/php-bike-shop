<?php /** @var App\Views\Pages\BikesList $vm */ ?>
@extends("layouts.default")

@section("body")
    <div class="d-inline-flex flex-row flex-wrap">
        <div class="card m-1">
            <a href="{!! $vm->bikeFormHref() !!}" class="btn btn-primary btn-lg">New Bike</a>
        </div>
        @foreach($vm->bikes as $bike)
            <div class="card m-1">
                <a href="{!! $vm->bikeFormHref($bike) !!}" class="btn btn-lg">{{ $bike->description }}</a>
            </div>
        @endforeach
    </div>
@endsection