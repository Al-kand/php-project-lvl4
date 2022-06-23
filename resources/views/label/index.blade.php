@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h1 class="mb-5">{{ __('Labels') }}</h1>
        @auth
            <a href="{{ route('labels.create') }}" class="btn btn-primary">{{ __('Create label') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Created') }}</th>
                    @auth
                        <th>{{ __('Actions') }}</th>
                    @endauth
                </tr>
            </thead>
            @foreach ($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a class="text-danger text-decoration-none"
                                href="{{ route('labels.destroy', $label) }}"
                                data-confirm="{{ __('Are you sure?') }}" data-method="delete">{{ __('Delete') }}</a>
                            <a class="text-decoration-none"
                                href="{{ route('labels.edit', $label) }}">{{ __('Change') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
            {{ $labels->links() }}
        </table>
    </div>
@endsection
