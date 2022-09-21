<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Create task') }}</h1>
        {{ Form::model($task, ['route' => 'tasks.store', 'class' => 'w-50']) }}
        @include('task.form', ['submittedValue' => __('Create')])
        {{ Form::close() }}
    </div>
</x-app-layout>
