<form id="config-store-frm" method="POST">
    @csrf
    <input type="hidden" name="code" value="store">
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="store-hotline" class="col-sm-2 text-right font-weight-bold">Số hotline</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-phone fa-fw"></i>
                            </div>
                        </div>
                        <input name="store_hotline" type="text" value="{{old('store_hotline') ?? ($configs->store_hotline['value'] ?? '')}}" class="form-control {{$errors->has('store_hotline') ? 'is-invalid' : ''}}" id="store-hotline" />
                        <x-custom-error field="store_hotline" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-welcome" class="col-sm-2 text-right font-weight-bold">Lời chào</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_welcome" type="text" value="{{old('store_welcome') ?? ($configs->store_welcome['value'] ?? '')}}" class="form-control {{$errors->has('store_welcome') ? 'is-invalid' : ''}}" id="store-welcome" />
                        <x-custom-error field="store_welcome" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-address" class="col-sm-2 text-right font-weight-bold">Địa chỉ</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_address" type="text" value="{{old('store_address') ?? ($configs->store_address['value'] ?? '')}}" class="form-control {{$errors->has('store_address') ? 'is-invalid' : ''}}" id="store-address" />
                        <x-custom-error field="store_address" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-google-embed" class="col-sm-2 text-right font-weight-bold">Google embed</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_google_embed" type="text" value="{{old('store_google_embed') ?? ($configs->store_google_embed['value'] ?? '')}}" class="form-control {{$errors->has('store_google_embed') ? 'is-invalid' : ''}}" id="store-google-embed" />
                        <x-custom-error field="store_google_embed" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-email" class="col-sm-2 text-right font-weight-bold">Email liên hệ</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input name="store_email" type="text" value="{{old('store_email') ?? ($configs->store_email['value'] ?? '')}}" class="form-control {{$errors->has('store_email') ? 'is-invalid' : ''}}" id="store-address" />
                        <x-custom-error field="store_email" />
                    </div>
                </div>
            </div>

            <div class="form-group row config-image">
                <label for="store-logo" class="col-sm-2 text-right font-weight-bold">Logo</label>
                <div class="col-sm-10">
                    <div class="row mx-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" name="store_logo" class="form-control" id="store-logo" value="{{old('store_logo', ($configs->store_logo['value'] ?? ''))}}">
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="store-logo" data-preview="preview-store-logo">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Hình ảnh tốt nhất 125x80.</small>
                        <x-custom-error field="store_logo" />
                    </div>
                    <div id="preview-store-logo" class="img-holder mt-3">
                        <img src="{{old('store_logo', ($configs->store_logo['value'] ?? '')) ? asset('storage'.old('store_logo', ($configs->store_logo['value'] ?? ''))) : asset('assets/images/no-image.png')}}" />
                    </div>
                </div>
            </div>


            <div class="form-group row config-image">
                <label for="store-background" class="col-sm-2 text-right font-weight-bold">Background cửa hàng</label>
                <div class="col-sm-10">
                    <div class="row mx-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" name="store_background" class="form-control" id="store-background" value="{{old('store_background', ($configs->store_background['value'] ?? ''))}}">
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="store-background" data-preview="preview-store-background">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Hình ảnh tốt nhất 1920x300.</small>
                        <x-custom-error field="store_background" />
                    </div>
                    <div id="preview-store-background" class="img-holder mt-3">
                        <img src="{{old('store_background', ($configs->store_background['value'] ?? '')) ? asset('storage'.old('store_background', ($configs->store_background['value'] ?? ''))) : asset('assets/images/no-image.png')}}" />
                    </div>
                </div>
            </div>

            <div class="form-group row config-image">
                <label for="store-background-subscribe" class="col-sm-2 text-right font-weight-bold">Background đăng ký</label>
                <div class="col-sm-10">
                    <div class="row mx-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" name="store_background_subscribe" class="form-control" id="store-background-subscribe" value="{{old('store_background_subscribe', $configs->store_background_subscribe['value'])}}">
                            </div>
                            <div class="input-group-append">
                                <span class="btn btn-primary lfm" data-input="store-background-subscribe" data-preview="preview-store-background-subscribe">
                                    <i class="fas fa-image"></i> Chọn hình
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Hình ảnh tốt nhất 1170x465.</small>
                        <x-custom-error field="store_background_subscribe" />
                    </div>
                    <div id="preview-store-background-subscribe" class="img-holder mt-3">
                        <img src="{{old('store_background_subscribe', ($configs->store_background_subscribe['value'] ?? '')) ? asset('storage'.old('store_background_subscribe', ($configs->store_background_subscribe['value'] ?? ''))) : asset('assets/images/no-image.png')}}" />
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <label for="store-facebook-url" class="col-sm-2 text-right font-weight-bold">Facebook url</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_facebook_url" type="text" value="{{old('store_facebook_url', ($configs->store_facebook_url['value'] ?? ''))}}" class="form-control {{$errors->has('store_facebook_url') ? 'is-invalid' : ''}}" id="store-facebook-url" />
                        <x-custom-error field="store_facebook_url" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-twitter-url" class="col-sm-2 text-right font-weight-bold">Twitter url</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_twitter_url" type="text" value="{{old('store_twitter_url', ($configs->store_twitter_url['value'] ?? ''))}}" class="form-control {{$errors->has('store_twitter_url') ? 'is-invalid' : ''}}" id="store-twitter-url" />
                        <x-custom-error field="store_twitter_url" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-instagram-url" class="col-sm-2 text-right font-weight-bold">Instagram url</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_instagram_url" type="text" value="{{old('store_instagram_url', ($configs->store_instagram_url['value'] ?? ''))}}" class="form-control {{$errors->has('store_instagram_url') ? 'is-invalid' : ''}}" id="store-instagram-url" />
                        <x-custom-error field="store_instagram_url" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="store-youtube-url" class="col-sm-2 text-right font-weight-bold">Youtube url</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="store_youtube_url" type="text" value="{{old('store_youtube_url', ($configs->store_youtube_url['value'] ?? ''))}}" class="form-control {{$errors->has('store_youtube_url') ? 'is-invalid' : ''}}" id="store-youtube-url" />
                        <x-custom-error field="store_youtube_url" />
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-5">
                <button type="reset" class="btn btn-info mr-2">Reset</button>
                <button type="submit" class="btn btn-success btn-save-config" data-form="config-store-frm">Lưu</button>
            </div>
        </div>
    </div>
</form>