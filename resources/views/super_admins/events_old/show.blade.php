@extends('super_admins.layouts.master')

@section('title')
    View Event
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('content')
    @if ($errors->any())
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active">
                            View Event
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
                            <h3 class="card-title mb-0">
                                View Event
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <td>
                                        {{ $event->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Description
                                    </th>
                                    <td>
                                        {!! $event->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Image
                                    </th>
                                    <td>
                                        @if ($event->image)
                                            <img src="{{ url($event->image) }}" width="75px" height="75px"
                                                alt="{{ $event->slug }}">
                                            &nbsp &nbsp
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Starts at
                                    </th>
                                    <td>
                                        {{ $event->starts_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Ends at
                                    </th>
                                    <td>
                                        {{ $event->starts_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Sponsor
                                    </th>
                                    <td>
                                        {{ $event->sponsor }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Sddress Line 1
                                    </th>
                                    <td>
                                        {{ $event->address_line_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Address Line 2
                                    </th>
                                    <td>
                                        {{ $event->address_line_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        {{ $event->is_active ? 'Active' : 'Inactive' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Created At
                                    </th>
                                    <td>
                                        {{ date_format($event->created_at, 'd-m-Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endsection
