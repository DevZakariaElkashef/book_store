<option disabled selected>{{ __('Choose Subject') }}</option>
@forelse ($subjects as $subject)
    <option value="{{ $subject->id }}" @if (isset($oldSubject) && $oldSubject == $subject->id) selected @endif>{{ $subject->name }}</option>
@empty
    <option disabled selected>{{ __('No Subject at this College') }}</option>
@endforelse
