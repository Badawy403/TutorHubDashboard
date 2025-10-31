@extends('super_admins.layouts.master')

@section('title')
    Add Tutor Posts
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('content')
    @if ($errors->any())
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 pt-4 pt-lg-0">

                <div class="col-sm-6">
                    <h2 class="main-content-title fw-bold mb-0">Post</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.teachers.edit' , $teacher->id) }}">Tutor Profile</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.teacher_posts.index' , $teacher->id) }}">Tutor Blogs</a></li>
                        <li class="breadcrumb-item active">
                            Add Tutor Post
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-secondary">

                        <!-- form start -->
                        <form id="quickForm" method="POST" action="{{ route('super_admin.teacher_posts.store' , $teacher->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                            <div class="row">
                            <div class="w-100">
                                <h5>Multi Language</h5>
                                <div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($active_languages as $key => $language)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{$key == 0 ? 'active':''}} mr-1" id="nav-{{$language->code}}-tab" data-toggle="tab" data-target="#nav-{{$language->code}}" type="button" role="tab" aria-controls="nav-{{$language->code}}" aria-selected="true">{{ $language->name }}</button>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content mt-2 p-2" id="myTabContent">
                                        @foreach ($active_languages as $key => $language)
                                        <div class="tab-pane fade mb-2 {{$key == 0 ? 'show active':''}}" id="nav-{{$language->code}}" role="tabpanel" aria-labelledby="nav-{{$language->code}}-tab">
                                            <div class="form-group">
                                                <label for="InputName-{{$language->code}}">Name ({{$language->code}})</label>
                                                <input type="text" name="name[{{$language->code}}]" class="form-control @if ($errors->has('name.'.$language->code)) is-invalid @endif" id="InputName-{{$language->code}}" placeholder="Please Enter" aria-describedby="NameError-{{$language->code}}" aria-invalid="true">
                                                <span id="NameError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has('name.'.$language->code))
                                                    {{ $errors->first('name.'.$language->code) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputDescription">Description ({{$language->code}})</label>
                                                <textarea name="description[{{$language->code}}]" id="discription_editor_{{$language->code}}" class="form-control @if ($errors->has('description.'.$language->code)) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError-{{$language->code}}" aria-invalid="true"></textarea>
                                                <span id="DescriptionError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has('description.'.$language->code))
                                                    {{ $errors->first('description.'.$language->code) }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="row">
                                    @if (isset($blog_categories))
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Select Post Category :</label>
                                            <select aria-describedby="BlogCategoryError" aria-invalid="true"
                                                id="faq_categories_drop_down"
                                                class="form-control curr-sym @if ($errors->has('blog_category_id')) is-invalid @endif"
                                                name="blog_category_id">
                                                @if (count($blog_categories) > 0)
                                                    <option value="">Select Post Category</option>
                                                    @foreach ($blog_categories as $blog_category)
                                                        <option value="{{ $blog_category->id }}"
                                                            {{ old('blog_category_id') == $blog_category->id ? 'selected' : '' }}>
                                                            {{ $blog_category->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Post Category Exists</option>
                                                @endif
                                            </select>
                                            <span id="BlogCategoryError" class="error invalid-feedback">
                                                @if ($errors->has('blog_category_id'))
                                                    {{ $errors->first('blog_category_id') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                 @if (isset($tags))
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Select Post Tags :</label>
                                            <select multiple aria-describedby="TagsError" aria-invalid="true"
                                                id="faq_categories_drop_down"
                                                class="form-control curr-sym @if ($errors->has('tag_ids')) is-invalid @endif"
                                                name="tag_ids[]">
                                                @if (count($tags) > 0)
                                                    <option value="">Select Post Tags</option>
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}"
                                                            {{ old('tag_ids') == $tag->id ? 'selected' : '' }}>
                                                            {{ $tag->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Post Tag Exists</option>
                                                @endif
                                            </select>
                                            <span id="TagsError" class="error invalid-feedback">
                                                @if ($errors->has('tag_ids'))
                                                    {{ $errors->first('tag_ids') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputImage">Choose Picture</label>
                                            <input type="hidden" name="image" class="image" value="">
                                            <input type="file" name="imageFile"
                                                class="custom-file-input imageFile @if ($errors->has('image')) is-invalid @endif"
                                                id="InputImage" placeholder="Select image" aria-describedby="ImageError"
                                                aria-invalid="true">
                                            <span id="ImageError" class="error invalid-feedback">
                                                @if ($errors->has('image'))
                                                    {{ $errors->first('image') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">

                                        <div class="form-group ">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1"
                                                    @if (old('is_active')) checked @endif
                                                    class="custom-control-input" id="customSwitch1"
                                                    aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select
                                                    Post To Be Active
                                                    Or Not</label>
                                            </div>
                                            <span id="IsActiveError" class="error invalid-feedback">
                                                {{-- @if ($errors->has('is_active'))
                                                {{ $errors->first('is_active') }}
                                            @endif --}}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary px-3 py-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @include('super_admins.includes.image_cropper_modal')
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            @foreach ($active_languages as $key => $language)
                ClassicEditor.create(document.querySelector('#discription_editor_{{$language->code}}')).catch(error => { console.error(error); });
            @endforeach
        });
    </script>
      @include('super_admins.includes.image_cropper_scripts')
@endsection
