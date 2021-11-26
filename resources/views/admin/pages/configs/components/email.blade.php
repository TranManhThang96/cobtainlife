<form id="config-email-frm" method="POST">
    @csrf
    <input type="hidden" name="code" value="email">
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="email-smtp-host" class="col-sm-2 text-right font-weight-bold">Smtp Host</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="email_smtp_host" type="text" value="{{old('email_smtp_host') ?? ($configs->email_smtp_host['value'] ?? '')}}" class="form-control {{$errors->has('email_smtp_host') ? 'is-invalid' : ''}}" id="store-smtp-host" />
                        <x-custom-error field="email_smtp_host" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email-smtp-port" class="col-sm-2 text-right font-weight-bold">Smtp Port</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="email_smtp_port" type="text" value="{{old('email_smtp_port') ?? ($configs->email_smtp_port['value'] ?? '587')}}" class="form-control {{$errors->has('email_smtp_port') ? 'is-invalid' : ''}}" id="store-smtp-port" />
                        <x-custom-error field="email_smtp_port" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email-username" class="col-sm-2 text-right font-weight-bold">Tài khoản</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input name="email_username" type="text" value="{{old('email_username') ?? ($configs->email_username['value'] ?? '')}}" class="form-control {{$errors->has('email_username') ? 'is-invalid' : ''}}" id="email-username" />
                        <x-custom-error field="email_username" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email-address" class="col-sm-2 text-right font-weight-bold">Địa chỉ</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input name="email_address" type="text" value="{{old('email_address') ?? ($configs->email_address['value'] ?? '')}}" class="form-control {{$errors->has('email_address') ? 'is-invalid' : ''}}" id="email-address" />
                        <x-custom-error field="email_address" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email-password" class="col-sm-2 text-right font-weight-bold">Mật khẩu</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <input name="email_password" type="text" value="{{old('email_password') ?? ($configs->email_password['value'] ?? '')}}" class="form-control {{$errors->has('email_password') ? 'is-invalid' : ''}}" id="store-password" />
                        <x-custom-error field="email_password" />
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-5">
                <button type="reset" class="btn btn-info mr-2">Reset</button>
                <button type="submit" class="btn btn-success btn-save-config" data-form="config-email-frm">Lưu</button>
            </div>
        </div>
    </div>
</form>