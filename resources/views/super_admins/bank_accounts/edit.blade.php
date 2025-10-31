@extends('super_admins.layouts.master')

@section('title')
    Edit Bank Account
@endsection
@php
    $currency_symbol = App\Models\GeneralSetting::where('name', 'currency_symbol')->first();
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
            <div class="row mb-4 pt-4 pt-lg-0">

                <div class="col-sm-6">
                    <h2 class="main-content-title fw-bold mb-0">Bank Account</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.bank_accounts.index') }}">Bank Account</a></li>
                        <li class="breadcrumb-item active">
                            Edit Bank Account
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

                        <form id="quickForm" method="POST"
                        action="{{ route('super_admin.bank_accounts.update', ['bank_account' => $bank_account->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="InputName">Bank Name</label>
                                                <input type="text" name="name" value="{{ $bank_account->name }}" class="form-control @if ($errors->has('name')) is-invalid @endif" id="InputName" placeholder="Enter Bank Name" aria-describedby="NameError" aria-invalid="true">
                                                <span id="NameError" class="error invalid-feedback">
                                                    @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                    @endif
                                                </span>
                                            </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Account Holder Name</label>
                                            <input type="text" name="account_holder_name" value="{{ $bank_account->account_holder_name }}" class="form-control @if ($errors->has('account_holder_name')) is-invalid @endif" id="InputName" placeholder="Enter Account Holder Name" aria-describedby="NameError" aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('account_holder_name'))
                                                {{ $errors->first('account_holder_name') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Account Number</label>
                                            <input type="text" name="account_number" value="{{ $bank_account->account_number }}" class="form-control @if ($errors->has('account_number')) is-invalid @endif" id="InputName" placeholder="Enter Account Number" aria-describedby="NameError" aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('account_number'))
                                                {{ $errors->first('account_number') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">IBAN Number</label>
                                            <input type="text" name="iban_number" value="{{ $bank_account->iban_number }}" class="form-control @if ($errors->has('iban_number')) is-invalid @endif" id="InputName" placeholder="Enter IBAN Number" aria-describedby="NameError" aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('iban_number'))
                                                {{ $errors->first('iban_number') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">BIC Number</label>
                                            <input type="text" name="bic_swift" value="{{ $bank_account->bic_swift }}" class="form-control @if ($errors->has('bic_swift')) is-invalid @endif" id="InputName" placeholder="Enter IBAN Number" aria-describedby="NameError" aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('bic_swift'))
                                                {{ $errors->first('bic_swift') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 col-lg-4">
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
                                    </div> --}}
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
                                        <div class="form-group ">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1" @if (old('is_active')) checked @endif class="custom-control-input" id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select
                                                    Bank Account To Be Active
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
                        <!-- form start -->

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
            hideShowModules();
        });
    </script>

    @include('super_admins.includes.image_cropper_scripts')
@endsection
