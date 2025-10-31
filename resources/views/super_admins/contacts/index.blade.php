@extends('super_admins.layouts.master')

@section('title')
    Contacts
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contacts</li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">All Contacts</h3>
                            <div class="ml-auto">


                                {{-- <a href="{{ route('super_admin.contacts.export') }}?{{ $params ? $params : '' }}"
                                    class="btn btn-primary">
                                    Export</a>
                                <button type="button" class="btn btn-primary btn-admin" data-toggle="modal"
                                    data-target="#importModal">
                                    Import
                                </button>
                                <a href="{{ route('super_admin.contacts.create') }}" class="btn btn-primary  ml-2">
                                    Add Contact</a>
                                <x-super-admin.import-modal importUrl="{{ route('super_admin.contacts.import') }}">

                                </x-super-admin.import-modal> --}}
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ date_format($contact->created_at, 'd-m-Y') }}</td>

                                            <td>
                                                @if (!$contact->trashed())
                                                    <div class="d-flex">

                                                        <a class="btn btn-primary ml-2 btn-admin"
                                                            href="{{ route('super_admin.contacts.show', ['contact' => $contact->id]) }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        {{-- <a class="ml-2 btn btn-primary btn-admin"
                                                            href="{{ route('super_admin.contacts.edit', ['contact' => $contact->id]) }}"><i
                                                                class="fa fa-edit"></i></a>


                                                        <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $contact->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}

                                                    </div>
                                                    
                                                    
                                                @else
                                                    <div class="d-flex">
                                                        {{-- restore --}}
                                                        <button type="button" class="btn btn-primary ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $contact->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $contact->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    
                                                @endif

                                            </td>

                                                    <div class="modal fade" id="deleteModal{{ $contact->id }}"
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
                                                                        delete this Contact permanently ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.contacts.destroy_permanently', ['contact' => $contact->id]) }}"
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
                                                    <div class="modal fade" id="restoreModal{{ $contact->id }}"
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
                                                                        restore this Contact ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.contacts.restore', ['contact' => $contact->id]) }}"
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
