<!DOCTYPE html>
<html>

<head>
  <title>Laravel 10 Task List App</title>
  {{-- Yield styles here in order to be included in all views --}}
  @yield('styles')
</head>

<body>
  <h1>@yield('title')</h1>
  <div>
    {{-- Session is an object with method has which lets to check if certain
    variable is in this session, for this is the only case we wan't do displays
    success --}}
    @if (session()->has('success'))
      <div>{{ session('success') }}</div>
    @endif
    {{-- On successful form submit you will see success message.
    On refresh the message disappears --}}
    @yield('content')
  </div>
</body>

</html>
