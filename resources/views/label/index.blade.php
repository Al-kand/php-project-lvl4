<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Labels') }}</h1>
        @auth
            <div>
                <a href="{{ route('labels.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create label') }}
                </a>
            </div>
        @endauth
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Created') }}</th>
                    @auth
                        <th>{{ __('Actions') }}</th>
                    @endauth
                </tr>
            </thead>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label) }}"
                                data-confirm="{{ __('Are you sure?') }}" data-method="delete">
                                {{ __('Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">
                                {{ __('Change') }}
                            </a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>
        {{ $labels->links() }}
    </div>
</x-app-layout>
