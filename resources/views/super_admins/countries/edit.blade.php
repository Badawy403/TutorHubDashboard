@extends('super_admins.layouts.master')

@section('title')
Edit Country
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
                <h2 class="main-content-title fw-bold mb-0">Country</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.countries.index') }}">Countries</a></li>
                    <li class="breadcrumb-item active">
                        Edit Country
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
                    <form id="quickForm" method="POST" action="{{ route('super_admin.countries.update', ['country' => $country->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Name</label>
                                        <input required type="text" name="name" value="{{ $country->name }}" class="form-control @if ($errors->has('name')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
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
                                        <textarea name="description" id="discription_editor" class="form-control @if ($errors->has('description')) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError" aria-invalid="true">{{ $country->description }}</textarea>
                                        <span id="DescriptionError" class="error invalid-feedback">
                                            @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputLongitude">Longitude</label>
                                        <input type="text" name="longitude" value="{{ $country->longitude }}" class="form-control @if ($errors->has('longitude')) is-invalid @endif" id="InputLongitude" placeholder="Please Enter" aria-describedby="LongitudeError" aria-invalid="true">
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
                                        <input type="text" name="latitude" value="{{ $country->latitude }}" class="form-control @if ($errors->has('latitude')) is-invalid @endif" id="InputLatitude" placeholder="Please Enter" aria-describedby="LatitudeError" aria-invalid="true">
                                        <span id="LatitudeError" class="error invalid-feedback">
                                            @if ($errors->has('latitude'))
                                            {{ $errors->first('latitude') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputCapital">Capital</label>
                                        <input type="text" name="capital" value="{{ $country->capital }}" class="form-control @if ($errors->has('capital')) is-invalid @endif" id="InputCapital" placeholder="Please Enter" aria-describedby="CapitalError" aria-invalid="true">
                                        <span id="CapitalError" class="error invalid-feedback">
                                            @if ($errors->has('capital'))
                                            {{ $errors->first('capital') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputCurrency">Currency</label>
                                        <input type="text" name="currency" value="{{ $country->currency }}" class="form-control @if ($errors->has('currency')) is-invalid @endif" id="InputCurrency" placeholder="Please Enter" aria-describedby="CurrencyError" aria-invalid="true">
                                        <span id="CurrencyError" class="error invalid-feedback">
                                            @if ($errors->has('currency'))
                                            {{ $errors->first('currency') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputCurrencySymbol">Currency Symbol</label>
                                        <input type="text" name="currency_symbol" value="{{ $country->currency_symbol }}" class="form-control @if ($errors->has('currency_symbol')) is-invalid @endif" id="InputCurrencySymbol" placeholder="Please Enter" aria-describedby="CurrencySymbolError" aria-invalid="true">
                                        <span id="CurrencySymbolError" class="error invalid-feedback">
                                            @if ($errors->has('currency_symbol'))
                                            {{ $errors->first('currency_symbol') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputRegion">Region</label>
                                        <input type="text" name="region" value="{{ $country->region }}" class="form-control @if ($errors->has('region')) is-invalid @endif" id="InputRegion" placeholder="Please Enter" aria-describedby="RegionError" aria-invalid="true">
                                        <span id="RegionError" class="error invalid-feedback">
                                            @if ($errors->has('region'))
                                            {{ $errors->first('region') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputSubRegion">Sub Region</label>
                                        <input type="text" name="sub_region" value="{{ $country->sub_region }}" class="form-control @if ($errors->has('sub_region')) is-invalid @endif" id="InputSubRegion" placeholder="Please Enter" aria-describedby="SubRegionError" aria-invalid="true">
                                        <span id="SubRegionError" class="error invalid-feedback">
                                            @if ($errors->has('sub_region'))
                                            {{ $errors->first('sub_region') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputPhoneCode">Phone Code</label>
                                        <input type="number" name="phone_code" value="{{ $country->phone_code }}" class="form-control @if ($errors->has('phone_code')) is-invalid @endif" id="InputPhoneCode" placeholder="Please Enter" aria-describedby="PhoneCodeError" aria-invalid="true">
                                        <span id="PhoneCodeError" class="error invalid-feedback">
                                            @if ($errors->has('phone_code'))
                                            {{ $errors->first('phone_code') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputNative">Native</label>
                                        <input type="text" name="native" value="{{ $country->native }}" class="form-control @if ($errors->has('native')) is-invalid @endif" id="InputNative" placeholder="Please Enter" aria-describedby="NativeError" aria-invalid="true">
                                        <span id="NativeError" class="error invalid-feedback">
                                            @if ($errors->has('native'))
                                            {{ $errors->first('native') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputIsoCode2">Iso Code 2</label>
                                        <input type="text" name="iso_code_2" value="{{ $country->iso_code_2 }}" class="form-control @if ($errors->has('iso_code_2')) is-invalid @endif" id="InputIsoCode2" placeholder="Please Enter" aria-describedby="IsoCode2Error" aria-invalid="true">
                                        <span id="IsoCode2Error" class="error invalid-feedback">
                                            @if ($errors->has('iso_code_2'))
                                            {{ $errors->first('iso_code_2') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputIsoCode3">Iso Code 3</label>
                                        <input type="text" name="iso_code_3" value="{{ $country->iso_code_3 }}" class="form-control @if ($errors->has('iso_code_3')) is-invalid @endif" id="InputIsoCode3" placeholder="Please Enter" aria-describedby="IsoCode2Error" aria-invalid="true">
                                        <span id="IsoCode2Error" class="error invalid-feedback">
                                            @if ($errors->has('iso_code_3'))
                                            {{ $errors->first('iso_code_3') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputEmoji">Emoji</label>
                                        <input type="text" name="emoji" value="{{ $country->emoji }}" class="form-control @if ($errors->has('emoji')) is-invalid @endif" id="InputEmoji" placeholder="Please Enter" aria-describedby="EmojiError" aria-invalid="true">
                                        <span id="EmojiError" class="error invalid-feedback">
                                            @if ($errors->has('emoji'))
                                            {{ $errors->first('emoji') }}
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
                                        @if ($country->image)
                                        <div class="custom-file-preview">
                                            <img src="{{ url($country->image) }}" width="75px" height="75px" alt="{{ $country->name }}">
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
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if ($country->is_active) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select Country To Be
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