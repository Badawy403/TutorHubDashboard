@extends('super_admins.layouts.master')

@section('title')
    Company Pages
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
                    <h2 class="main-content-title fw-bold mb-0">Company Pages</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Company Pages</li>
                    </ol>
                </div>
                <div class="col-md-5">
                <div class="d-flex justify-content-start justify-content-md-end">
                    <!-- @php
                    $params = explode('?', request()->getRequestUri());
                    $params = $params[1] ?? null;
                    @endphp
                    <a href="{{ route('super_admin.cities.export') }}?{{ $params ? $params : '' }}" class="btn btn-light">
                        <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span>
                    </a>
                    <button type="button" class="btn btn-light ml-2" data-toggle="modal" data-target="#importModal">
                        <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                    </button> -->
                    <a href="{{ route('super_admin.company_pages.create') }}" class="btn btn-primary  ml-2">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add CompanyPage</span>
                    </a>
                    <x-super-admin.import-modal importUrl="{{ route('super_admin.cities.import') }}">
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
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company_pages as $company_page)
                                        <tr>
                                            <td>{{ $company_page->name }}</td>
                                            <td>
                                                @if ($company_page->image)
                                                    <img src="{{ url($company_page->image) }}" width="75px"
                                                        height="75px" alt="{{ $company_page->slug }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ date_format($company_page->created_at, 'd-m-Y') }}</td>

                                            <td>{{ $company_page->is_active ? 'Active' : 'Inactive' }} </td>
                                            <td>
                                                @if (!$company_page->trashed())
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary btn-admin"
                                                            href="{{ route('super_admin.company_pages.show', ['company_page' => $company_page->id]) }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a class="ml-2 btn btn-secondary btn-admin"
                                                            href="{{ route('super_admin.company_pages.edit', ['company_page' => $company_page->id]) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        {{-- edit --}}
                                                        @if(!$company_page->is_default)
                                                         <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $company_page->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        @endif
                                                        {{-- delete --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $company_page->id }}"
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
                                                                    action="{{ route('super_admin.company_pages.destroy', ['company_page' => $company_page->id]) }}"
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
                                                            data-target="#restoreModal{{ $company_page->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        {{-- <button type="button" class="btn btn-danger ml-2 btn-admin"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $company_page->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $company_page->id }}"
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
                                                                    action="{{ route('super_admin.company_pages.destroy_permanently', ['company_page' => $company_page->id]) }}"
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
                                                    <div class="modal fade" id="restoreModal{{ $company_page->id }}"
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
                                                                    action="{{ route('super_admin.company_pages.restore', ['company_page' => $company_page->id]) }}"
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
