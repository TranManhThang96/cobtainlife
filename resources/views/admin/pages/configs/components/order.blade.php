<form id="config-order-frm" method="POST">
    @csrf
    <input type="hidden" name="code" value="order">
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="order-default-vat" class="col-sm-2 text-right font-weight-bold">Thuế VAT</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-calendar-minus"></i>
                            </div>
                        </div>
                        <input name="order_default_vat" type="number" max="100" min="0" value="{{old('order_default_vat') ?? ($configs->order_default_vat['value'] ?? '')}}" class="form-control {{$errors->has('order_default_vat') ? 'is-invalid' : ''}}" id="order-default-vat" />
                        <x-custom-error field="order_default_vat" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <button type="reset" class="btn btn-info mr-2">Reset</button>
                <button type="submit" class="btn btn-success btn-save-config" data-form="config-order-frm">Lưu</button>
            </div>
        </div>
    </div>
</form>