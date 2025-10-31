@extends('super_admins.layouts.master')

@section('title')
    Booked Appointments
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-4 pt-4 pt-lg-0">

                <div class="col-md-7 mb-3 mb-lg-0">
                    <h2 class="main-content-title fw-bold mb-0">Booked Appointments</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Booked Appointments</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @php
                        $params = explode('?', request()->getRequestUri());
                        $params = $params[1] ?? null;
                    @endphp
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Tutor Name</th>
                                        <th>Academy Name</th>
                                        <th>Appointment Type</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booked_appointments as $key => $booked_appointment)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $booked_appointment->student->name ?? '' }}</td>
                                            <td>{{ $booked_appointment->teacher->name ?? '' }}</td>
                                            <td>{{ $booked_appointment->academy->name ?? 'N/A' }}</td>
                                            <td>{{ $booked_appointment->appointment_type->display_name ?? '' }}</td>
                                            <td>{{ date_format($booked_appointment->created_at, 'd-m-Y') }}</td>
                                            @if($booked_appointment->appointment_status_code == 1)
                                            <td>Pending</td>
                                            @elseif($booked_appointment->appointment_status_code == 2)
                                            <td>Accepted</td>
                                            @elseif($booked_appointment->appointment_status_code == 3)
                                            <td>Rejected</td>
                                            @elseif($booked_appointment->appointment_status_code == 4)
                                            <td>Cancel</td>
                                            @elseif($booked_appointment->appointment_status_code == 5)
                                            <td>Completed</td>
                                            @else
                                            <td>''</td>
                                            @endif
                                            <td>
                                                @if (!$booked_appointment->trashed())
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary btn-admin"
                                                            href="{{ route('super_admin.booked_appointments.show', ['booked_appointment' => $booked_appointment->id]) }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        <!-- <a class="ml-2 btn btn-primary btn-admin"
                                                            href="{{ route('super_admin.booked_appointments.edit', ['booked_appointment' => $booked_appointment->id]) }}"><i
                                                                class="fa fa-edit"></i></a> -->
                                                        {{-- edit --}}
                                                        {{-- <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $booked_appointment->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}
                                                        {{-- delete --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $booked_appointment->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>This action is irreversible. Are You Sure , You want
                                                                        to
                                                                        delete this Company Page ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.booked_appointments.destroy', ['booked_appointment' => $booked_appointment->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                @else
                                                    <div class="d-flex">
                                                        {{-- restore --}}
                                                        <button type="button" class="btn btn-primary ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $booked_appointment->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        {{-- <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $booked_appointment->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $booked_appointment->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>This action is irreversible. Are You Sure , You want
                                                                        to
                                                                        delete this Company Page permanently ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.booked_appointments.destroy_permanently', ['booked_appointment' => $booked_appointment->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <div class="modal fade" id="restoreModal{{ $booked_appointment->id }}"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Warning</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure , You want
                                                                        to
                                                                        restore this Company Page ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.booked_appointments.restore', ['booked_appointment' => $booked_appointment->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Restore</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
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
