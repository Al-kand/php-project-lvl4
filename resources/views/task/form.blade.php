<div class="flex flex-col">
    <div>
        {{ Form::label('name', __('Name')) }}
    </div>
    <div>
        {{ Form::text('name', old('name'), [
            'class' => $errors->has('name') ? 'rounded border-rose-600 w-1/3' : 'rounded border-gray-300 w-1/3',
        ]) }}
    </div>
    @error('name')
        <div class="text-rose-600">{{ $message }}</div>
    @enderror

    <div class="mt-2">
        {{ Form::label('description', __('Description')) }}
    </div>
    <div>
        {{ Form::textarea('description', old('description'), [
            'class' => 'rounded border-gray-300 w-1/3 h-32',
        ]) }}
    </div>
    <div class="mt-2">
        {{ Form::label('status_id', __('Status')) }}
    </div>
    <div>
        {{ Form::select('status_id', $taskStatuses, null, [
            'placeholder' => '----------',
            'class' => $errors->has('status_id') ? 'rounded border-rose-600 w-1/3' : 'rounded border-gray-300 w-1/3',
        ]) }}
    </div>
    @error('status_id')
        <div class="text-rose-600">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        {{ Form::label('assigned_to_id', __('Executor')) }}
    </div>
    <div>
        {{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-gray-300 w-1/3']) }}
    </div>
    <div class="mt-2">
        {{ Form::label('labels', __('Labels')) }}
    </div>
    <div>
        {{ Form::select('labels[]', $labels, null, ['placeholder' => '', 'multiple', 'class' => 'rounded border-gray-300 w-1/3 h-32']) }}
    </div>
    <div class="mt-2">
        {{ Form::submit($submittedValue, ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
    </div>
</div>
