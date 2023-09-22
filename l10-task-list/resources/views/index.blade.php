@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
  @forelse ($tasks as $task)
    <div>
      <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
    </div>
  @empty
    <div>There are no tasks!</div>
  @endforelse

  {{-- Check if tasks exist --}}
  @if ($tasks->count())
  {{-- If yes then display links --}}
    <nav>
      {{$tasks->links()}}
  </nav>
  @endif
@endsection
