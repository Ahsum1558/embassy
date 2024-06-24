    <option value="">Select City</option>
@foreach($all_city as $city)
    <option value="{{ $city->id }}">{{ $city->cityname }}</option>
@endforeach