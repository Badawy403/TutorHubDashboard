@extends('super_admins.layouts.master')

@section('title')
    Edit Role
@endsection



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('super_admin.roles.index')}}"> Roles</a></li>
                        <li class="breadcrumb-item active">
                                Edit Role
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" id="quickForm"
                              action="{{ route('super_admin.roles.update', ['role' => $role->id]) }}" >
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputName">Role Name</label>
                                    <input type="text" name="name"
                                           class="form-control @if ($errors->has('name')) is-invalid @endif"
                                           id="InputName" placeholder="Enter Name" aria-describedby="NameError"
                                           aria-invalid="true" value="{{ $role->name }}" disabled>
                                    <span id="NameError" class="error invalid-feedback">
                                        @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </span>
                                </div>

                                <label>Permissions</label>
                                <div class="form-check p-0 mb-2 d-flex align-items-center">
                                    <input type="checkbox" id="check-all" class="mr-2"/>
                                    <label class="form-check-label">Select All</label>
                                </div>
                                @foreach($permissions->chunk(3) as $chunk)
                                    <div class="row">
                                        @foreach($chunk as $permission)
                                            <div class="col-md-4 mb-2 d-flex align-items-center">
                                                <input type="checkbox" @if(in_array($permission->permission_code, $rolePermissions))
                                                    {{"checked"}}
                                                @endif name="permissions[]" class="mr-2 permissions"
                                                       value="{{ $permission->permission_code }}">
                                                {{ $permission->name }}
                                                <br>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                <div class="col-md-6 pl-0 mt-3">
                                    <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script>
        $("#check-all").click(function () {
            $('.permissions').prop('checked', this.checked);
        });
    </script>
@endsection
