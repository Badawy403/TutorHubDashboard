@extends('super_admins.layouts.login')

@section('title')
Login
@endsection
@php
    $dark_site_logo = App\Models\GeneralSetting::where('name' , 'dark_logo')->first();
    $user = auth()->user();
    $general_settings = generalSettings();
@endphp
@section('content')
<div class="login-box">

    <!-- /.login-logo -->
    <div class="card overflow-hidden">
        <div class="row">
            <div class="col-md-5 pr-0">
                <div class="card-header h-100 p-0">
                    <div class="h-100 bg-secondary d-flex align-items-center justify-content-center p-3">
                        <div class="text-center">
                        <img width="80" class="mb-3" src="{{ $dark_site_logo && $dark_site_logo->value ? asset($dark_site_logo->value) : asset('images/logo.png')  }}"  alt="auth logo">
                        <h4 class="mb-0 fw-bold text-white">Signin to Your Account</h4>
                        <p class="text-white">Signin to create, discover and connect with the education community</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 pl-0">
                <div class="card-body">
                    <h4 class="mb-0 fw-bold">Signin to Your Account</h4>
                    <p>Signin to create, discover and connect with the education community</p>

                    <form action="{{ route('super_admin.submit_login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required placeholder="Email">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required placeholder="Password">

                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>

                    </form>

                    <div class="mt-4">
                        <a href="#forgot">Forgot password ?</a>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- /.card -->


</div>
@endsection
