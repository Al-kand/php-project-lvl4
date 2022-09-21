<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Create status') }}</h1>
        {{ Form::model($taskStatus, ['route' => 'task_statuses.store', 'class' => 'w-50']) }}
        @include('task_status.form', ['submittedValue' => __('Create')])
        {{ Form::close() }}
    </div>
</x-app-layout>
