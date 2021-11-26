@extends('admin.layout.default')

@section('title', 'Gửi mail')

@section('breadcrumb')
{{renderBreadcrumb('Gửi mail', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách chiến dịch', 'link' => route('admin.campaigns.index')]
    ])}}
@endsection

@section('content')
<form id="campaigns-frm" method="POST" action="{{route('admin.campaigns.store')}}" name="frm-new">
    @csrf
    <div class="row">
        <div class="col-12 bg-white py-5">
            <div class="form-group row">
                <label for="campaign-subject" class="col-sm-2 text-right font-weight-bold">
                    Chủ đề <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="subject" type="text" value="{{old('subject') ?? ''}}" class="form-control {{$errors->has('subject') ? 'is-invalid' : ''}}" id="campaign-subject" />
                    </div>
                    <x-custom-error field="subject" />
                </div>
            </div>

            <div class="form-group row">
                <label for="campaign-to" class="col-sm-2 text-right font-weight-bold">
                    Gửi đến <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" value="1" id="campaign-press-mail" name="campaign_press_mail">
                        <span class="slider round-custom"></span>
                    </label>
                    <label for="campaign-press-mail" class="font-weight-bold pl-2">Nhập email</label>
                    <textarea class="form-control d-none" rows="5" placeholder="Mail ngăn cách nhau bởi dấu ;" id="campaign-to" name="to"></textarea>
                    <div class="mt-2" id="campaign-to-types-container">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="campaign-to-customer" name="campaign_to_types[]" value="customer">
                            <label class="form-check-label" for="campaign-to-customer">Khách hàng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="campaign-to-customer-subscribe" name="campaign_to_types[]" value="subscribe">
                            <label class="form-check-label" for="campaign-to-customer-subscribe">Khách hàng subscribe</label>
                        </div>
                    </div>
                    <x-custom-error field="to"/>
                    <x-custom-error field="campaign_to_types"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="editor_content" class="col-sm-2 text-right font-weight-bold">
                    Nội dung email <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <textarea id="editor_content" name="body" rows="30"
                        class="{{$errors->has('body') ? 'invalid-border' : ''}}">{!!  old('body') ?? '' !!}</textarea>
                    <x-custom-error field="body"/>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.campaigns.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/admin/products/tinymce.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/campaigns/add.js')}}"></script>
@endsection