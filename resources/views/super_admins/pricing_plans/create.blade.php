@extends('super_admins.layouts.master')

@section('title')
Add Pricing Plans
@endsection
@php
    $currency_symbol = App\Models\GeneralSetting::where('name' , 'currency_symbol')->first();
@endphp
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
                <h2 class="main-content-title fw-bold mb-0">Pricing Plan</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.pricing_plans.index') }}">Pricing Plans</a></li>
                    <li class="breadcrumb-item active">
                        Add Pricing Plan
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
                    <form id="quickForm" method="POST" action="{{ route('super_admin.pricing_plans.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Select Type :</label>
                                        <select id="pricing_plan-type" aria-describedby="TypeError" aria-invalid="true" class="form-control curr-sym @if ($errors->has('type')) is-invalid @endif" name="type">
                                            <option value="teacher" {{ old('type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="academy" {{ old('type') == 'academy' ? 'selected' : '' }}>Academy</option>
                                        </select>
                                        <span id="TypeError" class="error invalid-feedback">
                                            @if ($errors->has('type'))
                                            {{ $errors->first('type') }}
                                            @endif
                                        </span>
                                    </div>

                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputIsPaid">Is Paid ?</label>
                                        <select id="pricing_plan-is_paid" aria-describedby="IsPaidError" aria-invalid="true" class="form-control curr-sym @if ($errors->has('is_paid')) is-invalid @endif" name="is_paid">
                                            <option value="0" {{ old('is_paid') == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        <span id="IsPaidError" class="error invalid-feedback">
                                            @if ($errors->has('is_paid'))
                                            {{ $errors->first('is_paid') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @if ($errors->has('name')) is-invalid @endif" id="InputName" placeholder="Enter Name" aria-describedby="NameError" aria-invalid="true">
                                        <span id="NameError" class="error invalid-feedback">
                                            @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputTagLine">Tag Line</label>
                                        <input type="text" name="tagline" value="{{ old('tagline') }}" class="form-control @if ($errors->has('tagline')) is-invalid @endif" id="InputTagLine" placeholder="Enter Tag Line" aria-describedby="TagLineError" aria-invalid="true">
                                        <span id="TagLineError" class="error invalid-feedback">
                                            @if ($errors->has('tagline'))
                                            {{ $errors->first('tagline') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">

                                        <label for="InputColor">Color</label>
                                        <input type="color" name="color" value="{{ old('color') }}" class="form-control @if ($errors->has('color')) is-invalid @endif" id="InputColor" placeholder="Enter COlor" aria-describedby="ColorError" aria-invalid="true">
                                        <span id="ColorError" class="error invalid-feedback">
                                            @if ($errors->has('color'))
                                            {{ $errors->first('color') }}
                                            @endif
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputPrice">Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">{{ $currency_symbol && $currency_symbol->value ? $currency_symbol->value : '' }}</span>
                                            <input type="number" name="price" value="{{ old('price') }}" class="form-control @if ($errors->has('price')) is-invalid @endif" id="InputPrice" placeholder="Enter Price" aria-describedby="PriceError" aria-invalid="true">
                                            <span id="PriceError" class="error invalid-feedback">
                                                @if ($errors->has('price'))
                                                {{ $errors->first('price') }}
                                                @endif
                                            </span>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputDescription">Description</label>
                                        <textarea name="description" id="discription_editor" class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" cols="4" placeholder="Enter Description" aria-describedby="DescriptionError" aria-invalid="true">{{ old('description') }}</textarea>
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
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group ">
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if (old('is_active')) checked @endif class="custom-control-input" id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select
                                                Pricing Plan To Be Active
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
                                    <div id="teacher-modules" class="form-group">
                                        <label for="InputName">Teacher Modules</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check p-0 mb-2 d-flex align-items-center">
                                                    <input type="checkbox" id="teacher-check-all" class="mr-2" />
                                                    <label class="form-check-label" for="teacher-check-all">
                                                    Select All</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @foreach($teacher_modules as $module)
                                            <div class="col-md-4 mb-2 d-flex align-items-center">
                                                <input type="checkbox" name="teacher_modules[]" id="teacher_modules_{{$loop->index}}" class="mr-2 teacher_modules" value="{{ $module->module_code }}">


                                                <label class="form-check-label" for="teacher_modules_{{$loop->index}}">
                                                {{ $module->display_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="academy-modules" class="form-group">
                                        <label for="InputName">Academy Modules</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check p-0 mb-2 d-flex align-items-center">
                                                    <input type="checkbox" id="academy-check-all" class="mr-2" />
                                                    <label class="form-check-label" for="academy-check-all">Select All</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @foreach($academy_modules as $module)
                                            <div class="col-md-4 mb-2 d-flex align-items-center">
                                                <input type="checkbox" name="academy_modules[]" id="academy_modules_{{$loop->index}}" class="mr-2 academy_modules" value="{{ $module->module_code }}">
                                                <label class="form-check-label" for="academy_modules_{{$loop->index}}">
                                                {{ $module->display_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-3 py-1">Submit</button>
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
        hideShowModules()
    });
</script>
<script>
    $("#teacher-check-all").click(function() {
        $('.teacher_modules').prop('checked', this.checked);
    });

    $("#academy-check-all").click(function() {
        $('.academy_modules').prop('checked', this.checked);
    });

    $("#pricing_plan-type").change(function() {
        console.log('in')
        hideShowModules()
    });

    function hideShowModules() {
        var pricing_plan_type = $('#pricing_plan-type').find(":selected").val();
        if (pricing_plan_type == 'teacher') {
            $('#teacher-modules').show();
            $('#academy-modules').hide();
        }
        if (pricing_plan_type == 'academy') {
            $('#teacher-modules').hide();
            $('#academy-modules').show();
        }
    }
</script>

@include('super_admins.includes.image_cropper_scripts')


@endsection
