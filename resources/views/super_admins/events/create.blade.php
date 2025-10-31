@extends('super_admins.layouts.master')

@section('title')
    Add Events
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
                    <h2 class="main-content-title fw-bold mb-0">Event</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active">
                            Add Event
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

                        <!-- form start -->
                        <form id="quickForm" method="POST" action="{{ route('super_admin.events.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                            <div class="row">
                            <div class="w-100">
                                <h5>Multi Language</h5>
                                <div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($active_languages as $key => $language)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{$key == 0 ? 'active':''}} mr-1" id="nav-{{$language->code}}-tab" data-toggle="tab" data-target="#nav-{{$language->code}}" type="button" role="tab" aria-controls="nav-{{$language->code}}" aria-selected="true">{{ $language->name }}</button>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content mt-2 p-2" id="myTabContent">
                                        @foreach ($active_languages as $key => $language)
                                        <div class="tab-pane fade mb-2 {{$key == 0 ? 'show active':''}}" id="nav-{{$language->code}}" role="tabpanel" aria-labelledby="nav-{{$language->code}}-tab">
                                            <div class="form-group">
                                                <label for="InputName-{{$language->code}}">Name ({{$language->code}})</label>
                                                <input type="text" name="name[{{$language->code}}]" class="form-control @if ($errors->has('name.'.$language->code)) is-invalid @endif" id="InputName-{{$language->code}}" placeholder="Please Enter" aria-describedby="NameError-{{$language->code}}" aria-invalid="true">
                                                <span id="NameError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has('name.'.$language->code))
                                                    {{ $errors->first('name.'.$language->code) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputDescription">Description ({{$language->code}})</label>
                                                <textarea name="description[{{$language->code}}]" id="discription_editor_{{$language->code}}" class="form-control @if ($errors->has('description.'.$language->code)) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError-{{$language->code}}" aria-invalid="true"></textarea>
                                                <span id="DescriptionError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has('description.'.$language->code))
                                                    {{ $errors->first('description.'.$language->code) }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="row">
                                    @if (isset($event_categories))
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Select Event Category :</label>
                                            <select aria-describedby="BlogCategoryError" aria-invalid="true"
                                                id="faq_categories_drop_down"
                                                class="form-control curr-sym @if ($errors->has('event_category_id')) is-invalid @endif"
                                                name="event_category_id">
                                                @if (count($event_categories) > 0)
                                                    <option value="">Select Event Category</option>
                                                    @foreach ($event_categories as $event_category)
                                                        <option value="{{ $event_category->id }}"
                                                            {{ old('event_category_id') == $event_category->id ? 'selected' : '' }}>
                                                            {{ $event_category->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Event Category Exists</option>
                                                @endif
                                            </select>
                                            <span id="BlogCategoryError" class="error invalid-feedback">
                                                @if ($errors->has('event_category_id'))
                                                    {{ $errors->first('event_category_id') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                 @if (isset($tags))
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputName">Select Event Tags :</label>
                                            <select multiple aria-describedby="TagsError" aria-invalid="true"
                                                id="faq_categories_drop_down"
                                                class="form-control curr-sym @if ($errors->has('tag_ids')) is-invalid @endif"
                                                name="tag_ids[]">
                                                @if (count($tags) > 0)
                                                    <option value="">Select Event Tags</option>
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}"
                                                            {{ old('tag_ids') == $tag->id ? 'selected' : '' }}>
                                                            {{ $tag->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Event Tag Exists</option>
                                                @endif
                                            </select>
                                            <span id="TagsError" class="error invalid-feedback">
                                                @if ($errors->has('tag_ids'))
                                                    {{ $errors->first('tag_ids') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary mb-2" id="add-field">Add Sponsors</button>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                         <div id="dynamic-fields">

                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputName">Starts At</label>
                                            <input required type="date" min="{{ now()->toDateString() }}" name="starts_at" value="{{ old('starts_at') }}"
                                                class="form-control @if ($errors->has('starts_at')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Starts At" aria-describedby="StartsAtError"
                                                aria-invalid="true">
                                            <span id="StartsAtError" class="error invalid-feedback">
                                                @if ($errors->has('starts_at'))
                                                    {{ $errors->first('starts_at') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputName">Ends At</label>
                                            <input required type="date" min="{{ now()->toDateString() }}" name="ends_at" value="{{ old('ends_at') }}"
                                                class="form-control @if ($errors->has('ends_at')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Ends At" aria-describedby="EndsAtError"
                                                aria-invalid="true">
                                            <span id="EndsAtError" class="error invalid-feedback">
                                                @if ($errors->has('ends_at'))
                                                    {{ $errors->first('ends_at') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputName">Address Line 1</label>
                                            <input type="text" name="address_line_1" value="{{ old('address_line_1') }}"
                                                class="form-control @if ($errors->has('address_line_1')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Address Line 1" aria-describedby="AddressLine2Error"
                                                aria-invalid="true">
                                            <span id="AddressLine2Error" class="error invalid-feedback">
                                                @if ($errors->has('address_line_1'))
                                                    {{ $errors->first('address_line_1') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputName">Address LIne 2</label>
                                            <input type="text" name="address_line_2" value="{{ old('address_line_2') }}"
                                                class="form-control @if ($errors->has('address_line_2')) is-invalid @endif"
                                                id="InputName" placeholder="Enter Address LIne 2" aria-describedby="NameError"
                                                aria-invalid="true">
                                            <span id="NameError" class="error invalid-feedback">
                                                @if ($errors->has('address_line_2'))
                                                    {{ $errors->first('address_line_2') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="InputImage">Choose Picture</label>
                                            <input type="hidden" name="image" class="image" value="">
                                            <input type="file" name="imageFile"
                                                class="custom-file-input imageFile @if ($errors->has('image')) is-invalid @endif"
                                                id="InputImage" placeholder="Select image" aria-describedby="ImageError"
                                                aria-invalid="true">
                                            <span id="ImageError" class="error invalid-feedback">
                                                @if ($errors->has('image'))
                                                    {{ $errors->first('image') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">

                                        <div class="form-group ">
                                            <label for="customSwitch1">Status</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" value="1"
                                                    @if (old('is_active')) checked @endif
                                                    class="custom-control-input" id="customSwitch1"
                                                    aria-describedby="IsActiveError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch1">Select
                                                    Event To Be Active
                                                    Or Not</label>
                                            </div>
                                            <span id="IsActiveError" class="error invalid-feedback">
                                                {{-- @if ($errors->has('is_active'))
                                                {{ $errors->first('is_active') }}
                                            @endif --}}
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="customSwitch2">Featured?</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_featured" value="1"
                                                    @if (old('is_featured')) checked @endif
                                                    class="custom-control-input" id="customSwitch2"
                                                    aria-describedby="IsFeaturedError" aria-invalid="true">
                                                <label class="custom-control-label" for="customSwitch2">Select
                                                    Event To Be Featured
                                                    Or Not</label>
                                            </div>
                                            <span id="IsFeaturedError" class="error invalid-feedback">
                                                {{-- @if ($errors->has('is_featured'))
                                                    {{ $errors->first('is_featured') }}
                                                @endif --}}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary px-3 py-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    @include('super_admins.includes.image_cropper_modal')
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        var index = 0;
        $(document).ready(function() {
            // CKEDITOR.replace('discription_editor');
                document.getElementById("add-field").addEventListener("click", function () {
                     // Create a new dynamic field row
                        const dynamicFields = document.getElementById("dynamic-fields");
                        const newRow = document.createElement("div");
                        newRow.classList.add("dynamic-field-row");
                        index = index + 1;
                        newRow.innerHTML = `

                        <button style="margin-top:31px" type="button" class="btn btn-primary float-right" onclick="removeField(this)" class="remove-field">X
                            </button>

                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                              <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="InputSponserName">Sponser Name</label>
                                                        <input type="text" required name="sponsers[${index}][name]"}}"
                                                              class="form-control @if ($errors->has('sponsers[${index}][name]')) is-invalid @endif"
                                                          id="InputSponserName" placeholder="Enter Sponser Name"              aria-describedby="SponserNameError"
                                                               aria-invalid="true">
                                                       <span id="SponserNameError" class="error invalid-feedback">
                                                             @if ($errors->has('sponsers[${index}][name]'))
                                                             {{ $errors->first('sponsers[${index}][name]') }}
                                                             @endif
                                            </span>
                                           </div>
                                           </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6" >
                                            <div class="form-group">
                                                <label for="InputImage">Choose Picture</label>
                                                 <input type="file" name="sponsers[${index}][image]"
                                                class="custom-file-input @if ($errors->has('image')) is-invalid @endif"
                                                id="InputImage" placeholder="Select image" aria-describedby="SponserImageError"
                                                aria-invalid="true">

                                            <span id="SponserImageError" class="error invalid-feedback">
                                                @if ($errors->has('image'))
                                                    {{ $errors->first('image') }}
                                                @endif
                                            </span>
                                             </div>
                                       </div>
                                </div>
                                    `;
                        dynamicFields.appendChild(newRow);
                });

        });
        function removeField(button) {
            index = index + 1;
                    const rowToRemove = button.parentElement;
                    document.getElementById("dynamic-fields").removeChild(rowToRemove);
                }
    </script>
      @include('super_admins.includes.image_cropper_scripts')
@endsection
