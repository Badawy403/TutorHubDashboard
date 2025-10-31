@extends('super_admins.layouts.master')

@section('title')
    View Withdraw Request
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
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.withdraw_requests.index') }}">WithdrawRequests</a></li>
                        <li class="breadcrumb-item active">
                            View Withdraw Request
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
                                View Withdraw Request
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
                                        {{ $withdraw_request->user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Amount
                                    </th>
                                    <td>
                                        {{ $withdraw_request->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account Holder
                                    </th>
                                    <td>
                                        {{ $withdraw_request->account_holder }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account Number
                                    </th>
                                    <td>
                                        {{ $withdraw_request->account_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Bank
                                    </th>
                                    <td>
                                        {{ $withdraw_request->bank }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Additional Note
                                    </th>
                                    <td>
                                        {{ $withdraw_request->additional_note }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        {{ $withdraw_request->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Time
                                    </th>
                                    <td>
                                        {{ date('H:i:s', strtotime($withdraw_request->created_at)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date
                                    </th>
                                    <td>
                                        {{ date('F d, Y', strtotime($withdraw_request->created_at)) }}
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
