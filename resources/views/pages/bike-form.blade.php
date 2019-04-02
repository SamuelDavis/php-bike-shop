<?php /** @var App\Views\Pages\BikeForm $vm */ ?>
@extends("layouts/default")

@section("body")
    @include("components/errors")
    <form action="{!! $vm->actionHref() !!}" method="post">
        @csrf
        <div class="form-group">
            <label for="description">Description<sup class="text-danger">*</sup></label>
            <input type="text" id="description" name="description" class="form-control"
                   value="{{ $vm->bike->description }}" required="required">
        </div>
        <div class="form-group">
            <label for="value">Value</label>
            <input type="number" step="0.01" min="0" id="value" name="value" class="form-control"
                   value="{{ $vm->bike->value }}">
        </div>
        <div class="form-group">
            <label for="source_id">Source<sup class="text-danger">*</sup></label>
            <select name="source_id" id="source_id" class="form-control" required="required">
                @foreach($vm->people as $person)
                    <option {!! $vm->selectedSource($person) !!} value="{{ $person->id }}">{{ $person->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="owner_id">Owner</label>
            <select name="owner_id" id="owner_id" class="form-control">
                <option value="">None</option>
                @foreach($vm->people as $person)
                    <option {!! $vm->selectedOwner($person) !!} value="{{ $person->id }}">{{ $person->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{ $vm->bike->notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
    <hr>
    <h1>Todos</h1>
    <form action="{!! $vm->todoActionHref() !!}" method="post" class="mb-4">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="description" placeholder="New todo description...">
        </div>
        <button class="btn btn-primary" type="submit">Save New Todo</button>
    </form>
    @foreach($vm->bike->todos as $todo)
        <div class="alert alert-{{ $todo->completed_at ? "success" : "warning" }}">
            <a href="{!! $vm->editTodoHref($todo) !!}" class="close">Edit</a>
            <span>{{ $todo->description }}</span>
            @if($todo->completed_at)
                <p class="mb-0">{{ $vm->todoByLine($todo) }}</p>
            @endif
        </div>
    @endforeach
@endsection
