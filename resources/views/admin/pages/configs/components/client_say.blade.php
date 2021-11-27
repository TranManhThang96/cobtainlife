<form id="config-client-frm" method="POST">
    @csrf
    <input type="hidden" name="code" value="client">
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="client-say-title" class="col-sm-1 text-right font-weight-bold">Tiêu đề</label>
                <div class="col-sm-11">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="client_say_title" type="text" value="{{old('client_say_title') ?? ($configs->client_say_title['value'] ?? '')}}" class="form-control {{$errors->has('client_say_title') ? 'is-invalid' : ''}}" id="client-say-title" />
                        <x-custom-error field="client_say_title" />
                    </div>
                </div>
            </div>

            <div class="form-group row config-image">
                <label for="client-say-background" class="col-sm-1 text-right font-weight-bold tex-nowrap">Hình nền</label>
                <div class="col-sm-11">
                    <div class="row mx-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" name="client_say_background" class="form-control" id="client-say-background" value="{{old('client_say_background', ($configs->client_say_background['value']) ?? '')}}">
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="client-say-background" data-preview="preview-client-say-background">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Hình ảnh tốt nhất 1720x560.</small>
                        <x-custom-error field="client_say_background" />
                    </div>
                    <div id="preview-client-say-background" class="img-holder mt-3">
                        <img src="{{old('client_say_background', ($configs->client_say_background['value'] ?? '')) ? asset('storage'.old('client_say_background', ($configs->client_say_background['value'] ?? ''))) : asset('assets/images/no-image.png')}}" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="client-say" class="col-sm-1 text-right font-weight-bold">Nhận xét</label>
                <div class="col-sm-11">
                        <div class="row">
                            <div class="col-8 pl-0">
                                <span>Nội dung</span>
                            </div>
                            <div class="col-2">
                                <span>Tên</span>
                            </div>
                            <div class="col-2">
                                <span>Nghề nghiệp</span>
                            </div>
                        </div>

                        <div id="says">
                            @if (isset($configs->client_says))
                                @foreach(json_decode($configs->client_says['value'], true) as $say)
                                    <div class="row say-item mt-3">
                                        <div class="col-8 pl-0">
                                            <input type="text" name="client_say[]" value="{{$say['client_say']}}" class="form-control rounded-0 input-sm" placeholder="Nhận xét" />
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group">
                                            <input type="text" name="client_name[]" value="{{$say['client_name']}}" class="form-control rounded-0 input-sm" placeholder="Tên" />
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group">
                                            <input type="text" name="client_job[]" value="{{$say['client_job']}}" class="form-control rounded-0 input-sm" placeholder="Nghề nghiệp" />
                                            <span title="Remove" class="btn btn-flat btn-danger remove-say">
                                                <i class="fa fa-times"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="row mt-3">
                            <button type="button" class="btn btn-flat btn-success" id="btn-add-says">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                    Thêm nhận xét
                                </button>
                        </div>
                </div>
            </div>
            
            <div class="row justify-content-center mt-5">
                <button type="reset" class="btn btn-info mr-2">Reset</button>
                <button type="submit" class="btn btn-success btn-save-config" data-form="config-client-frm">Lưu</button>
            </div>
        </div>
    </div>
</form>