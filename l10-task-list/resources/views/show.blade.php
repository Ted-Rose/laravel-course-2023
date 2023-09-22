@extends('layouts.app')

@section('title', $task->title)

@section('content')
  <p>{{ $task->description }}</p>

  @if ($task->long_description)
    <p>{{ $task->long_description }}</p>
  @endif

  <p>Created at: {{ $task->created_at }}</p>
  <p>Deleted at: {{ $task->updated_at }}</p>

  <p>
    @if ($task->completed)
      Completed
    @else
      Not completed
    @endif
  </p>
  <div>
    {{-- No need to pass in the task id since laravel is smart enough to get it form
    the task model --}}
    <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
  </div>

  <div>
    <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="POST">
      @csrf
      @method('PUT')
      <button type="submit">Mark as {{ $task->completed ? 'not completed' : 'completed' }}
      </button>
    </form>
  </div>

  <div>
    {{-- No need to pass in the task id since laravel is smart enough to get it form
    the task model --}}
    <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit">Delete</button>
    </form>
  </div>
@endsection
