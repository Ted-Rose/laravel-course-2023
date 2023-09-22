<?php

use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
      // When calling request's validate method it will use all the
      // data that was sent from farm to validate it and use the
      // keys to check the fields to validation rules
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    // If error happens than the user pack will be redirected to the
    // last page and will set a session variable to error
    // Session data will contain all errors

    // If everything is fine then laravel will define task with
    //the following parameters
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Call the models save method to save data to the database
    // Laravel is smart enough to allow you to work with models
    // that are loaded from the db and calling save should call
    // an update query, but if you created a new task it should
    // call an insert query
    $task->save();

    // Redirecting user to the newly created task page
    return redirect()->route('tasks.show', ['id' => $task->id]);
})->name('tasks.store');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

Route::fallback(function () {
    return 'Still got somewhere!';
});