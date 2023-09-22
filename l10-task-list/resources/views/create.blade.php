@extends('layouts.app')

@section('title', 'Add Task')

@section('styles')
<style>
  .error-message {
    color: red;
    font-size: 0.8 rem;
  }
</style>
@endsection

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
      {{-- Displays the error message right below input --}}
      @error('title')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5"></textarea>
      @error('description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10"></textarea>
      @error('long_description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit">Add Task</button>
    </div>
  </form>
@endsection
