@extends("layouts/default")

@section("body")
    <div class="container">
        <div class="d-inline-flex flex-row flex-wrap">
            <div class="card m-1">
                <a href="/bike" class="btn btn-primary btn-lg">New Bike</a>
            </div>
            @foreach($bikes as $bike)
                <div class="card m-1">
                    <a href="/bike/{{ $bike->id }}" class="btn btn-lg">{{ $bike->description }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection