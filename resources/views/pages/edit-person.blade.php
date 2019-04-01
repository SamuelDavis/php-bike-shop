@extends("layouts/default")

@section("body")
    <form action="/person/{{ $person ? $person->id : "" }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name<sup class="text-danger">*</sup></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $person->name }}"
                   required="required">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ $person->address }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $person->phone }}">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" class="form-control"
                   value="{{ $person->dob ? $person->dob->format("YYYY-MM-DD") : null }}">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
