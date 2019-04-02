<?php /** @var App\Views\Pages\PersonForm $vm */ ?>
@extends("layouts/default")

@section("body")
    @include("components/errors")
    <form action="{!! $vm->actionHref() !!}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name<sup class="text-danger">*</sup></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $vm->person->name }}"
                   required="required">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ $vm->person->address }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $vm->person->phone }}">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" class="form-control" value="{{ $vm->getDob() }}">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
