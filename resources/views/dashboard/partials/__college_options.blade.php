@forelse ($colleges as $college)
    <option value="{{ $college->id }}" @if (isset($oldCollege) && $oldCollege == $college->id) selected @endif>{{ $college->name }}</option>
@empty
    <option disabled selected>{{ __('No College at this university') }}</option>
@endforelse
