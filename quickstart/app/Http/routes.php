<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Create The Task...
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/');
});
/**
 * Edit Task
 */

Route::get('/task/{task}/edit', function (Task $task) {

    error_log("helloooo");
    error_log($task->name);
    return view('edit')->with('task', Task::find($task->id));
});

Route::patch('/task/{task}/edit', function (Task $task, Request $request) {

    

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $current  = Task::find($task->id);
    $current->name = $request->name;
    $current->save();

    return redirect('/');
});
