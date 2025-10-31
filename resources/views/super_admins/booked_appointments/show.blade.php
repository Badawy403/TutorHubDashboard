@extends('super_admins.layouts.master')

@section('title')
    View Booked Appointment
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
            <div class="row mb-4 pt-4 pt-lg-0">

                <div class="col-sm-6">
                    <h2 class="main-content-title fw-bold mb-0">Booked Appointment</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.booked_appointments.index') }}">Booked Appointments</a></li>
                        <li class="breadcrumb-item active">
                            View Booked Appointment
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
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Question</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->question ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Student</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->student->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Tutor</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->teacher->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Academy</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->academy->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Appointment Type</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->appointment_type->display_name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ $booked_appointment->created_at ? date_format($booked_appointment->created_at, 'd-m-Y') : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        @if($booked_appointment->appointment_status_code == 1)
                                            <p class="mb-0 text-muted">Pending</p>
                                            @elseif($booked_appointment->appointment_status_code == 2)

                                            <p class="mb-0 text-muted">Accepted</p>
                                            @elseif($booked_appointment->appointment_status_code == 3)

                                            <p class="mb-0 text-muted">Rejected</p>
                                            @elseif($booked_appointment->appointment_status_code == 4)

                                            <p class="mb-0 text-muted">Cancel</p>
                                            @elseif($booked_appointment->appointment_status_code == 5)

                                            <p class="mb-0 text-muted">Completed</p>
                                            @else
                                            <td>''</td>
                                            @endif
                                        <p class="mb-0 text-muted">{{ $booked_appointment->created_at ? date_format($booked_appointment->created_at, 'd-m-Y') : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <hr>
                                        <p class="mb-0 text-muted">{!! $booked_appointment->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>


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
