<div class="flex flex-col">
    <div>
        {{ Form::label('name', __('Name')) }}
    </div>
    <div class="mt-2">
        {{ Form::text('name', old('name'), [
            'class' => $errors->has('name') ? 'rounded border-rose-600 w-1/3' : 'rounded border-gray-300 w-1/3',
        ]) }}
        @error('name')
            <div class="text-rose-600">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-2">
        {{ Form::submit($submittedValue, [
            'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
        ]) }}
    </div>
</div>