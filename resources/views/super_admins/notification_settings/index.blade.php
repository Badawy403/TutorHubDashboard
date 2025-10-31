@extends('super_admins.layouts.master')

@section('title')
    Notification Settings
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection



@section('content')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            float: right;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.default:checked+.slider {
            background-color: #444;
        }

        input.primary:checked+.slider {
            background-color: #2196F3;
        }

        input.success:checked+.slider {
            background-color: #8bc34a;
        }

        input.info:checked+.slider {
            background-color: #3de0f5;
        }

        input.warning:checked+.slider {
            background-color: #FFC107;
        }

        input.danger:checked+.slider {
            background-color: #f44336;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style><!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-4 pt-4 pt-lg-0">

                <div class="col-md-7 mb-3 mb-lg-0">
                    <h2 class="main-content-title fw-bold mb-0"> Notification Settings</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.notification_settings.index') }}">
                                Notification Settings</a></li>
                        <li class="breadcrumb-item active">
                            Notification Settings
                        </li>
                    </ol>
                </div>
                {{-- <div class="col-md-5">
                    <div class="d-flex justify-content-start justify-content-md-end">
                        @if (auth()->user()->hasPermission('blog.add'))
                            <a href="{{ route('super_admin.notification_settings.create') }}" class="btn btn-primary  ml-2">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add Notification Settings</span>
                            </a>
                        @endif
                    </div>
                </div> --}}
            </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <form id="notificationForm" method="POST" action="{{ route('super_admin.notification_settings.store') }}">
                                @csrf

                                <table id="example1" class="table table-bordered table-striped admin-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email Notification</th>
                                            <th>Push Notification</th>
                                            <th>InApp Notification</th>
                                            {{-- @php
                                                if(false) echo "<th> name </th>"
                                                @endphp --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notification_settings as $key => $notification_array)
                                            <tr>
                                                <td colspan="4" class="text-center" style="background:#6c757d; padding: 10px; color: white; font-size: larger;">
                                                    {{ $key }}
                                                </td>
                                            </tr>
                                            @foreach ($notification_array as $notification)
                                                <tr>
                                                    <td>{{ $notification->display_name }}</td>
                                                    <td>
                                                        <input type="hidden" name="notifications[{{ $notification->id }}][id]" value="{{ $notification->id }}">
                                                        <label class="switch">
                                                            <input type="checkbox" name="notifications[{{ $notification->id }}][is_email_send]" class="primary" {{ $notification->is_email_send ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" name="notifications[{{ $notification->id }}][is_push_notification_send]" class="primary" {{ $notification->is_push_notification_send ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" name="notifications[{{ $notification->id }}][is_in_app_notification_send]" class="primary" {{ $notification->is_in_app_notification_send ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>

                                </table>
                                <br>
                                <button type="submit" class="btn btn-primary px-3 py-1 rounded-pill">Submit</button>
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
