@extends('super_admins.layouts.master')

@section('title')
    View Tutor
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
                    <h2 class="main-content-title fw-bold mb-0">Tutors</h2>
                    <ol class="breadcrumb float-sm-left">

                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.teachers.index') }}">Tutors</a></li>
                        <li class="breadcrumb-item active">
                            View Tutor Profile
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
                        <h4 class="text-center py-4">Personal Details</h4>
                            <div class="row">
                            <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Image</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($teacher->image)
                                                <img class="mt-3" src="{{ url($teacher->image) }}" width="75px" height="75px"
                                                    alt="{{ $teacher->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Academy</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->academy && $teacher->academy->name ? $teacher->academy->name :  '--'}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Name</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->name ? $teacher->name : '--' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Email </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->email ? $teacher->email : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($teacher->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $teacher->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            <h4 class="text-center py-4">Home Address</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Country</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->country->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">City</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->city->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">State</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->state->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 1 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->address_line_1 ? $teacher->address_line_1 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 2 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->address_line_2 ? $teacher->address_line_2 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Zip Code</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->zip_code ? $teacher->zip_code : '--' }}</p>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center py-4">Work Address</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Country</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_country->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">City</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_city->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">State</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_state->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 1 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_address_line_1 ? $teacher->work_address_line_1 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 2 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_address_line_2 ? $teacher->work_address_line_2 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Zip Code</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->work_zip_code ? $teacher->work_zip_code : '--' }}</p>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center py-4">Billing Address</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Country</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_country->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">City</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_city->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">State</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_state->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 1 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_address_line_1 ? $teacher->billing_address_line_1 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 2 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_address_line_2 ? $teacher->billing_address_line_2 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Zip Code</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->billing_zip_code ? $teacher->billing_zip_code : '--' }}</p>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center py-4">Shipping Address</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Country</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_country->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">City</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_city->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">State</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_state->name ?? '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 1 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_address_line_1 ? $teacher->shipping_address_line_1 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Address Line 2 </h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_address_line_2 ? $teacher->shipping_address_line_2 : '--' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Zip Code</h6>
                                        <p class="mb-0 text-muted">{{ $teacher->shipping_zip_code ? $teacher->shipping_zip_code : '--' }}</p>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-center py-4">Certifications</h4>
                            @if(!empty($teacher->teacher_certifications) && count($teacher->teacher_certifications) > 0)
                            @foreach($teacher->teacher_certifications as $certification)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $certification->name ? $certification->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($certification->image)
                                                <img class="mt-3" src="{{ url($certification->image) }}" width="75px" height="75px"
                                                    alt="{{ $certification->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $certification->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($certification->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $certification->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif

                            <h4 class="text-center py-4">Educations</h4>
                            @if(!empty($teacher->teacher_educations) && count($teacher->teacher_educations) > 0)
                            @foreach($teacher->teacher_educations as $education)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $education->name ? $education->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($education->image)
                                                <img class="mt-3" src="{{ url($education->image) }}" width="75px" height="75px"
                                                    alt="{{ $education->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $education->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($education->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $education->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif

                            <h4 class="text-center py-4">Experiences</h4>
                            @if(!empty($teacher->teacher_experiences) && count($teacher->teacher_experiences) > 0)
                            @foreach($teacher->teacher_experiences as $experience)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $experience->name ? $experience->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($experience->image)
                                                <img class="mt-3" src="{{ url($experience->image) }}" width="75px" height="75px"
                                                    alt="{{ $experience->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $experience->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($experience->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $experience->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif
<!--
                            <h4 class="text-center py-4">Blogs</h4>
                            @if(!empty($teacher->teacher_posts) && count($teacher->teacher_posts) > 0)
                            @foreach($teacher->teacher_posts as $blog)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $blog->name ? $blog->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($blog->image)
                                                <img class="mt-3" src="{{ url($blog->image) }}" width="75px" height="75px"
                                                    alt="{{ $blog->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $blog->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($blog->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $blog->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif -->

                            <h4 class="text-center py-4">Courses</h4>
                            @if(!empty($teacher->teacher_archives) && count($teacher->teacher_archives) > 0)
                            @foreach($teacher->teacher_archives as $course)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $course->name ? $course->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($course->image)
                                                <img class="mt-3" src="{{ url($course->image) }}" width="75px" height="75px"
                                                    alt="{{ $course->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $course->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($course->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $course->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif


                            <h4 class="text-center py-4">Media</h4>
                            @if(!empty($teacher->teacher_broadcasts) && count($teacher->teacher_broadcasts) > 0)
                            @foreach($teacher->teacher_broadcasts as $media)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $media->name ? $media->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($media->image)
                                                <img class="mt-3" src="{{ url($media->image) }}" width="75px" height="75px"
                                                    alt="{{ $media->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $media->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($media->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $media->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif

                            <h4 class="text-center py-4">Podcasts</h4>
                            @if(!empty($teacher->teacher_podcasts) && count($teacher->teacher_podcasts) > 0)
                            @foreach($teacher->teacher_podcasts as $podcast)
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">{{ $podcast->name ? $podcast->name : '--' }}</p>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                            @if ($podcast->image)
                                                <img class="mt-3" src="{{ url($podcast->image) }}" width="75px" height="75px"
                                                    alt="{{ $podcast->slug }}">

                                            @else
                                                --
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">{{ $podcast->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">{{ date_format($podcast->created_at, 'd-m-Y') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Description</h6>
                                        <p class="mb-0 text-muted">{!! $podcast->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Title</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">File</h6>
                                        <p class="mb-0 text-muted">
                                                '--'
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Status</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border h-100  rounded p-3 border-light">
                                        <h6 class="fw-bold text-uppercase mb-0">Created At</h6>
                                        <p class="mb-0 text-muted">'--'</p>
                                    </div>
                                </div>

                            </div>
                            @endif



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
