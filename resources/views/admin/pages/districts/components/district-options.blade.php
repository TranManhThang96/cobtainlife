<select class="custom-select custom-select-2 mr-sm-2 select-district" name="district_id" id="district-id">
    <option value="">Select a option</option>
    @if(isset($districts))
        @foreach($districts as $district)
            <option value="{{$district['id']}}">{{$district['name']}}</option>
        @endforeach
    @endif
</select>