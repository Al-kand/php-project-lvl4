<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Change task') }}</h1>
        {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH', 'class' => 'w-50']) }}
        @include('task.form', ['submittedValue' => __('Update')])
        {{ Form::close() }}
    </div>
</x-app-layout>
