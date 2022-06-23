@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h1 class="mb-5">{{ __('Tasks') }}</h1>
        @auth
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">{{ __('Create task') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Autor') }}</th>
                    <th>{{ __('Executor') }}</th>
                    <th>{{ __('Created') }}</th>
                    @auth
                        <th>{{ __('Actions') }}</th>
                    @endauth
                </tr>
            </thead>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>
                        <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">
                            {{ $task->status->name }}
                        </a>
                    </td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->createdBy->name }}</td>
                    <td>{{ $task->assignedTo->name ?? '' }}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            @can('delete', $task)
                                <a class="text-danger text-decoration-none" href="{{ route('tasks.destroy', $task) }}"
                                    data-confirm="{{ __('Are you sure?') }}" data-method="delete">{{ __('Delete') }}</a>
                            @endcan
                            <a class="text-decoration-none" href="{{ route('tasks.edit', $task) }}">{{ __('Change') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
            {{ $tasks->links() }}
        </table>
    </div>
@endsection
