@extends('super_admins.layouts.master')

@section('title')
    Edit Event
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
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.events.index') }}">
                                Events</a></li>
                        <li class="breadcrumb-item active">
                            Edit Event
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
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Event
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST"
                            action="{{ route('super_admin.events.update', ['event' => $event->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if (isset($pricing_plans))
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="InputName">Select Subscription :</label>
                                        <select aria-describedby="SubscriptionError" aria-invalid="true"
                                            id="pricing_plans_drop_down"
                                            class="form-control curr-sym @if ($errors->has('pricing_plan_id')) is-invalid @endif"
                                            name="pricing_plan_id">
                                            @if (count($pricing_plans) > 0)
                                                <option value="">Select Subscription</option>
                                                @foreach ($pricing_plans as $pricing_plan)
                                                    <option value="{{ $pricing_plan->id }}"
                                                        {{ $event->pricing_plan_id == $pricing_plan->id ? 'selected' : '' }}>
                                                        {{ $pricing_plan->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No Subscription Exists</option>
                                            @endif
                                        </select>
                                        <span id="SubscriptionError" class="error invalid-feedback">
                                            @if ($errors->has('pricing_plan_id'))
                                                {{ $errors->first('pricing_plan_id') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            @endif
                                <div class="form-group">
                                    <label for="InputFirstName">First Name</label>
                                    <input type="text" name="first_name" value="{{ $event->first_name }}"
                                        class="form-control @if ($errors->has('first_name')) is-invalid @endif"
                                        id="InputFirstName" placeholder="Please Enter" aria-describedby="FirstNameError"
                                        aria-invalid="true">
                                    <span id="FirstNameError" class="error invalid-feedback">
                                        @if ($errors->has('first_name'))
                                            {{ $errors->first('first_name') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="InputLastName">Last Name</label>
                                    <input type="text" name="last_name" value="{{ $event->last_name }}"
                                        class="form-control @if ($errors->has('last_name')) is-invalid @endif"
                                        id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                        aria-invalid="true">
                                    <span id="LastNameError" class="error invalid-feedback">
                                        @if ($errors->has('last_name'))
                                            {{ $errors->first('last_name') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="InputUserName">User Name</label>
                                    <input type="text" name="user_name" value="{{ $event->user_name }}"
                                        class="form-control @if ($errors->has('user_name')) is-invalid @endif"
                                        id="InputUserName" placeholder="Please Enter" aria-describedby="UserNameError"
                                        aria-invalid="true">
                                    <span id="UserNameError" class="error invalid-feedback">
                                        @if ($errors->has('user_name'))
                                            {{ $errors->first('user_name') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="InputDescription">Description</label>
                                    <textarea name="description"
                                    {{-- id="discription_editor" --}}
                                        class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" placeholder="Please Enter"
                                        aria-describedby="DescriptionError" aria-invalid="true">{{ $event->description }}</textarea>
                                    <span id="DescriptionError" class="error invalid-feedback">
                                        @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="InputImage">Image</label>
                                    @if ($event->image)
                                        <img src="{{ url($event->image) }}" width="75px" height="75px"
                                            alt="{{ $event->name }}">
                                        &nbsp &nbsp
                                    @else
                                        -No Image Selected
                                    @endif
                                    <input type="hidden" name="image" class="image" value="">
                                    <input type="file" name="imageFile"
                                        class="form-control imageFile @if ($errors->has('image')) is-invalid @endif"
                                        id="InputImage" placeholder="Select image" aria-describedby="ImageError"
                                        aria-invalid="true">
                                    <span id="ImageError" class="error invalid-feedback">
                                        @if ($errors->has('image'))
                                            {{ $errors->first('image') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="customSwitch1">Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_active" value="1"
                                            @if ($event->is_active) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                        <label class="custom-control-label" for="customSwitch1">Select Event To Be
                                            Active
                                            Or Not</label>
                                    </div>
                                    <span id="IsActiveError" class="error invalid-feedback">
                                        {{-- @if ($errors->has('is_active'))
                                            {{ $errors->first('is_active') }}
                                        @endif --}}
                                    </span>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="customSwitch2">Featured</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_featured" value="1"
                                            @if ($event->is_featured) checked @endif class="custom-control-input"
                                            id="customSwitch2" aria-describedby="IsFeaturedError" aria-invalid="true">
                                        <label class="custom-control-label" for="customSwitch2">Select Event To Be
                                            Featured
                                            Or Not</label>
                                    </div>
                                    <span id="IsFeaturedError" class="error invalid-feedback">
                                        {{-- @if ($errors->has('is_featured'))
                                            {{ $errors->first('is_featured') }}
                                        @endif --}}
                                    </span>
                                </div>
                                <!-- /.card-body -->
                                {{-- <div class="card-footer"> --}}
                                <br>
                                <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Update</button>
                                {{-- </div> --}}
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
