@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h1 class="mb-5">{{ __('Tasks') }}</h1>
        <div class="d-flex mb-3">
            <div>
                {{ Form::model($tasks, [
                    'route' => 'tasks.index',
                    'class' => 'row g-1',
                    'method' => 'GET',
                ]) }}
                <div class="col">
                    {{ Form::select('filter[status_id]', $taskStatuses, request()->get('filter')['status_id'] ?? null, [
                        'placeholder' => __('Status'),
                        'class' => 'form-select me-2',
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::select('filter[created_by_id]', $users, request()->get('filter')['created_by_id'] ?? null, [
                        'placeholder' => __('Autor'),
                        'class' => 'form-select me-2',
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::select('filter[assigned_to_id]', $users, request()->get('filter')['assigned_to_id'] ?? null, [
                        'placeholder' => __('Executor'),
                        'class' => 'form-select me-2',
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::submit(__('Apply'), ['class' => 'btn btn-outline-primary me-2']) }}
                </div>
                {{ Form::close() }}
            </div>
            <div class="ms-auto">
                @auth
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">{{ __('Create task') }}</a>
                @endauth
            </div>
        </div>

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
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">
                            {{ $task->name }}
                        </a>
                    </td>
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
