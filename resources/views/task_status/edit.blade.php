<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Change status') }}</h1>
        {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH', 'class' => 'w-50']) }}
        @include('task_status.form', ['submittedValue' => __('Update')])
        {{ Form::close() }}
    </div>
</x-app-layout>
