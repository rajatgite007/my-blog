@extends('layouts.master')
@section('title') Post @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Post @endslot
        @slot('title') Post @endslot
    @endcomponent

    <form action="{{ route('admin.post.store') }}" method="post" class="row" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <a class="btn btn-outline-warning"><i class="ri-delete-back-2-line"></i>Cancel</a>
                    <button type="submit" class="btn btn-outline-success"><i class="ri-save-line"></i>Submit</button>
                </div><!-- end card header -->

                <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-4">
                        <label class="form-label">Title</label>
                    </div>
                    <div class="col-md-12 col-sm-8">
                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-4">
                        <label class="form-label">Description</label>
                    </div>
                    <div class="col-md-12 col-sm-8">
                        <textarea name="description" id="editor1" rows="10" cols="80"> {{ old('description') }} </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Categories</label>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <select class="form-control select2" name="category[]" multiple>
                            <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('category') == $category->category_id ? 'selected' :'' }}>{{ $category->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Tags</label>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <select class="form-control select2" name="tag[]" multiple>
                            <option value="">Select Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->tag_id }}" {{ old('tag') == $tag->tag_id ? 'selected' :'' }}>{{ $tag->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-12 text-start">
                        <label class="form-label">Post Image</label>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <input type="file" accept="image/*"  id="post_img" name="post_img" value="{{ old('post_img') }}" placeholder="Select Post Image" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Scheduled At</label>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <input type="time" name="time" value="{{ date('H:i') }}" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-outline-warning"><i class="ri-delete-back-2-line"></i> @lang('translation.cancel')</a>
                        <button type="submit" class="btn btn-outline-success"><i class="ri-save-line"></i> @lang('translation.save')</button>
                    </div>
                </div>
                <!-- end card-footer -->

            </div><!-- end card -->
        </div>
        <!-- end col -->
    </form>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">
    CKEDITOR.replace('editor1',{
        filebrowserUploadUrl: "{{route('upload_image', ['_token' => csrf_token() ])}}&CKEditor=editor1&CKEditorFuncNum=1",
        filebrowserUploadMethod: 'form'
    });

    jQuery( document ).ready( function() {
        jQuery("select[name='category[]']").select2({
            placeholder: "Please Select Category"
        });

        jQuery("select[name='tag[]']").select2({
            placeholder: "Please Select Tags"
        });
    } )
</script>

@endsection
