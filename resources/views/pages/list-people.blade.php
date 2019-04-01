@extends("layouts/default")

@section("body")
    <div class="container">
        <div class="d-inline-flex flex-row flex-wrap">
            <div class="card m-1">
                <a href="/person" class="btn btn-primary btn-lg">New Person</a>
            </div>
            @foreach($people as $person)
                <div class="card m-1">
                    <a href="/person/{{ $person->id }}" class="btn btn-lg">{{ $person->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection