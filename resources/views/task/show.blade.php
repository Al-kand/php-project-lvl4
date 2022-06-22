@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h1 class="mb-5">
            {{ __('Task view') }}: {{ $task->name }}
            <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
        </h1>
        <p>{{ __('Name') }}: {{ $task->name }}</p>
        <p>{{ __('Status') }}: {{ $task->status->name }}</p>
        <p>{{ __('Description') }}: {{ $task->description }}</p>
    </div>
@endsection
