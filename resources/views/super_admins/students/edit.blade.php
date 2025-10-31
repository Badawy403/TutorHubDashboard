@extends('super_admins.layouts.master')

@section('title')
Edit Student
@endsection

@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
{{-- {{ $error }} --}}
@endforeach
@endif
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4 pt-4 pt-lg-0">
            <div class="col-sm-6">
                <h2 class="main-content-title fw-bold mb-0">Students</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.students.index') }}">Students</a></li>
                    <li class="breadcrumb-item active">
                        Edit Student
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
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-secondary">
                    
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" method="POST" action="{{ route('super_admin.students.update', ['student' => $student->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputFirstName">First Name</label>
                                        <input required type="text" name="first_name" value="{{ $student->first_name }}" class="form-control @if ($errors->has('first_name')) is-invalid @endif" id="InputFirstName" placeholder="Please Enter" aria-describedby="FirstNameError" aria-invalid="true">
                                        <span id="FirstNameError" class="error invalid-feedback">
                                            @if ($errors->has('first_name'))
                                            {{ $errors->first('first_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputLastName">Last Name</label>
                                        <input required type="text" name="last_name" value="{{ $student->last_name }}" class="form-control @if ($errors->has('last_name')) is-invalid @endif" id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError" aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('last_name'))
                                            {{ $errors->first('last_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputUserName">User Name</label>
                                        <input required type="text" name="user_name" value="{{ $student->user_name }}" class="form-control @if ($errors->has('user_name')) is-invalid @endif" id="InputUserName" placeholder="Please Enter" aria-describedby="UserNameError" aria-invalid="true">
                                        <span id="UserNameError" class="error invalid-feedback">
                                            @if ($errors->has('user_name'))
                                            {{ $errors->first('user_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputDescription">Description</label>
                                        <textarea name="description" {{-- id="discription_editor" --}} class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError" aria-invalid="true">{{ $student->description }}</textarea>
                                        <span id="DescriptionError" class="error invalid-feedback">
                                            @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputImage">Choose Picture</label>
                                        
                                        <input type="hidden" name="image" class="image" value="">
                                        <input type="file" name="imageFile" class="custom-file-input imageFile @if ($errors->has('image')) is-invalid @endif" id="InputImage" placeholder="Select image" aria-describedby="ImageError" aria-invalid="true">
                                        <span id="ImageError" class="error invalid-feedback">
                                            @if ($errors->has('image'))
                                            {{ $errors->first('image') }}
                                            @endif
                                        </span>

                                        @if ($student->image)
                                        <div class="custom-file-preview">
                                        <img src="{{ url($student->image) }}" width="75px" height="75px" alt="{{ $student->name }}">
                                        </div>
                                        @else
                                            <div class="custom-file-preview">
                                                -- No Image Selected
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if ($student->is_active) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select Student To Be
                                                Active
                                                Or Not</label>
                                        </div>
                                        <span id="IsActiveError" class="error invalid-feedback">
                                            {{-- @if ($errors->has('is_active'))
                                            {{ $errors->first('is_active') }}
                                            @endif --}}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-3 py-1">Update</button>
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