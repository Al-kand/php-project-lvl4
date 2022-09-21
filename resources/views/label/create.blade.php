<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('Create label') }}</h1>
        {{ Form::model($label, ['route' => 'labels.store', 'class' => 'w-50']) }}
        @include('label.form', ['submittedValue' => __('Create')])
        {{ Form::close() }}
    </div>
</x-app-layout>
