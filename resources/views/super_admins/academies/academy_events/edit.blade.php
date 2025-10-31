@extends('super_admins.layouts.master')

@section('title')
Edit Event
@endsection

@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
{{-- {{ $error }} --}}
@endforeach
@endif
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4 pt-4 pt-lg-0">

            <div class="col-sm-6">
                <h2 class="main-content-title fw-bold mb-0">Event</h2>
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.academies.index') }}">Academy </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('super_admin.academy_events.index' , $academy->id) }}">Events </a></li>
                    <li class="breadcrumb-item active">
                        Edit Event
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
                    <form id="quickForm" method="POST" action="{{ route('super_admin.academy_events.update', ['academy' => $academy->id , 'academy_event' => $academy_event->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                                <input type="text" name="name[{{$language->code}}]" value="{{ $academy_event->getTranslation('name', $language->code); }}" class="form-control @if ($errors->has('name.'.$language->code)) is-invalid @endif" id="InputName-{{$language->code}}" placeholder="Please Enter" aria-describedby="NameError-{{$language->code}}" aria-invalid="true">
                                                <span id="NameError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has('name.'.$language->code))
                                                    {{ $errors->first('name.'.$language->code) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputDescription">Description ({{$language->code}})</label>
                                                <textarea name="description[{{$language->code}}]" id="discription_editor_{{$language->code}}" class="form-control @if ($errors->has('description.'.$language->code)) is-invalid @endif" rows="3" placeholder="Please Enter" aria-describedby="DescriptionError-{{$language->code}}" aria-invalid="true">{{ $academy_event->getTranslation('description', $language->code); }}</textarea>
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
                                                <select aria-describedby="PostCategoryError" aria-invalid="true"
                                                    id="faq_categories_drop_down"
                                                    class="form-control curr-sym @if ($errors->has('event_category_id')) is-invalid @endif"
                                                    name="event_category_id">
                                                    @if (count($event_categories) > 0)
                                                        <option value="">Select Event Category</option>
                                                        @foreach ($event_categories as $event_category)
                                                            <option value="{{ $event_category->id }}"
                                                                {{ $academy_event->event_category_id == $event_category->id ? 'selected' : '' }}>
                                                                {{ $event_category->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Event Category Exists</option>
                                                    @endif
                                                </select>
                                                <span id="PostCategoryError" class="error invalid-feedback">
                                                    @if ($errors->has('event_category_id'))
                                                        {{ $errors->first('event_category_id') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary mb-3" id="add-field">Add Sponsors</button>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div id="dynamic-fields">

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="InputName">Starts At</label>
                                        <input required type="datetime-local"  min="<?= date('Y-m-d\TH:i'); ?>"  name="starts_at" value="{{ $academy_event->starts_at }}" class="form-control @if ($errors->has('starts_at')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
                                        <span id="NameError" class="error invalid-feedback">
                                            @if ($errors->has('starts_at'))
                                            {{ $errors->first('starts_at') }}
                                            @endif
                                        </span>
                                    </div>
                                              <div class="form-group">
                                        <label for="InputName">Ends At</label>
                                        <input required type="datetime-local"  min="<?= date('Y-m-d\TH:i'); ?>"  name="ends_at" value="{{ $academy_event->ends_at }}" class="form-control @if ($errors->has('ends_at')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
                                        <span id="NameError" class="error invalid-feedback">
                                            @if ($errors->has('ends_at'))
                                            {{ $errors->first('ends_at') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputName">Address Line 1</label>
                                        <input type="text" name="address_line_1" value="{{ $academy_event->address_line_1 }}" class="form-control @if ($errors->has('address_line_1')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
                                        <span id="NameError" class="error invalid-feedback">
                                            @if ($errors->has('address_line_1'))
                                            {{ $errors->first('address_line_1') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputName">Address Line 2</label>
                                        <input type="text" name="address_line_2" value="{{ $academy_event->address_line_2 }}" class="form-control @if ($errors->has('address_line_2')) is-invalid @endif" id="InputName" placeholder="Please Enter" aria-describedby="NameError" aria-invalid="true">
                                        <span id="NameError" class="error invalid-feedback">
                                            @if ($errors->has('address_line_2'))
                                            {{ $errors->first('address_line_2') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if (isset($tags))
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputName">Select Event Tags :</label>
                                        <select multiple aria-describedby="TagsError" aria-invalid="true" id="tags_drop_down" class="form-control curr-sym @if ($errors->has('tags')) is-invalid @endif" name="tags[]">
                                            @if (count($tags) > 0)
                                            <option value="">Select Event Tag</option>
                                            @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option value="">No Event Tag Exists</option>
                                            @endif
                                        </select>
                                        <span id="TagsError" class="error invalid-feedback">
                                            @if ($errors->has('tags'))
                                            {{ $errors->first('tags') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @endif
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="InputImage">Choose Pciture</label>
                                        <input type="hidden" name="image" class="image" value="">
                                        <input type="file" name="imageFile" class="form-control imageFile @if ($errors->has('image')) is-invalid @endif" id="InputImage" placeholder="Select image" aria-describedby="ImageError" aria-invalid="true">
                                        <span id="ImageError" class="error invalid-feedback">
                                            @if ($errors->has('image'))
                                            {{ $errors->first('image') }}
                                            @endif
                                        </span>
                                        @if ($academy_event->image)
                                        <div class="custom-file-preview">
                                            <img src="{{ url($academy_event->image) }}" width="75px" height="75px" alt="{{ $academy_event->name }}">
                                        </div>
                                        @else
                                        <div class="custom-file-preview">
                                            -- No Image Selected
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="customSwitch1">Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="is_active" value="1" @if ($academy_event->is_active) checked @endif class="custom-control-input"
                                            id="customSwitch1" aria-describedby="IsActiveError" aria-invalid="true">
                                            <label class="custom-control-label" for="customSwitch1">Select Event To Be
                                                Active
                                                Or Not</label>
                                        </div>
                                        <span id="IsActiveError" class="error invalid-feedback">
                                            {{-- @if ($errors->has('is_active'))
                                            {{ $errors->first('is_active') }}
                                            @endif --}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-3 py-1">Update</button>
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
       var divIndex = 0;
        $(document).ready(function() {

            var eventSponsors = {!! json_encode($academy_event->sponsers) !!};
            for (let index = 0; index < eventSponsors.length; index++) {
                const dynamicFields = document.getElementById("dynamic-fields");
                const newRow = document.createElement("div");
                newRow.classList.add("dynamic-field-row");
                divIndex = divIndex + 1;
                newRow.innerHTML = `
                          <button type="button" style="margin-top:31px" class="btn btn-primary float-right "
                           onclick="removeField(this)" class="remove-field">X</button>
                              <div class="row">
                                <div class="col-md-12 ">
                                 <div class="row">
                                    <div class="col-md-6 pl-0">
                                        <div class="form-group">
                                            <label for="InputSponserName">Sponser Name</label>
                                            <input required type="text" value="${eventSponsors[index].name}"  name="sponsers[${divIndex}][name]"}}"
                                                class="form-control @if ($errors->has('sponsers[${divIndex}][name]')) is-invalid @endif"
                                                id="InputSponserName" placeholder="Enter Sponser Name" aria-describedby="SponserNameError"
                                                aria-invalid="true">
                                            <span id="SponserNameError" class="error invalid-feedback">
                                                @if ($errors->has('sponsers[${divIndex}][name]'))
                                                    {{ $errors->first('sponsers[${divIndex}][name]') }}
                                                @endif
                                            </span>
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="InputImage">Choose Picture</label>
                                            <input required type="file" value="${eventSponsors[index].image}" name="sponsers[${divIndex}][image]"
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
                                    </div>

                                </div>



                                    </div>`;
                dynamicFields.appendChild(newRow);

            }
            // <div class="custom-file-preview">
            //                                     <img src="${eventSponsors[index].image}" width="75px" height="75px" alt="${eventSponsors[index].name}">
            //                                 </div>
            // CKEDITOR.replace('discription_editor');
            document.getElementById("add-field").addEventListener("click", function() {
                // Create a new dynamic field row
                const dynamicFields = document.getElementById("dynamic-fields");
                const newRow = document.createElement("div");
                newRow.classList.add("dynamic-field-row");
                divIndex = divIndex + 1;
                newRow.innerHTML = `

<button style="margin-top:31px" type="button" class="btn btn-primary float-right" onclick="removeField(this)" class="remove-field">X
    </button>

       <div class="row">
            <div class="col-md-6">
                <div class="row">
                      <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputSponserName">Sponser Name</label>
                                <input type="text" required name="sponsers[${divIndex}][name]"}}"
                                      class="form-control @if ($errors->has('sponsers[${divIndex}][name]')) is-invalid @endif"
                                  id="InputSponserName" placeholder="Enter Sponser Name"              aria-describedby="SponserNameError"
                                       aria-invalid="true">
                               <span id="SponserNameError" class="error invalid-feedback">
                                     @if ($errors->has('sponsers[${divIndex}][name]'))
                                     {{ $errors->first('sponsers[${divIndex}][name]') }}
                                     @endif
                    </span>
                   </div>
                   </div>
                    </div>
                    </div>
                    <div class="col-md-6" >
                    <div class="form-group">
                        <label for="InputImage">Choose Picture</label>
                         <input type="file" name="sponsers[${divIndex}][image]"
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
            divIndex = divIndex + 1;
            const rowToRemove = button.parentElement;
            console.log(rowToRemove);
            document.getElementById("dynamic-fields").removeChild(rowToRemove);
        }
</script>
@include('super_admins.includes.image_cropper_scripts')
@endsection
