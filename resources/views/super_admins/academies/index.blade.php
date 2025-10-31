@extends('super_admins.layouts.master')

@section('title')
    Academies
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
                    <h2 class="main-content-title fw-bold mb-0">Academies</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Academies</li>
                    </ol>
                </div>

                <div class="col-md-5">
                    <div class="d-flex justify-content-start justify-content-md-end">
                        @php
                            $params = explode('?', request()->getRequestUri());
                            $params = $params[1] ?? null;
                        @endphp
                        <a href="{{ route('super_admin.academies.export') }}?{{ $params ? $params : '' }}"
                            class="btn btn-light">
                            <i class="fa fa-upload" aria-hidden="true"></i><span class="ml-2">Export</span>
                        </a>
                        <button type="button" class="btn btn-light ml-2" data-toggle="modal" data-target="#importModal">
                            <i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Import</span>
                        </button>
                        <a href="{{ route('super_admin.academies.create') }}" class="btn btn-primary ml-2">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="ml-2">Add</span>
                        </a>
                        <x-super-admin.import-modal importUrl="{{ route('super_admin.academies.import') }}">

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

                            <div class="row">
                                <div class="col-md-5">

                                    <form action="{{ route('super_admin.academies.index') }}" method="get">
                                        <div class="input-group mb-3">
                                            <select name="column" class="form-control" id="dropdown">
                                                <option selected disabled>Select an option</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'all') selected @endif value="all">
                                                    Show All</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'first_name') selected @endif
                                                    value="first_name">First Name</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'last_name') selected @endif value="last_name">
                                                    Last Name</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'user_name') selected @endif value="user_name">
                                                    User Name</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'profile_image') selected @endif
                                                    value="profile_image">Pictures</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'email') selected @endif value="email">
                                                    Email</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_active') selected @endif value="is_active">
                                                    Status</option>
                                                <option @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_approved') selected @endif
                                                    value="is_approved">Approval Status</option>
                                            </select>

                                            <div id="filter-input-type" class="mx-3">
                                                @if (isset(request()->query()['column']) && request()->query()['column'] == 'is_active')
                                                    <select name='search' class='form-control' id='inputField'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Active</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>In-Active</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'is_approved')
                                                    <select name='search' class='form-control' id='inputField'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Approved</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>Not Approved</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'profile_image')
                                                    <select name='search' class='form-control' id='inputField'>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 1) selected @endif
                                                            value='1'>Yes</option>
                                                        <option @if (isset(request()->query()['search']) && request()->query()['search'] == 0) selected @endif
                                                            value='0'>No</option>
                                                    </select>
                                                @elseif(isset(request()->query()['column']) && request()->query()['column'] == 'all')
                                                @else
                                                    <input type="text"
                                                        value="@if (isset(request()->query()['search'])) {{ request()->query()['search'] }} @endif"
                                                        required name="search" class="form-control" id="inputField"
                                                        placeholder="Enter a value">
                                                @endif
                                            </div>
                                            <button type="submit" id="filter-button" class="btn btn-primary">
                                                Filter
                                            </button>
                                        </div>
                                    </form>
                                    <div class="mb-3">
                                        <button type="button" class="btn text-dark mr-1 bg-success">
                                            Approved
                                        </button>
                                        <!-- <button type="button" class="btn text-dark mr-1"
                                            style="  background-color: #ffff8e !important; ">
                                            New
                                        </button> -->
                                        <button type="button" class="btn  text-dark bg-danger" >
                                            Not Approved
                                        </button>
                                    </div>


                                </div>
                                <div class="col-md-4" id="bulk-actions-container" style="display: none">


                                    <div class="input-group align-items-center">
                                        <label class="mb-0">Bulk Action :</label>
                                        <select class="form-control mx-3" id="bulk-dropdown">
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($academies as $academy)
                                        <tr>

                                            <td style="@if (!$academy->is_approved) border-left:5px solid red !important; @else border-left:5px solid lightgreen !important; @endif">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $academy->id }}" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $academy->name }}</td>
                                            <td>
                                                @if ($academy->image)
                                                    <img src="{{ url($academy->image) }}" width="75px" height="75px"
                                                        alt="{{ $academy->slug }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ date_format($academy->created_at, 'd-m-Y') }}</td>

                                            <td>{{ $academy->is_active ? 'Active' : 'Inactive' }} </td>
                                            <td>{{ $academy->is_featured ? 'Yes' : 'No' }} </td>
                                            <td>{{ $academy->is_approved ? 'Yes' : 'No' }} </td>

                                            <td>
                                                @if (!$academy->trashed())
                                                    <div class="d-flex">
                                                        @if (!$academy->is_approved)
                                                            <button type="button" class="btn btn-success mr-2"
                                                                data-toggle="modal"
                                                                data-target="#approveModal{{ $academy->id }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Click to Approve">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        @endif
                                                        <a class="btn btn-info ml-2 mr-2 btn-admin" target="_blank"
                                                            href="{{ route('super_admin.academies.profile', ['academy' => $academy->id]) }}"><i
                                                                class="fa fa-user-md"></i></a>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('super_admin.academies.show', ['academy' => $academy->id]) }}"
                                                            data-toggle="tooltip" data-placement="bottom"
                                                            title="View Detail"><i class="fa fa-eye"></i></a>
                                                        <a class="ml-2 btn btn-secondary"
                                                            href="{{ route('super_admin.academies.edit', ['academy' => $academy->id]) }}"
                                                            data-toggle="tooltip" data-placement="bottom"
                                                            title="Edit Detail"><i class="fa fa-edit"></i></a>
                                                        {{-- edit --}}

                                                        <button type="button" class="btn btn-danger ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $academy->id }}"
                                                            data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        {{-- delete --}}
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary ml-2 dropdown-toggle"
                                                                type="button" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-angle-down text-white"
                                                                    aria-hidden="true"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_posts.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fa fa-rss" aria-hidden="true"></i><span
                                                                        class="ml-2">Blogs</span></a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_events.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i><span
                                                                        class="ml-2">Events</span></a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_certifications.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fas fa-certificate"
                                                                        aria-hidden="true"></i><span
                                                                        class="ml-2">Certifications</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_broadcasts.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fas fa-camera" aria-hidden="true"></i><span
                                                                        class="ml-2">Media</span></a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_podcasts.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fas fa-microphone"
                                                                        aria-hidden="true"></i><span
                                                                        class="ml-2">Podcasts</span></a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('super_admin.academy_archives.index', $academy->id) }}"
                                                                    class="btn btn-primary  ml-2">
                                                                    <i class="fas fa-archive" aria-hidden="true"></i><span
                                                                        class="ml-2">Archives</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $academy->id }}"
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
                                                                        delete this Academy ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.academies.destroy', ['academy' => $academy->id]) }}"
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
                                                    <div class="modal fade" id="approveModal{{ $academy->id }}"
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
                                                                        approve this Academy ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.academies.approve', ['academy' => $academy->id]) }}"
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
                                                        <button type="button" class="btn btn-primary ml-2"
                                                            data-toggle="modal"
                                                            data-target="#restoreModal{{ $academy->id }}">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </button>
                                                        {{-- delete permanently --}}
                                                        <button type="button" class="btn btn-danger ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $academy->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="deleteModal{{ $academy->id }}"
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
                                                                        delete this Academy permanently ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.academies.destroy_permanently', ['academy' => $academy->id]) }}"
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
                                                    <div class="modal fade" id="restoreModal{{ $academy->id }}"
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
                                                                        restore this Academy ?</p>
                                                                </div>
                                                                <form
                                                                    action="{{ route('super_admin.academies.restore', ['academy' => $academy->id]) }}"
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
            $('#dropdown').change(function() {
                var filter_type = $('#dropdown').val();
                if (filter_type == 'is_active') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control' id='inputField'> <option selected value='1'>Active</option> <option value='0'>In-Active</option> </select>"
                    );
                } else if (filter_type == 'is_approved') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control' id='inputField'> <option selected value='1'>Approved</option> <option value='0'>Not Approved</option> </select>"
                    );
                } else if (filter_type == 'email') {
                    $('#filter-input-type').html(
                        '<input type="email" required name="search" value="@if (isset(request()->query()[
                                    '
                                                                    search '
                                ])) {{ request()->query()[
                                    '
                                                                                    search '
                                ] }} @endif" class="form-control" id="inputField" placeholder="Enter a value">'
                    );
                } else if (filter_type == 'all') {
                    $('#filter-input-type').html(
                        ''
                    );
                } else if (filter_type == 'profile_image') {
                    $('#filter-input-type').html(
                        "<select name='search' class='form-control' id='inputField'> <option selected value='1'>Yes</option> <option value='0'>No</option> </select>"
                    );
                } else {
                    $('#filter-input-type').html(
                        '<input type="text" value="@if (isset(request()->query()[
                                    '
                                                                    search '
                                ])) {{ request()->query()[
                                    '
                                                                                    search '
                                ] }} @endif" required name="search" class="form-control" id="inputField" placeholder="Enter a value">'
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
                var url = "{{ route('super_admin.academies.bulk', '') }}" + "/" + type;
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
