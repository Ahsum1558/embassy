    <option value="">Select Division</option>
@foreach($all_division as $division)
    <option value="{{ $division->id }}">{{ $division->divisionname }}</option>
@endforeach