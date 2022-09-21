<x-app-layout>
    <div class="grid col-span-full">
        <h1 class="mb-5">{{__('Change label')}}</h1>
        {{ Form::model($label, ['route' =>[ 'labels.update', $label], 'method' => 'PATCH', 'class' => 'w-50']) }}
        @include('label.form', ['submittedValue' => __('Update')])
        {{ Form::close() }}
    </div>
</x-app-layout>
