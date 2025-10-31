@extends('super_admins.layouts.master')

@section('title')
Students
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
                <h2 class="main-content-title fw-bold mb-0">Students</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Students</li>
                </ol>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-start justify-content-md-end">
                    @php
                    $params = explode('?', request()->getRequestUri());
                    $params = $params[1] ?? null;
                    @endphp
                    <a href="{{ route('super_admin.students.export') }}?{{ $params ? $params : '' }}"
                    class="btn btn-light">
                    <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span></a>
                    <button type="button" class="btn btn-light mx-2" data-toggle="modal" data-target="#importModal">
                        <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                    </button>
                    <a href="{{ route('super_admin.students.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add</span> </a>
                    <x-super-admin.import-modal importUrl="{{ route('super_admin.students.import') }}">

                    </x-super-admin.import-modal>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <!-- <div>
                                <h6 class="main-content-label fw-bold mb-1 text-uppercase">All Students</h6>
                                <p class="text-muted card-sub-title">The following students.</p>
                            </div> -->
                        <table id="example1" class="table table-bordered table-striped admin-table">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>Image</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->user_name }}</td>
                                    <td>
                                        @if ($student->image)
                                        <img src="{{ url($student->image) }}" width="75px" height="75px" alt="{{ $student->slug }}">
                                        &nbsp &nbsp
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ date_format($student->created_at, 'd-m-Y') }}</td>

                                    <td>{{ $student->is_active ? 'Active' : 'Inactive' }} </td>

                                    <td>
                                        @if (!$student->trashed())
                                        <div class="d-flex">
                                            {{-- @if(!$student->is_approved)
                                                        <button type="button" class="btn btn-primary ml-2 btn-admin"
                                                        data-toggle="modal"
                                                        data-target="#approveModal{{ $student->id }}">
                                            <i class="fa fa-check"></i>
                                            </button>
                                            @endif --}}
                                            <a class="btn btn-primary ml-2 btn-admin" href="{{ route('super_admin.students.show', ['student' => $student->id]) }}"><i class="fa fa-eye"></i></a>
                                            <a class="ml-2 btn btn-secondary btn-admin" href="{{ route('super_admin.students.edit', ['student' => $student->id]) }}"><i class="fa fa-edit"></i></a>
                                            {{-- edit --}}

                                            <button type="button" class="btn btn-danger ml-2 btn-admin" data-toggle="modal" data-target="#deleteModal{{ $student->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {{-- delete --}}
                                        </div>

                                        {{-- <div class="modal fade" id="approveModal{{ $student->id }}"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Warning</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> Are You Sure , You want
                                                        to
                                                        approve this Student ?</p>
                                                </div>
                                                <form action="{{ route('super_admin.students.approve', ['student' => $student->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Approve</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                    </div> --}}
                    @else
                    <div class="d-flex">
                        {{-- restore --}}
                        <button type="button" class="btn btn-primary ml-2 btn-admin" data-toggle="modal" data-target="#restoreModal{{ $student->id }}">
                            <i class="fa fa-trash-restore"></i>
                        </button>
                        {{-- delete permanently --}}
                        <button type="button" class="btn btn-danger ml-2 btn-admin" data-toggle="modal" data-target="#deleteModal{{ $student->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                    @endif

                    </td>

                    <div class="modal fade" id="deleteModal{{ $student->id }}" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Warning</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>This action is irreversible. Are You Sure , You want
                                        to
                                        delete this Student permanently ?</p>
                                </div>
                                <form action="{{ route('super_admin.students.destroy', ['student' => $student->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade" id="restoreModal{{ $student->id }}" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Warning</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are You Sure , You want
                                        to
                                        restore this Student ?</p>
                                </div>
                                <form action="{{ route('super_admin.students.restore', ['student' => $student->id]) }}" method="POST">
                                    @csrf
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
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
