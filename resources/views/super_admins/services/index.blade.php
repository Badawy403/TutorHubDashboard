@extends('super_admins.layouts.master')

@section('title')
    Services
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
                    <h2 class="main-content-title fw-bold mb-0">Services</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
                {{-- <div class="col-md-5">
                    <div class="d-flex justify-content-start justify-content-md-end">

                        @php
                            $params = explode('?', request()->getRequestUri());
                            $params = $params[1] ?? null;
                        @endphp
                        @if (auth()->user()->hasPermission('service.export'))
                            <a href="{{ route('super_admin.services.export') }}?{{ $params ? $params : '' }}"
                                class="btn btn-light">
                                <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span></a>
                        @endif
                        @if (auth()->user()->hasPermission('service.import'))
                            <button type="button" class="btn btn-light ml-2" data-toggle="modal"
                                data-target="#importModal">
                                <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                            </button>
                        @endif
                        @if (auth()->user()->hasPermission('service.add'))
                            <a href="{{ route('super_admin.services.create') }}" class="btn btn-primary  ml-2">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add</span></a>
                        @endif
                        <x-super-admin.import-modal importUrl="{{ route('super_admin.services.import') }}">

                        </x-super-admin.import-modal>
                    </div>
                </div> --}}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body table-responsive">

                            <div class="row">
                                <div class="col-md-7">

                                    <form action="{{ route('super_admin.services.index') }}" method="get">
                                        <div class="d-flex mb-3">
                                            <select name="column" class="form-control" style="min-width: 150px;"
                                                id="dropdown">
                                                <option selected disabled>Select an option</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'all') selected @endif value="all">
                                                    Show All</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'name') selected @endif
                                                    value="name">First Name</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'image') selected @endif
                                                    value="image">Pictures</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_active') selected @endif value="is_active">
                                                    Status</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_approved') selected @endif
                                                    value="is_approved">Approval Status</option>
                                            </select>

                                            <div id="filter-input-type" class="mx-2">
                                                @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_active')
                                                    <select name='search' class='form-control'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Active</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>In-Active</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'is_approved')
                                                    <select name='search' class='form-control'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Approved</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>Not Approved</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'image')
                                                    <select name='search' class='form-control'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Yes</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>No</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'all')
                                                @else
                                                    <input type="text"
                                                        value="@if (isset(request()->query()['search'])) {{ request()->query()['search'] }} @endif"
                                                        required name="search" class="form-control "
                                                        placeholder="Enter a value">
                                                @endif
                                            </div>
                                            <button type="submit" id="filter-button" class="btn btn-primary">
                                                Filter
                                            </button>

                                        </div>
                                    </form>
                                    <div class="mb-3">
                                        <button type="button" class="btn text-dark mr-1"
                                            style=" background-color: lightgreen !important; ">
                                            Approved
                                        </button>
                                        <!-- <button type="button" class="btn text-dark mr-1"
                                                    style="  background-color: #ffff8e !important; ">
                                                    New
                                                </button> -->
                                        <button type="button" class="btn  text-dark" style="background-color:#ff3838">
                                            Not Approved
                                        </button>
                                    </div>

                                </div>
                                <div class="col-md-5 mb-3 mb-lg-0" id="bulk-actions-container" style="display: none">


                                    <div class="d-flex align-items-center">
                                        <label class="mb-0">Bulk Action :</label>
                                        <select class="form-control mx-3" style="width: 120px;" id="bulk-dropdown">
                                            <option selected value="approve">Approve All</option>
                                            <option value="disapprove">DisApprove All</option>
                                            <option value="inactive">In Active All</option>
                                            <option value="active">Active All</option>
                                            <option value="delete">Delete All</option>
                                            <option value="feature">Feature All</option>
                                        </select>
                                        <button type="submit" data-toggle="modal" data-target="#confirmModal"
                                            class="btn btn-primary">
                                            Apply
                                        </button>
                                    </div>
                                    <div class="modal" id="confirmModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirmation</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <p>Are you sure you want to proceed?</p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">No</button>
                                                    <button type="button" id="bulk-button" class="btn btn-primary"
                                                        id="confirmButton">Yes</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Tutor Name</th>
                                        <th>Academy Name</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td
                                                style="@if (!$service->is_approved) border-left:5px solid red !important; @else border-left:5px solid lightgreen !important; @endif">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $service->id }}" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->teacher->name ?? 'N/A' }}</td>
                                            <td>{{ $service->academy->name ?? 'N/A' }}</td>
                                            <td>
                                                @if ($service->image)
                                                    <img src="{{ url($service->image) }}" width="75px" height="75px"
                                                        alt="{{ $service->slug }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ date_format($service->created_at, 'd-m-Y') }}</td>

                                            <td>{{ $service->is_active ? 'Active' : 'Inactive' }} </td>
                                            <td>{{ $service->is_featured ? 'Yes' : 'No' }} </td>
                                            <td>{{ $service->is_approved ? 'Yes' : 'No' }} </td>
                                            <td>
                                                @if (!$service->trashed())
                                                    <div class="d-flex">
                                                        @if (!$service->is_approved)
                                                            <button type="button" class="btn btn-success mr-2"
                                                                data-toggle="modal"
                                                                data-target="#approveModal{{ $service->id }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Click to Approve">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        @endif
                                                        {{-- @if (auth()->user()->hasPermission('service.show')) --}}
                                                            <a class="btn btn-primary"
                                                                href="{{ route('super_admin.services.show', ['service' => $service->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View Detail"><i class="fa fa-eye"></i></a>
                                                        {{-- @endif --}}
                                                        {{-- view --}}
                                                        {{-- @if (auth()->user()->hasPermission('service.edit'))
                                                            <a class="btn btn-secondary ml-2"
                                                                href="{{ route('super_admin.services.edit', ['service' => $service->id]) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit Detail"><i class="fa fa-edit"></i></a>
                                                        @endif --}}
                                                        {{-- edit --}}
                                                        {{-- @if (auth()->user()->hasPermission('service.delete')) --}}
                                                            <button type="button" class="btn btn-danger ml-2"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $service->id }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        {{-- @endif --}}
                                                        {{-- delete --}}
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $service->id }}"
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
                                                                    <p>This action is irreversible. Are You Sure
                                                                        , You want
                                                                        to
                                                                        delete this Service ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.services.destroy', ['service' => $service->id]) }}"
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
                                                    <div class="modal fade" id="approveModal{{ $service->id }}"
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
                                                                    <p> Are You Sure , You want
                                                                        to
                                                                        approve this Service ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.services.approve', ['service' => $service->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Approve</button>
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
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $service->id }}"
                                                            data-toggle="tooltip" data-placement="bottom"
                                                            title="Restore">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        <button type="button" class="btn btn-danger ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $service->id }}"
                                                            data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="restoreModal{{ $service->id }}"
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
                                                                        restore this Service ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.services.restore', ['service' => $service->id]) }}"
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
    <script>
        $(document).ready(function() {
            var services = {!! json_encode($services) !!};
            $('#dropdown').change(function() {
                var filter_type = $('#dropdown').val();
                if (filter_type == 'is_active') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control'> <option selected value='1'>Active</option> <option value='0'>In-Active</option> </select>"
                    );
                } else if (filter_type == 'is_approved') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control'> <option selected value='1'>Approved</option> <option value='0'>Not Approved</option> </select>"
                    );
                } else if (filter_type == 'all') {
                    $('#filter-input-type').html(
                        ''
                    );
                } else if (filter_type == 'image') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control'> <option selected value='1'>Yes</option> <option value='0'>No</option> </select>"
                    );
                } else {
                    $('#filter-input-type').html(
                        '<input type="text" value="@if (isset(request()->query()[
                                    '
                                                                                                                                                                    search '
                                ])) {{ request()->query()[
                                    '
                                                                                                                                                                                                                    search '
                                ] }} @endif" required name="search" class="form-control" placeholder="Enter a value">'
                    );
                }
            });
            var selectedValues = [];
            $('#example1').on('change', 'input[type="checkbox"]', (function() {
                var value = $(this).val();
                if ($(this).is(':checked')) {
                    selectedValues.push(value);
                } else {
                    var index = selectedValues.indexOf(value);
                    if (index !== -1) {
                        selectedValues.splice(index, 1);
                    }
                }
                if (selectedValues.length === 0) {
                    $('#bulk-actions-container').hide();
                } else {
                    $('#bulk-actions-container').show();
                }
            }));
            $('#bulk-button').click(function() {
                var type = $('#bulk-dropdown').val();
                var url = "{{ route('super_admin.services.bulk', '') }}" + "/" + type;
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        'selected_ids': selectedValues,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error, xhr, status)
                        location.reload();
                    }
                });
                $('#confirmModal').modal('hide');
            });
        });
    </script>
@endsection
<style>
    .dropdown-toggle::after {
        display: none !important;
    }
</style>
