<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Tasks') }}</h1>
        <div class="w-full flex items-center">
            <div>
                {{ Form::model($tasks, [
                    'route' => 'tasks.index',
                    'method' => 'GET',
                ]) }}
                <div class="flex">
                    <div>
                        {{ Form::select('filter[status_id]', $taskStatuses, request()->input('filter.status_id'), [
                            'placeholder' => __('Status'),
                            'class' => 'rounded border-gray-300',
                        ]) }}
                    </div>
                    <div>
                        {{ Form::select('filter[created_by_id]', $users, request()->input('filter.created_by_id'), [
                            'placeholder' => __('Autor'),
                            'class' => 'ml-2 rounded border-gray-300',
                        ]) }}
                    </div>
                    <div>
                        {{ Form::select('filter[assigned_to_id]', $users, request()->input('filter.assigned_to_id'), [
                            'placeholder' => __('Executor'),
                            'class' => 'ml-2 rounded border-gray-300',
                        ]) }}
                    </div>
                    <div>
                        {{ Form::submit(__('Apply'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="ms-auto">
                @auth
                    <a href="{{ route('tasks.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('Create task') }}</a>
                @endauth
            </div>
        </div>
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
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
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                            {{ $task->name }}
                        </a>
                    </td>
                    <td>{{ $task->createdBy->name }}</td>
                    <td>{{ $task->assignedTo->name ?? '' }}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            @can('delete', $task)
                                <a class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task) }}"
                                    data-confirm="{{ __('Are you sure?') }}" data-method="delete">{{ __('Delete') }}</a>
                            @endcan
                            <a class="text-blue-600 hover:text-blue-900"
                                href="{{ route('tasks.edit', $task) }}">{{ __('Change') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
