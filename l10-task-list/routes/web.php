<?php

use App\Http\Requests\TaskRequest;
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
        // Fetch all tasks and display pagination
        // also generate links to each page and automatically
        // read any querry parameters that are added to the page.
        // Set number of items to show per page.
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

// Type hint Task so that automatically it would automatically
// fetch findOrFail method
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
      // If model won't be found then 404 error will be returend
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// Add TaskRequest to type hint to automate validation
Route::post('/tasks', function (TaskRequest $request) {
  // Run `php artisan make:request TaskRequest` to create a class
  // Validation will happen before entering this function
  // If you can call request()->validate() then it means you already
  // have valid data
    // $data = request()->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
  
    // You can create new model, set all the attributes and save with one line:
    $task = Task::create($request->validated());
    
    return redirect()->route('tasks.show', ['task' => $task->id])
      ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // $data = request()->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    // update acts same as task create, but only operating on already existing model
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
      ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Fetch the task with function (Task $task)
Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
  // // Reversing tasks state
  // $task->completed = !$task->completed;
  // $task->save();

  // Or simply assign a method that reverses tasks state
  $task->toggleComplete();

  // Redirect to the previous page
  return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

// Again using route model binding to bind task
// If the task won't exist then 404 error will be returend
Route::delete('/tasks/{task}', function (Task $task) {
  // If we get till this line then it means task exists.
  // The models have delete method that removes record from db.
    $task->delete();

    return redirect()->route('tasks.index')
      ->with('success', 'Task deleted successfully!');
// In laravel mostly deletion tasks ar called destroy
})->name('tasks.destroy');

Route::fallback(function () {
    return 'Still got somewhere!';
});