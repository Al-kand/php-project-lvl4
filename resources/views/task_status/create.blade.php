@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('Create status') }}</h1>
        {{ Form::model($taskStatus, ['route' => 'task_statuses.store', 'class' => 'w-50']) }}
        <div class="form-group mb-3">
            {{ Form::label('name', __('Name')) }}
            {{ Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{ Form::submit(__('Create'), ['class' => 'btn btn-primary mt-3']) }}
        {{ Form::close() }}
    </div>
@endsection
