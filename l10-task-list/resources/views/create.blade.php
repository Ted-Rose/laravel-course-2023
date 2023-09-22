@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
{{-- Special $errors variable is avaible to all views.
It doesn't need to be passed from any routes --}}
{{-- {{ $errors }} --}}
{{-- $errors are created if an error occurs. For example
if you submit empty form --}}
  <form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div>
      <label for="title">
        Title
      </label>
      <input text="text" name="title" id="title" />
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5"></textarea>
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10"></textarea>
    </div>

    <div>
      <button type="submit">Add Task</button>
    </div>
  </form>
@endsection
