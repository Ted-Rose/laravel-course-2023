@extends('layouts.app')

@section('title', 'Edit Task')

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

{{-- HTML is suited for GET and POST HTTP methods, but not for PUT
method --}}
  <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
    @csrf
    {{-- PUT directive method will add an hidden field to be sent
    with the form. This is called method spiffing. So when laravel
    receives the form it knows to use PUT method instead of POST--}}
    @method('PUT')
    <div>
      <label for="title">
        Title
      </label>
      <input text="text" name="title" id="title" value="{{ $task->title }}"/>
      {{-- Displays the error message right below input --}}
      @error('title')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5" value="{{ $task->description }}"/></textarea>
      @error('description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10" value="{{ $task->long_description }}"	></textarea>
      @error('long_description')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <button type="submit">Edit Task</button>
    </div>
  </form>
@endsection
