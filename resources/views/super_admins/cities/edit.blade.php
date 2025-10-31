@extends('super_admins.layouts.master')

@section('title')
Edit City
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
                <h2 class="main-content-title fw-bold mb-0">City</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.cities.index') }}">Cities</a></li>
                    <li class="breadcrumb-item active">
                        Edit City
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
                    <form id="quickForm" method="POST" action="{{ route('super_admin.cities.update', ['city' => $city->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                @if (isset($states))
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Select Country :</label>
                                        <select required aria-describedby="CountryError" aria-invalid="true" id="countries_drop_down" class="form-control curr-sym @if ($errors->has('country_id')) is-invalid @endif" name="country_id">
                                            @if (count($countries) > 0)
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ $city->country_id == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option value="">No Country Exists</option>
                                            @endif
                                        </select>
                                        <span id="CountryError" class="error invalid-feedback">
                                            @if ($errors->has('country_id'))
                                            {{ $errors->first('country_id') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @endif
                                @if (isset($states))
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Select State :</label>
                                        <select aria-describedby="StateError" aria-invalid="true" id="states_drop_down" class="form-control curr-sym @if ($errors->has('state_id')) is-invalid @endif" name="state_id">

                                            @if (count($states) > 0)
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}" {{ $city->state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option value="">No State Exists</option>
                                            @endif
                                        </select>
                                        <span id="StateError" class="error invalid-feedback">
                                            @if ($errors->has('state_id'))
                                            {{ $errors->first('state_id') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @endif
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Name</label>
                                        <input required type="text" name="name" value="{{ $city->name }}" class="form-control @if ($errors->has('name')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
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
                                        <textarea name="description" id="discription_editor" class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError" aria-invalid="true">{{ $city->description }}</textarea>
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
                                        @if ($city->image)
                                        <div class="custom-file-preview">
                                            <img src="{{ url($city->image) }}" width="75px" height="75px" alt="{{ $city->name }}">
                                        </div>
                                        @else
                                        <div class="custom-file-preview">
                                            -- No Image Selected
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputLongitude">Longitude</label>
                                        <input type="text" name="longitude" value="{{ $city->longitude }}" class="form-control @if ($errors->has('longitude')) is-invalid @endif" id="InputLongitude" placeholder="Please Enter" aria-describedby="LongitudeError" aria-invalid="true">
                                        <span id="LongitudeError" class="error invalid-feedback">
                                            @if ($errors->has('longitude'))
                                            {{ $errors->first('longitude') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputLatitude">Latitude</label>
                                        <input type="text" name="latitude" value="{{ $city->latitude }}" class="form-control @if ($errors->has('latitude')) is-invalid @endif" id="InputLatitude" placeholder="Please Enter" aria-describedby="LatitudeError" aria-invalid="true">
                                        <span id="LatitudeError" class="error invalid-feedback">
                                            @if ($errors->has('latitude'))
                                            {{ $errors->first('latitude') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if ($city->is_active) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select City To Be
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
    $(document).ready(function() {
        $('#countries_drop_down').on('change', function() {
            statesData()
        })

        function statesData() {
            var country_id = $('#countries_drop_down').val();
            var state_id = "{{ $city->state_id }}"
            $.ajax({
                url: "{{ route('super_admin.getStatesByCountry') }}",
                type: "GET",
                data: {
                    country_id: country_id
                },
                dataType: "json",
                success: function(data) {
                    if (data && data.states) {
                        $('#states_drop_down').empty();
                        $('#states_drop_down').append('<option>Select State</option>');
                        $.each(data.states, function(key, state) {
                            if (state_id == state.id) {
                                var option = '<option value="' + state.id + '" selected>' +
                                    state.email + '</option>'
                            } else {
                                var option = '<option value="' + state.id + '">' + state
                                    .name + '</option>'
                            }

                            $('#states_drop_down').append(option);
                        });
                    } else {
                        $('#states_drop_down').empty();
                        $('#states_drop_down').append('<option>No State Exists</option>');
                    }
                }
            });
        }
    });
</script>
@include('super_admins.includes.image_cropper_scripts')
@endsection