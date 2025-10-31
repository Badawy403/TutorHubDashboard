@extends('super_admins.layouts.master')

@section('title')
    Add Certifications
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
                    <h2 class="main-content-title fw-bold mb-0">Certification</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.teachers.edit' , $teacher->id) }}">Tutor Profile</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.teacher_certifications.index' , $teacher->id) }}">Tutor Certifications</a></li>
                        <li class="breadcrumb-item active">
                            Add Tutor Certification
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
                        <form id="quickForm" method="POST" action="{{ route('super_admin.teacher_certifications.store' , $teacher->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputName">Name</label>
                                            <input required type="text" name="name" value="{{ old('name') }}"
                                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Name" aria-describedby="NameError"
                                                aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputDescription">Description</label>
                                            <textarea name="description" id="discription_editor"
                                                class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" cols="4"
                                                placeholder="Enter Description" aria-describedby="DescriptionError" aria-invalid="true">{{ old('description') }}</textarea>
                                            <span id="DescriptionError" class="error invalid-feedback">
                                                @if ($errors->has('description'))
                                                    {{ $errors->first('description') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputImage">Choose File</label>
                                            <input type="hidden" name="file" class="file" value="">
                                            <input type="file" name="file"
                                                class="custom-file-input imageFile @if ($errors->has('file')) is-invalid @endif"
                                                id="InputImage" placeholder="Select file" aria-describedby="ImageError"
                                                aria-invalid="true">
                                            <span id="ImageError" class="error invalid-feedback">
                                                @if ($errors->has('file'))
                                                    {{ $errors->first('file') }}
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
                                                    Certificate To Be Active
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
            CKEDITOR.replace('discription_editor');
        });
    </script>
      @include('super_admins.includes.image_cropper_scripts')
@endsection
