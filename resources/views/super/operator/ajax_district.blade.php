    <option value="">Select District</option>
@foreach($all_district as $district)
    <option value="{{ $district->id }}">{{ $district->districtname }}</option>
@endforeach