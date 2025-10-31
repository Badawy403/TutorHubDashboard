@extends('super_admins.layouts.master')

@section('title')
    Add Role
@endsection

@section('content')
    @if ($errors->any())
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Add Role
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('super_admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('super_admin.roles.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">
                            Add Role
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
                        <div class="card-header">
                            <h3 class="card-title mb-0">
                                Add Role
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST" action="{{ route('super_admin.roles.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputName">Role Name</label>
                                    <input required type="text" name="name" value="{{ old('name') }}"
                                           class="form-control @if ($errors->has('name')) is-invalid @endif"
                                           id="InputName" placeholder="Please Enter" aria-describedby="NameError"
                                           aria-invalid="true">
                                    <span id="NameError" class="error invalid-feedback">
                                        @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </span>
                                </div>
                                @if(isset($tenants))
                                <div class="form-group single-input-admin">
                                    <label for="InputName">Select Tenant :</label>
                                        <select aria-describedby="TenantError"
                                        aria-invalid="true" class="form-control filter-single curr-sym @if ($errors->has('tenant_id')) is-invalid @endif" name="tenant_id">
                                          @if(count($tenants) > 0)
                                              <option value="">Please Select</option>
                                             @foreach($tenants as $tenant)
                                             <option value="{{$tenant->id}}">{{$tenant->name}}</option>
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
                                @endif
                                <div class="form-group">
                                    <label for="InputName">Permissions</label>
                                    <br>
                                    <div class="form-check p-0 mb-2 d-flex align-items-center">
                                        <input type="checkbox" id="check-all" class="mr-2"/>
                                        <label class="form-check-label">Select All</label>
                                    </div>
                                    @foreach($permissions->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach($chunk as $permission)
                                                <div class="col-md-4 mb-2 d-flex align-items-center">
                                                    <input type="checkbox" name="permissions[]" id="permissions" class="mr-2 permissions"
                                                           value="{{ $permission->permission_code }}">
                                                    {{ $permission->name }}
                                                    <br>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                        <div class="form-group mb-0 mt-2">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1"
                                                       @if (old('is_active')) checked
                                                       @endif class="custom-control-input"
                                                       id="customSwitch1" aria-describedby="IsActiveError"
                                                       aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select Role To
                                                    Be
                                                    Active
                                                    Or Not</label>
                                            </div>
                                            <span id="IsActiveError" class="error invalid-feedback">

                                    </span>
                                        </div>
                                        <!-- /.card-body -->
                                        <br>
                                        <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        $("#check-all").click(function () {
            $('.permissions').prop('checked', this.checked);
        });
        $(document).ready(function() {
            $(".filter-single").select2({
                minimumResultsForSearch: Infinity,
                dropdownCssClass: "select2-single-input",
            });
        });
    </script>
@endsection
