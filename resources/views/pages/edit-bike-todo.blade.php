@extends("layouts/default")

@section("body")
    @include("components/errors")
    <form action="/bike/{{ $todo->bike->id }}/todos/{{ $todo->id }}" method="post">
        @csrf
        <div class="form-group">
            <label for="description">Description<sup class="text-danger">*</sup></label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $todo->description }}"
                   required="required">
        </div>
        <div class="form-group">
            <label for="completed_at">Completed At</label>
            <input type="date" id="completed_at" name="completed_at" class="form-control"
                   value="{{ $todo->completed_at ? $todo->completed_at->format("Y-m-d") : null }}">
        </div>
        <div class="form-group">
            <label for="completed_by_id">Completed By</label>
            <select name="completed_by_id" id="completed_by_id" class="form-control">
                <option value="">None</option>
                @foreach($people as $person)
                    <option {!! $person->id === $todo->completed_by_id ? "selected=\"selected\"" : "" !!}
                            value="{{ $person->id }}">{{ $person->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="confirmed_by_id">Confirmed By</label>
            <select name="confirmed_by_id" id="confirmed_by_id" class="form-control">
                <option value="">None</option>
                @foreach($people as $person)
                    <option {!! $person->id === $todo->confirmed_by_id ? "selected=\"selected\"" : "" !!}
                            value="{{ $person->id }}">{{ $person->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
