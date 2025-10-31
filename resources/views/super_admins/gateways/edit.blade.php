@extends('super_admins.layouts.master')

@section('title')
    Edit Gateway
@endsection
@php
    $default_currency = App\Models\Currency::where('is_default' , 1)->first();
@endphp
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
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.gateways.index') }}">
                                Gateways</a></li>
                        <li class="breadcrumb-item active">
                            Edit Gateway
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
                                Edit Gateway
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST"
                            action="{{ route('super_admin.gateways.update', ['gateway' => $gateway->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputFirstName">Name</label>
                                        <input type="text" name="name" disabled value="{{ $gateway->name }}"
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
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Code</label>
                                        <input type="text" name="code" disabled value="{{ $gateway->code }}"
                                            class="form-control @if ($errors->has('code')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('code'))
                                                {{ $errors->first('code') }}
                                            @endif
                                        </span>
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Currency</label>
                                        <select class="form-control  selectpicker currency-change" data-live-search="true"
                                            name="currency" >
                                            <option selected>Select Currency</option>
                                            @foreach ($gateway->currencies as $key => $currency)
                                                @foreach ($currency as $curKey => $singleCurrency)
                                                    <option value="{{ $curKey }}"
                                                        {{ old('currency', $gateway->currency) == $curKey ? 'selected' : '' }}
                                                        data-fiat="{{ $key }}">{{ $curKey }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('currency'))
                                                {{ $errors->first('currency') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Currency Symbol</label>
                                        <input type="text" name="symbol" value="{{ $gateway->symbol }}"
                                            class="form-control @if ($errors->has('symbol')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('symbol'))
                                                {{ $errors->first('symbol') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Convention Rate</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    1 {{ $default_currency->symbol ?: 'USD' }} =
                                                </div>
                                            </div>
                                            <input type="text" class="form-control " name="convention_rate"
                                                value="{{ $gateway->convention_rate }}" required="">
                                            <div class="input-group-append">
                                                <div class="input-group-text set-currency">

                                                </div>
                                            </div>
                                        </div>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('convention_rate'))
                                                {{ $errors->first('convention_rate') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Minimum Deposit Amount</label>
                                        <input type="text" name="min_amount"
                                            value="{{ round($gateway->min_amount, 2) }}"
                                            class="form-control @if ($errors->has('min_amount')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('min_amount'))
                                                {{ $errors->first('min_amount') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Maximum Deposit Amount</label>
                                        <input type="text" name="max_amount"
                                            value="{{ round($gateway->max_amount, 2) }}"
                                            class="form-control @if ($errors->has('max_amount')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter"
                                            aria-describedby="LastNameError" aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('max_amount'))
                                                {{ $errors->first('max_amount') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Percentage Charge</label>
                                        <input type="text" name="percentage_charge"
                                            value="{{ round($gateway->percentage_charge, 2) }}"
                                            class="form-control @if ($errors->has('percentage_charge')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter"
                                            aria-describedby="LastNameError" aria-invalid="true">
                                        <span id="LastNameError" class="error text-danger">
                                            @if ($errors->has('percentage_charge'))
                                                {{ $errors->first('percentage_charge') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Fixed Charge</label>
                                        <input type="text" name="fixed_charge"
                                            value="{{ round($gateway->fixed_charge, 2) }}"
                                            class="form-control @if ($errors->has('fixed_charge')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter"
                                            aria-describedby="LastNameError" aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('fixed_charge'))
                                                {{ $errors->first('fixed_charge') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    @foreach ($gateway->parameters as $key => $parameter)
                                        <div class="form-group  col-md-6 col-6">
                                            <label
                                                for="{{ $key }}">{{ strtoupper(str_replace('_', ' ', $key)) }}</label>
                                            <input type="text" name="{{ $key }}"
                                                value="{{ old($key, $parameter) }}" class="form-control "
                                                id="{{ $key }}">
                                            <div class="invalid-feedback error">
                                                Please fill in the {{ str_replace('_', ' ', $key) }}
                                            </div>
                                            @if ($errors->has($key))
                                                <span class="text-danger error">
                                                    {{ $errors->first($key) }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @if ($gateway->extra_parameters)
                                    <div class="col-12">
                                        @foreach ($gateway->extra_parameters as $key => $param)
                                            <div class="form-group  col-md-6 col-6">
                                                <label>{{ strtoupper(str_replace('_', ' ', $key)) }}</label>
                                                <div class="input-group">
                                                    <input type="text" name="{{ $key }}"
                                                        value="{{ old($key, route($param, $gateway->code)) }}"
                                                        class="form-control" disabled>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-info copy-btn">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="row container">
                                    <div class="col-6">
                                        <div class="form-group flex-column d-flex">
                                            <label for="InputImage">Image</label>
                                            @if ($gateway->image)
                                                <img src="{{ url($gateway->image) }}" width="auto" height="auto"
                                                    alt="{{ $gateway->name }}">
                                                &nbsp &nbsp
                                            @else
                                                -No Image Selected
                                            @endif
                                            {{-- <input type="hidden" name="image" class="image" value=""> --}}
                                            <input type="file" name="image" placeholder="Select image" id="image">
                                            {{-- <input type="file" name="image"
                                                class="form-control imageFile @if ($errors->has('image')) is-invalid @endif"
                                                id="" placeholder="Select image" aria-describedby="ImageError"
                                                aria-invalid="true"> --}}
                                            <span id="ImageError" class="error invalid-feedback">
                                                @if ($errors->has('image'))
                                                    {{ $errors->first('image') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-0">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" value="1"
                                                    @if ($gateway->status) checked @endif class="custom-control-input"
                                                    id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select Gateway To Be
                                                    Active
                                                    Or Not</label>
                                            </div>
                                            <span id="IsActiveError" class="error invalid-feedback">
                                                @if ($errors->has('status'))
                                                    {{ $errors->first('status') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    </div>
                                   <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-3 py-1 rounded-3">Update</button>
                                   </div>
                                    {{-- </div> --}}
                                </form>
                            </div>
                            <br>


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
      <script>
        "use strict";

        $(document).ready(function () {
            // setCurrency();
            $(document).on('change', '.currency-change', function (){
                // setCurrency();
            });

            // function setCurrency() {
            //     let currency = $('.currency-change').val();
            //     let fiatYn = $('.currency-change option:selected').attr('data-fiat');
            //     if(fiatYn == 0){
            //         $('.set-currency').text(currency);
            //     }else{
            //         $('.set-currency').text('USD');
            //     }
            // }

            $(document).on('click', '.copy-btn', function () {
                var _this = $(this)[0];
                var copyText = $(this).parents('.input-group-append').siblings('input');
                $(copyText).prop('disabled', false);
                copyText.select();
                document.execCommand("copy");
                $(copyText).prop('disabled', true);
                $(this).text('Coppied');
                setTimeout(function () {
                    $(_this).text('');
                    $(_this).html('<i class="fas fa-copy"></i>');
                }, 500)
            });

            $('#image').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });


        });
    </script>
    @include('super_admins.includes.image_cropper_scripts')
@endsection
