@extends('super_admins.layouts.master')

@section('title')
Add Academies
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
                <h2 class="main-content-title fw-bold mb-0">Academy</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.academies.index') }}">Academies</a></li>
                    <li class="breadcrumb-item active">
                        Add Academy
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

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" method="POST" action="{{ route('super_admin.academies.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @if (isset($subscriptions))
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Select Subscription :</label>
                                        <select aria-describedby="SubscriptionError" aria-invalid="true" id="subscriptions_drop_down" class="form-control curr-sym @if ($errors->has('subscription')) is-invalid @endif" name="subscription">
                                            @if (count($subscriptions) > 0)
                                            <option value="">Select Subscription</option>
                                            @foreach ($subscriptions as $subscription)
                                            <option value="{{ $subscription->id }}" {{ old('subscription') == $subscription->id ? 'selected' : '' }}>
                                                {{ $subscription->name }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option value="">No Subscription Exists</option>
                                            @endif
                                        </select>
                                        <span id="SubscriptionError" class="error invalid-feedback">
                                            @if ($errors->has('subscription'))
                                            {{ $errors->first('subscription') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @endif
                                @if (isset($academy_categories))
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Select Academy Category :</label>
                                            <select multiple aria-describedby="BlogCategoryError" aria-invalid="true"
                                                id="faq_categories_drop_down"
                                                class="form-control curr-sym @if ($errors->has('academy_category_ids')) is-invalid @endif"
                                                name="academy_category_ids[]">
                                                @if (count($academy_categories) > 0)
                                                    <option value="">Select Academy Category</option>
                                                    @foreach ($academy_categories as $academy_category)
                                                        <option value="{{ $academy_category->id }}"
                                                            {{ old('academy_category_ids') == $academy_category->id ? 'selected' : '' }}>
                                                            {{ $academy_category->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Academy Category Exists</option>
                                                @endif
                                            </select>
                                            <span id="BlogCategoryError" class="error invalid-feedback">
                                                @if ($errors->has('academy_category_ids'))
                                                    {{ $errors->first('academy_category_ids') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputFirstName">First Name</label>
                                        <input required type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @if ($errors->has('first_name')) is-invalid @endif" id="InputFirstName" placeholder="Enter First Name" aria-describedby="FirstNameError" aria-invalid="true">
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
                                        <input required type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @if ($errors->has('last_name')) is-invalid @endif" id="InputLastName" placeholder="Enter LastName" aria-describedby="LastNameError" aria-invalid="true">
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
                                        <input required type="text" name="user_name" value="{{ old('user_name') }}" class="form-control @if ($errors->has('user_name')) is-invalid @endif" id="InputUserName" placeholder="Enter User Name" aria-describedby="UserNameError" aria-invalid="true">
                                        <span id="UserNameError" class="error invalid-feedback">
                                            @if ($errors->has('user_name'))
                                            {{ $errors->first('user_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputEmail">Email</label>
                                        <input required type="email" name="email" value="{{ old('email') }}" class="form-control @if ($errors->has('email')) is-invalid @endif" id="InputEmail" placeholder="Enter Email" aria-describedby="EmailError" aria-invalid="true">
                                        <span id="EmailError" class="error invalid-feedback">
                                            @if ($errors->has('email'))
                                            {{ $errors->first('email') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputPassword">Password</label>
                                        <input required type="text" name="password" value="{{ old('password') }}" class="form-control @if ($errors->has('password')) is-invalid @endif" id="InputPassword" placeholder="Enter Password" aria-describedby="PasswordError" aria-invalid="true">
                                        <span id="PasswordError" class="error invalid-feedback">
                                            @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputDescription">Description</label>
                                        <textarea name="description" {{-- id="discription_editor" --}} class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" cols="4" placeholder="Enter Description" aria-describedby="DescriptionError" aria-invalid="true">{{ old('description') }}</textarea>
                                        <span id="DescriptionError" class="error invalid-feedback">
                                            @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputImage">Choose Pciture</label>
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
                                    
                                    <div class="form-group">
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if (old('is_active')) checked @endif class="custom-control-input" id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select
                                                Academy To Be Active
                                                Or Not</label>
                                        </div>
                                        <span id="IsActiveError" class="error invalid-feedback">
                                            {{-- @if ($errors->has('is_active'))
                                                {{ $errors->first('is_active') }}
                                            @endif --}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="customSwitch2">Featured?</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_featured" value="1" @if (old('is_featured')) checked @endif class="custom-control-input" id="customSwitch2" aria-describedby="IsFeaturedError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch2">Select
                                                Academy To Be Featured
                                                Or Not</label>
                                        </div>
                                        <span id="IsFeaturedError" class="error invalid-feedback">
                                            {{-- @if ($errors->has('is_featured'))
                                                {{ $errors->first('is_featured') }}
                                            @endif --}}
                                        </span>
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
    });
</script>
@include('super_admins.includes.image_cropper_scripts')
@endsection