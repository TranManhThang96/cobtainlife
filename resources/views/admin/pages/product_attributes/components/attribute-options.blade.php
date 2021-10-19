@if(isset($attributeGroups))
    @foreach($attributeGroups as $attributeGroupId=>$attributeGroup)
        <div class="row mx-0 mt-2 pl-2 attribute-group-options" data-group-id={{$attributeGroupId}}>
            @foreach($attributeGroup as $key=>$attribute)
                @if ($key == 0)
                    <b>{{$attribute['shop_attribute_group']['name']}}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                @endif
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" 
                    id="#index_attributeGroup_{{$attributeGroupId.'_'.$attribute['id']}}"
                    value="{{$attribute['product_id']}}-{{$attribute['attribute_group_id']}}-{{$attribute['code']}}"
                    data-attribute-json="{{json_encode($attribute)}}"
                    data-add-price="{{$attribute['add_price']}}" 
                    name="attribute[{{$attribute['product_id']}}][{{$attributeGroupId}}][#index]"
                    class="custom-control-input attribute-option-item"
                    {{$key == 0 ? 'checked' : ''}}
                >
                <label class="custom-control-label" for="#index_attributeGroup_{{$attributeGroupId.'_'.$attribute['id']}}">{{$attribute['name']}} (+{{number_format($attribute['add_price'], 0)}})</label>
                </div>
            @endforeach
        </div>
    @endforeach
@endif