@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{__('Change task')}}</h1>
        {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH', 'class' => 'w-50']) }}
        <div class="form-group mb-3">
            {{ Form::label('name', __('Name')) }}
            {{ Form::text('name', $task->name, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror            
            {{ Form::label('description', __('Description')) }}
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
            {{ Form::label('status_id', __('Status')) }}
            {{ Form::select('status_id', $taskStatuses, $task->status_id, ['class' => $errors->has('status_id') ? 'form-control is-invalid' : 'form-control']) }}
            @error('status_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            {{ Form::label('assigned_to_id', __('Executor')) }}
            {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['placeholder' => '----------', 'class' => 'form-control']) }}
        </div>
        {{ Form::submit(__('Refresh'), ['class' => 'btn btn-primary mt-3']) }}
        {{ Form::close() }}
    </div>
@endsection
