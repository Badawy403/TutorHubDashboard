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
                                Edit User
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST"
                              action="{{ route('super_admin.users.update', ['user' => $user->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Name :</label>
                                            <input type="text" name="user_name" value="{{ $user->user_name }}"
                                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                id="InputName" placeholder="Please Enter" aria-describedby="NameError"
                                                aria-invalid="true">
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
                                                id="InputEmail" placeholder="Please Enter" aria-describedby="EmailError"
                                                aria-invalid="true">
                                            <span id="EmailError" class="error invalid-feedback">
                                                @if ($errors->has('email'))
                                                    {{ $errors->first('email') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Password :</label>
                                            <input type="text" name="password" value=""
                                                class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                id="InputPassword" placeholder="Please Enter"
                                                aria-describedby="PasswordError"
                                                aria-invalid="true">
                                            <span id="PasswordError" class="error invalid-feedback">
                                                @if ($errors->has('password'))
                                                    {{ $errors->first('password') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputImage">Profile Image :</label>
                                            @if (isset($user->profile_image_path))
                                                <img src="{{ url($user->profile_image_path) }}" width="75px" height="75px"
                                                    alt="Profile Image">
                                            @else
                                                -No Image Selected
                                            @endif
                                            <input type="file" name="profile_image_path" multiple
                                                class="form-control p-1 small @if ($errors->get('profile_image_path')) is-invalid @endif"
                                                id="InputImage" placeholder="Please Enter" aria-describedby="ImageError"
                                                aria-invalid="true">
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
                                    @if(isset($tenants))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Select Tenant :</label>
                                            <select aria-describedby="TenantError"
                                                    aria-invalid="true"
                                                    class="form-control curr-sym @if ($errors->has('tenant_id')) is-invalid @endif"
                                                    name="tenant_id">
                                                @if(count($tenants) > 0)
                                                    <option value="">Please Select</option>
                                                    @foreach($tenants as $tenant)
                                                        <option
                                                            {{  ($user->tenant && $user->tenant->email && $user->tenant->email == $tenant->email ? 'selected' : '') }} value="{{$tenant->id}}">{{$tenant->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Tenant Exists</option>
                                                @endif
                                            </select>
                                            <span id="TenantError" class="error invalid-feedback">
                                            @if ($errors->has('tenant_id'))
                                                    {{ $errors->first('tenant_id') }}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($roles))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputName">Select Role :</label>
                                            <select id="roles_drop_down" aria-describedby="TenantError"
                                                    aria-invalid="true"
                                                    class="form-control curr-sym @if ($errors->has('role')) is-invalid @endif"
                                                    name="role_code">
                                                @if(count($roles) > 0)
                                                    <option value="">Please Select</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->role_code}}"
                                                            {{ ($currentRole && $currentRole ==  $role->role_code ? "selected" : "") }}>{{$role->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Role Exists</option>
                                                @endif
                                            </select>
                                            <span id="TenantError" class="error invalid-feedback">
                                            @if ($errors->has('role'))
                                                    {{ $errors->first('role') }}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group  select-all {{ $currentRole ? " " : "d-none" }}">
                                            <label for="InputName">User Permissions :</label>
                                            <br>
                                            <div class="form-check p-0 mb-2 d-flex align-items-center">
                                                <input type="checkbox" id="check-all" class="mr-2"/>
                                                <label class="form-check-label">Select All</label>
                                            </div>
                                            <div class="col-md-12 px-0">
                                                <div class="row" id="permissions_check_boxes">

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
                                                    id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select User To Be Active
                                                    Or Not</label>
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
                                <br>
                                <button type="submit" class="btn btn-primary py-1 px-3 rounded-pill">Update</button>
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
    <script>
        $(document).ready(function () {
            var role_code = $('#roles_drop_down').val();
            var user_id = {{ $user->id }};
            var currentRole = "{{ @$currentRole }}";
            if (role_code) {
                getPermissionAjaxCall(role_code, user_id)
            }
            $('#roles_drop_down').on('change', function () {
                var role_code = $(this).val();
                if (role_code) {
                    if (currentRole) {
                        getPermissionAjaxCall(role_code, user_id)
                    } else {
                        getPermissionAjaxCall(role_code)
                    }
                } else {
                    $('#permissions_check_boxes').empty();
                }
            });
            $("#check-all").click(function () {
                $('.permissions').prop('checked', this.checked);
            });

            function getPermissionAjaxCall(role_code, user_id = null) {

                $.ajax({
                    url: "{{ route('super_admin.getPermissionsExceptRole') }}",
                    type: "GET",
                    data: {role_code: role_code, user_id: user_id},
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            console.log(data.data)
                            $('#permissions_check_boxes').empty();
                            $.each(data.data.permissions, function (key, permission) {
                                var status = '';
                                console.log(permission)
                                if (permission.flag) status = 'checked';
                                $('#permissions_check_boxes').append(
                                    '<div class="col-md-6 mb-2 d-flex align-items-center"><input type="checkbox" name="permissions[]" id="permissions" class="mr-2 permissions" value="' + permission.code + '" ' + status + '>' + permission.name + '</div>'
                                );
                            });
                            if (data.data.all_permissions_status) {
                                $('#check-all').prop('checked', true);
                            } else {
                                $('#check-all').prop('checked', false);
                            }
                            $('.select-all').removeClass('d-none')
                        } else {
                            $('#permissions_check_boxes').empty();
                        }
                    }
                });
            }
        });
    </script>

@endsection
