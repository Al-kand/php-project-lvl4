@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Изменение статуса</h1>
        {{ Form::model($taskStatus, ['route' =>[ 'task_statuses.update', $taskStatus], 'method' => 'PATCH', 'class' => 'w-50']) }}
        <div class="form-group mb-3">
            {{ Form::label('name', __('Name')) }}
            {{ Form::text('name', $taskStatus->name, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{ Form::submit(__('Обновить'), ['class' => 'btn btn-primary mt-3']) }}
        {{ Form::close() }}
    </div>
@endsection
