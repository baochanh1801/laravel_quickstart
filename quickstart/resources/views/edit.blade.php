
@extends('layouts.app')

@section('content')

<div>
    <form action="{{ url('task/'.$task->id). '/edit' }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <!-- Task Name -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-success">
                    Save Change
                </button>
            </div>
        </div>
    </form>
</div>
@endsection