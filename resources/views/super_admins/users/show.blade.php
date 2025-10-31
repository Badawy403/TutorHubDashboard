@extends('super_admins.layouts.master')

@section('title')
    Edit User
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
                    <h1>
                        Edit User
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('super_admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('super_admin.users.index')}}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit User
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
                                View User
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Name :</label>
                                            <input type="text" name="user_name" value="{{ $user->user_name }}"
                                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Name" aria-describedby="NameError"
                                                aria-invalid="true" readonly>
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Email :</label>
                                            <input type="text" name="email" value="{{ $user->email }}"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                id="InputEmail" placeholder="Enter Name" aria-describedby="EmailError"
                                                aria-invalid="true" readonly>
                                            <span id="EmailError" class="error invalid-feedback">
                                                @if ($errors->has('email'))
                                                    {{ $errors->first('email') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputImage" class="w-100">Profile Image :</label>
                                            @if (isset($user->profile_image_path))
                                                <img src="{{ url($user->profile_image_path) }}" width="50px" height="50px"
                                                    alt="Profile Image" style="object-fit: cover;" class="rounded">
                                            @else
                                            <img src="{{ asset('images/no-img.png') }}" width="50px" height="50px"
                                            alt="Profile Image" style="object-fit: cover;" class="rounded">
                                            @endif
                                            <span id="InputImage" class="error invalid-feedback">
                                                    @if ($errors->has('profile_image_path'))
                                                    {{ $errors->first('profile_image_path') }}
                                                @endif
                                                </span>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="InputDescription">Description</label>
                                        <textarea name="description" id="discription_editor"
                                            class="form-control @if ($errors->has('description'))
                                        is-invalid




                                        @endif" rows="3"
                                                placeholder="Enter Description" aria-describedby="DescriptionError" aria-invalid="true">
                                                {{ $user->description }}
                                        </textarea>
                                        <span id="DescriptionError" class="error invalid-feedback">
                                                        @if ($errors->has('description'))
                                            {{ $errors->first('description') }}
                                        @endif
                                        </span>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Tenant :</label>
                                            <select aria-describedby="TenantError"
                                                    aria-invalid="true"
                                                    class="form-control curr-sym @if ($errors->has('tenant_id')) is-invalid @endif"
                                                    name="tenant_id" disabled>

                                                        <option
                                                            {{  ($user->tenant && $user->tenant->name && $user->tenant->name ? 'selected' : '') }} >{{ $user->tenant->name }}</option>

                                            </select>
                                            <span id="TenantError" class="error invalid-feedback">
                                            @if ($errors->has('tenant_id'))
                                                    {{ $errors->first('tenant_id') }}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Role :</label>
                                            <select id="roles_drop_down" aria-describedby="TenantError"
                                                    aria-invalid="true"
                                                    class="form-control curr-sym @if ($errors->has('role')) is-invalid @endif"
                                                    name="role_code" disabled>
                                                        <option selected>{{$currentRole}}</option>
                                            </select>
                                            <span id="TenantError" class="error invalid-feedback">
                                            @if ($errors->has('role'))
                                                    {{ $errors->first('role') }}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group  select-all {{ $currentRole ? " " : "d-none" }}">
                                            <label for="InputName">User Permissions :</label>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4" id="permissions_check_boxes">
                                                    @if($user->user_permissions)
                                                        @foreach($user->user_permissions as $permission)
                                                            <input type="checkbox" name="permissions[]" id="permissions" class="mr-2 permissions" disabled checked>{{ $permission->name }}<br>
                                                        @endforeach
                                                    @endif()
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1"
                                                    @if ($user->is_active) checked @endif class="custom-control-input"
                                                    id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true" disabled>
                                                <label class="custom-control-label" for="customSwitch1">{{ ($user->is_active) ? "Active" : "Not Active" }}</label>
                                            </div>
                                            <span id="IsActiveError" class="error invalid-feedback">
                                                {{-- @if ($errors->has('is_active'))
                                                    {{ $errors->first('is_active') }}
                                                @endif --}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                {{-- <div class="card-footer"> --}}
                            {{-- </div> --}}
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
