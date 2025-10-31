@extends('super_admins.layouts.master')

@section('title')
    Add Independent
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Add Independent
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('super_admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('super_admin.news_categories.index')}}">Independent</a></li>
                        <li class="breadcrumb-item active">
                            Add Independent
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
                                Add Independent
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST" action="{{ route('super_admin.news_categories.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputName">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        id="InputName" placeholder="Enter Name" aria-describedby="NameError"
                                        aria-invalid="true">
                                    <span id="NameError" class="error invalid-feedback">
                                        @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="InputDescription">Description</label>
                                    <textarea name="description" id="discription_editor"
                                        class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3"
                                        placeholder="Enter Description" aria-describedby="DescriptionError" aria-invalid="true">
{{ old('description') }}

                    </textarea>
                                    <span id="DescriptionError" class="error invalid-feedback">
                                        @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                    </span>
                                </div>
                              <!--  <div class="form-group">
                                    <label for="InputImage">Image</label>
                                    <input type="file" name="images[]" multiple
                                        class="form-control @if (count($errors->get('images.*'))) is-invalid @endif
                                        @if ($errors->has('images')) is-invalid @endif"
                                        id="InputImage" placeholder="Enter images" aria-describedby="ImageError"
                                        aria-invalid="true">
                                    <span id="ImageError" class="error invalid-feedback">
                                        @if ($errors->has('images'))
                                            {{ $errors->first('images') }}
                                        @endif
                                        @if (count($errors->get('images.*')))
                                            @php
                                                $test = 1;
                                            @endphp
                                            @foreach ($errors->get('images.*') as $errors)
                                                @foreach ($errors as $error)
                                                    @if ($test == 1)
                                                        {{ $error }} <br>
                                                    @endif
                                                    @php
                                                        $test++;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </span>
                                </div> -->

                                <div class="form-group mb-0">
                                    <label for="customSwitch1">Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_active" value="1"
                                            @if (old('is_active')) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                        <label class="custom-control-label" for="customSwitch1">Select Tenant To Be Active
                                            Or Not</label>
                                    </div>
                                    <span id="IsActiveError" class="error invalid-feedback">
                                        {{-- @if ($errors->has('is_active'))
                                            {{ $errors->first('is_active') }}
                                        @endif --}}
                                    </span>
                                </div>
                                <!-- /.card-body -->
                                {{-- <div class="card-footer"> --}}
                                    <br>
                                    <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Submit</button>
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
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@endsection
