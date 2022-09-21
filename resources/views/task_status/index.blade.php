<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Statuses') }}</h1>
        @auth
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    href="{{ route('task_statuses.create') }}">
                    {{ __('Create status') }}
                </a>
            </div>
        @endauth
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Created') }}</th>
                    @auth
                        <th>{{ __('Actions') }}</th>
                    @endauth
                </tr>
            </thead>
            @foreach ($taskStatuses as $taskStatus)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a class="text-red-600 hover:text-red-900" data-confirm="{{ __('Are you sure?') }}"
                                data-method="delete" href="{{ route('task_statuses.destroy', $taskStatus) }}">
                                {{ __('Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900"
                                href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('Change') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>
        {{ $taskStatuses->links() }}
    </div>
</x-app-layout>
