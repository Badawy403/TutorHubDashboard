@extends('admin.layouts.master')

@section('title')
    Photos
@endsection

@section('css')
    @include('admin.includes.datatable_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Photos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Photos</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Photos</h3>
                            <a href="{{ route('admin.photos.create') }}" class="btn btn-primary float-right"> Add
                                Photo</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Images</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($photos as $photo)
                                        <tr>
                                            <td>{{ $photo->name }}</td>
                                            <td>
                                                {{-- @if ($photo->images)
                                                    <img src="{{ asset('storage/' . $photo->images) }}" width="75px" height="75px"
                                                        alt="{{ $photo->images }}">
                                                    &nbsp &nbsp
                                                @else
                                                    -
                                                @endif --}}
                                                @if($photo->images && count($photo->images) > 0)
                                                @foreach($photo->images as $image)
                                                <img src="{{url('images/'.$image)}}" width="75px" height="75px" alt="{{$image}}">
                                                &nbsp &nbsp
                                                @endforeach
                                                @else
                                                -
                                                @endif
                                            </td>


                                            <td>{{ $photo->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-primary btn-admin"
                                                        href="{{ route('admin.photos.edit', ['photo' => $photo->id]) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    {{-- edit --}}
                                                    <button type="button" class="btn btn-danger ml-2 btn-admin" data-toggle="modal"
                                                        data-target="#deleteModal{{ $photo->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    {{-- delete --}}
                                                </div>
                                                <div class="modal fade" id="deleteModal{{ $photo->id }}"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Warning</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>This action is irreversible. Are You Sure , You want to
                                                                    delete this photo permanently ?</p>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.photos.destroy', ['photo' => $photo->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
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
    @include('admin.includes.datatable_scripts')
@endsection
