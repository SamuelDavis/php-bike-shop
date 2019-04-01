@extends("layouts/default")

@section("body")
    <div class="container">
        <form action="/bike/{{ $bike ? $bike->id : "" }}" method="post">
            @csrf
            <div class="form-group">
                <label for="description">Description<sup class="text-danger">*</sup></label>
                <input type="text" id="description" name="description" class="form-control"
                       value="{{ $bike->description }}" required="required">
            </div>
            <div class="form-group">
                <label for="value">Value</label>
                <input type="number" step="0.01" min="0" id="value" name="value" class="form-control"
                       value="{{ $bike->value }}">
            </div>
            <div class="form-group">
                <label for="source_id">Source<sup class="text-danger">*</sup></label>
                <select name="source_id" id="source_id" class="form-control" required="required">
                    @foreach($people as $person)
                        <option {!! $person->id === $bike->source_id ? "selected=\"selected\"" : "" !!}
                                value="{{ $person->id }}">{{ $person->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <select name="owner_id" id="owner_id" class="form-control">
                    <option value="">None</option>
                    @foreach($people as $person)
                        <option {!! $person->id === $bike->owner_id ? "selected=\"selected\"" : "" !!}
                                value="{{ $person->id }}">{{ $person->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{ $bike->notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
