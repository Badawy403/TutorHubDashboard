@extends('super_admins.layouts.master')

@section('title')
    Commission Configuration
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@php
    $default_currency = App\Models\Currency::where('is_default', 1)->first();
@endphp
@section('content')
    @if ($errors->any())
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 pt-4 pt-lg-0">

                <div class="col-sm-6">
                    <h2 class="main-content-title fw-bold mb-0">Commission Configuration</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.commission.index') }}">Commission
                                Configuration</a></li>
                        <li class="breadcrumb-item active">
                            Update
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

                        <form id="quickForm" method="POST" action="{{ route('super_admin.commission.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    @foreach ($appointment_types as $key => $appointment_type)
                                        <div class="col-lg-4">
                                            <label for="InputFirstName">Appointment Type</label>
                                            <br>
                                            <input type="hidden" name="appointment_type_id[{{ $key }}]"
                                                value="{{ $appointment_type->id }}">
                                            {{ $appointment_type->display_name }}

                                        </div>
                                        {{-- @php
                                            dd($appointment_type->commission);
                                        @endphp --}}
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="InputFirstName">Select Commission Type</label>
                                                <select name="commission_type[{{ $key }}]" class="form-control">
                                                    <option @if ($appointment_type->commission ? $appointment_type->commission->commission_type == 'percentage' : false) selected @endif
                                                        value="percentage">Percentage</option>
                                                    <option @if ($appointment_type->commission ? $appointment_type->commission->commission_type == 'fixed_rate' : false) selected @endif
                                                        value="fixed_rate">Fixed Rate</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="InputLastName">Rate</label>
                                                <div class="input-group ">
                                                    <input required type="text" name="rate[{{ $key }}]"
                                                        value="{{ $appointment_type->commission->rate ?? 0 }}"
                                                        class="form-control @if ($errors->has('rate')) is-invalid @endif"
                                                        placeholder="Enter Rate" aria-describedby="FirstNameError"
                                                        aria-invalid="true">
                                                </div>
                                                <span id="LastNameError" class="error invalid-feedback">
                                                    @if ($errors->has('rate'))
                                                        {{ $errors->first('rate') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        {{-- @if (auth()->user()->hasPermission('commission.export')) --}}
                                            <button type="submit" class="btn btn-primary px-3 py-1">update</button>
                                        {{-- @endif --}}
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
    @include('super_admins.includes.image_cropper_scripts')
@endsection
