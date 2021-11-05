@extends('admin.layout.default')

@section('title', 'Sửa bài viết')

@section('breadcrumb')
{{renderBreadcrumb('Sửa bài viết', [
        ['name' => 'Trang chủ', 'link' => '/'],
        ['name' => 'Danh sách bài viết', 'link' => route('admin.news.index')]
    ])}}
@endsection

@section('content')
<form id="news-frm" method="POST" action="{{route('admin.news.update', ['news' => $news->id])}}">
@method('PUT')
    @csrf
    <input type="hidden" name="id" value="{{$news->id}}" />
    <div class="row">
        <div class="col-12 bg-white py-2">
            <div class="form-group row">
                <label for="news-title" class="col-sm-2 text-right font-weight-bold">
                    Tiêu đề <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <input name="title" type="text" value="{{old('title', $news->title) ?? ''}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="news-title" />
                    <x-custom-error field="title" />
                </div>
            </div>

            <div class="form-group row">
                <label for="news-description" class="col-sm-2 text-right font-weight-bold">Mô tả</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="news-description" rows="5" name="description">{!! old('description', $news->description) ?? '' !!}</textarea>
                    <x-custom-error field="description" />
                </div>
            </div>

            <div class="form-group row">
                <label for="news-tags" class="col-sm-2 text-right font-weight-bold">Tags</label>
                <div class="col-sm-10">
                    <select id="news-tags-multiple" class="custom-select custom-select-2 mr-sm-2 select-tags" name="tags[]" multiple="multiple">
                    @if(isset($tags))
                            @foreach($tags as $tag)
                                <option
                                    value="{{$tag->id}}" {{in_array($tag->id, old('tags') ?? $news->tags->pluck('id')->toArray()) ? 'selected' : ''}}>{{$tag->label}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="news-sort" class="col-sm-2 text-right font-weight-bold">Thứ tự</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                        <input name="sort" type="number" value="{{old('sort', $news->sort) ?? 0}}" class="form-control {{$errors->has('sort') ? 'is-invalid' : ''}}" id="news-sort" />
                        <x-custom-error field="sort" />
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="news-status" class="col-sm-2 text-right font-weight-bold">Trạng Thái</label>
                <div class="col-sm-10">
                    <label class="switch">
                        <input type="checkbox" name="status" value="1" id="news-status" {{(old('status') ?? $news->status) == '1' ? 'checked' : ''}}>
                        <span class="slider round-custom"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="news-description" class="col-sm-2 text-right font-weight-bold">Hình Ảnh</label>
                <div class="col-sm-10">
                    <div id="news-image">
                        <input name="image" id="image-input" value="{{old('image', $news->image) ?? ''}}" type="hidden" />
                        <img id="image-preview" src="{{old('image', $news->image) ? asset('storage'.old('image', $news->image)) : asset('assets/images/no-image.png')}}" alt="no-image" />
                        <div id="news-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="image" />
                </div>
            </div>

            <div class="form-group row">
                <label for="editor_content" class="col-sm-2 text-right font-weight-bold">
                    Nội dung chính <span class="text-danger">(*)</span>
                </label>
                <div class="col-sm-10">
                    <textarea id="editor_content" name="content" rows="30" class="{{$errors->has('content') ? 'invalid-border' : ''}}">{!!  old('content', $news->content) ?? '' !!}</textarea>
                    <x-custom-error field="content" />
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <a type="submit" class="btn btn-info mr-2" href="{{route('admin.news.index')}}">Thoát</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script type="text/javascript" src="{{asset('js/admin/news/add.js')}}"></script>
<script type="text/javascript" src="{{asset('js/admin/products/tinymce.js')}}"></script>
@endsection

@section('css')
<link type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<link type="text/css" href="{{asset('css/admin/news/add.css')}}" rel="stylesheet" />
@endsection