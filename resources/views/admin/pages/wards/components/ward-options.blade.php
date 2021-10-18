<select class="custom-select custom-select-2 mr-sm-2 select-ward" name="ward_id" id="ward-id">
    <option value="">Select a option</option>
    @if(isset($wards))
        @foreach($wards as $ward)
            <option value="{{$ward['id']}}">{{$ward['name']}}</option>
        @endforeach
    @endif
</select>