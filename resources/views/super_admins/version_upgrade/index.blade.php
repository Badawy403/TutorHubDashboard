@extends('super_admins.layouts.master')

@section('title')
    {{ $heading }}
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ $heading }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> {{ $heading }} </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <h5>Current Version:</h5>
                            <p>{{ $application_current_version->value ?? "1.0.0" }}</p>
                            <form method="POST" action="{{ route('super_admin.version_upgrade.upgrade') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="InputImage">Choose Zip File</label>
                                    <input type="file" name="zip_file"  accept=".zip"
                                        class="custom-file-input @if ($errors->has('zip_file')) is-invalid @endif" id="InputImage"
                                        placeholder="Select image" aria-describedby="FileError" aria-invalid="true">
                                    <span id="FileError" class="error invalid-feedback">
                                        @if ($errors->has('zip_file'))
                                            {{ $errors->first('zip_file') }}
                                        @endif
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload & Upgrade</button>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    @include('super_admins.includes.datatable_scripts')
@endsection
