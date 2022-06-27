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
        @if (!$task->labels->isEmpty())
            <p>{{ __('Labels') }}: </p>
            <ul>
                @foreach ($task->labels as $label)
                    <li>{{ $label->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
