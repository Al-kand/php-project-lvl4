@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h1 class="mb-5">{{ __('Statuses') }}</h1>
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('Create status') }}</a>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Created') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            @foreach ($taskStatuses as $taskStatus)
                <tr>
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a class="text-danger text-decoration-none"
                            href="{{ route('task_statuses.destroy', $taskStatus) }}"
                            data-confirm="{{ __('Are you sure?') }}" data-method="delete">{{ __('Delete') }}</a>
                        <a class="text-decoration-none"
                            href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('Change') }}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
