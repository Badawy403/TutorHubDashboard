@extends('super_admins.layouts.master')

@section('title')
    Edit Currency
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
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.currencies.index') }}">
                                Currencies</a></li>
                        <li class="breadcrumb-item active">
                            Edit Currency
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
                                Edit Currency
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST"
                            action="{{ route('super_admin.currencies.update', ['currency' => $currency->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputFirstName">Name</label>
                                        <input type="text" name="name"  value="{{ $currency->name }}"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            id="InputFirstName" placeholder="Please Enter" aria-describedby="FirstNameError"
                                            aria-invalid="true">
                                        <span id="FirstNameError" class="error invalid-feedback">
                                            @if ($errors->has('name'))
                                                {{ $errors->first('name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Select Code</label>
                                        <select class="form-control  selectpicker currency-change" data-live-search="true"
                                            name="code">
                                            <option selected>Select Currency</option>
                                            @foreach ($currency_codes as $key => $curr)
                                            <option value="{{$curr->code}}" @if ($currency->code == $curr->code) selected @endif>{{$curr->code}}</option>
                                            @endforeach
                                        </select>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('code'))
                                                {{ $errors->first('code') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Select Symbol</label>
                                        <select class="form-control  selectpicker currency-change" data-live-search="true"
                                            name="symbol">
                                            <option selected>Select Currency</option>
                                            @foreach ($currency_codes as $key => $curr)
                                            <option value="{{$curr->symbol}}" @if ($currency->symbol == $curr->symbol) selected @endif>{{$curr->symbol}}</option>
                                            @endforeach
                                        </select>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('symbol'))
                                                {{ $errors->first('symbol') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Select Direction</label>
                                        <select class="form-control  selectpicker currency-change" data-live-search="true"
                                            name="direction">
                                            <option selected>Select Currency</option>
                                            <option value="ltr" @if ($currency->direction == 'ltr') selected @endif>Left to Right (LTR)</option>
                                            <option value="rtl" @if ($currency->direction == 'rtl') selected @endif>Right to Left (RTL)</option>

                                        </select>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('direction'))
                                                {{ $errors->first('direction') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Decimal Places</label>
                                        <input type="text" name="decimal_places"
                                            value="{{$currency->decimal_places}}"
                                            class="form-control @if ($errors->has('decimal_places')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('decimal_places'))
                                                {{ $errors->first('decimal_places') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Value</label>
                                        <input type="text" name="value"
                                            value="{{$currency->value}}"
                                            class="form-control @if ($errors->has('value')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('value'))
                                                {{ $errors->first('value') }}
                                            @endif
                                        </span>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-6">
                                    <div class="form-group mb-0">
                                        <label for="is_default">Default</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_default" value="1"
                                                @if ($currency->is_default) checked @endif class="custom-control-input"
                                                id="is_default" aria-describedby="IsDefaultError" aria-invalid="true">
                                            <label class="custom-control-label" for="is_default">Select Currency To Be
                                                Default
                                                Or Not</label>
                                        </div>
                                        <span id="IsDefaultError" class="error invalid-feedback">
                                            @if ($errors->has('is_default'))
                                                {{ $errors->first('is_default') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0">
                                        <label for="is_active">Active</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1"
                                                @if ($currency->is_active) checked @endif class="custom-control-input"
                                                id="is_active" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="is_active">Select Currency To Be
                                                Active
                                                Or Not</label>
                                        </div>
                                        <span id="IsActiveError" class="error invalid-feedback">
                                            @if ($errors->has('is_active'))
                                                {{ $errors->first('is_active') }}
                                            @endif
                                        </span>
                                    </div>
                                </div> --}}

                            <br>
                            <div class="col-12">

                            <button type="submit" class="btn btn-primary px-3 py-1 rounded-2">Update</button>
                            </div>
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


    @include('super_admins.includes.image_cropper_scripts')
@endsection
