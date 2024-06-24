    <option value="">Select Police Station</option>
@foreach($all_upzila as $upzila)
    <option value="{{ $upzila->id }}">{{ $upzila->policestationname }}</option>
@endforeach