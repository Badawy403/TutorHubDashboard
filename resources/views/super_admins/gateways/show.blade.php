@extends('super_admins.layouts.master')

@section('title')
    View Gateway
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
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.gateways.index') }}">Gateways</a></li>
                        <li class="breadcrumb-item active">
                            View Gateway
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
                                View Gateway
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <td>
                                        {{ $gateway->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Code
                                    </th>
                                    <td>
                                        {{ $gateway->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Currency
                                    </th>
                                    <td>
                                        {{ $gateway->currency }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Symbol
                                    </th>
                                    <td>
                                        {{ $gateway->symbol }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Convention Rate
                                    </th>
                                    <td>
                                        {{ $gateway->convention_rate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Min Amount
                                    </th>
                                    <td>
                                        {{ $gateway->min_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Max Amount
                                    </th>
                                    <td>
                                        {{ $gateway->max_amount }}
                                    </td>
                                </tr>
                                @if ($gateway->image)
                                <tr>
                                    <th>
                                        Image
                                    </th>
                                    <td>
                                        <img src="{{ url($gateway->image) }}" width="auto" height="auto">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        {{ $gateway->status ? 'Active' : 'Inactive' }}
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
