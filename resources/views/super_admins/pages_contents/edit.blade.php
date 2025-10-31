@extends('super_admins.layouts.master')

@section('title')
    {{ $heading }}
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
                    <h1> {{ $heading }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> {{ $heading }} </li>
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

                        <div class="card-body">

                            <form method="POST" action="{{ route('super_admin.pages_contents.update') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <table id="" class="table ">
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Sr#</th>--}}
{{--                                        <th>Name</th>--}}
{{--                                        <th>Value</th>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

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
                                                @foreach ($pages_contents as $pages_content)
{{--                                                    <div>{{ $pages_content->display_name }}</div>--}}
                                                        <input class="form-control" type="hidden" name="page_content_name[]"
                                                               value="{{ $pages_content->name }} ">
                                                        <input class="form-control" type="hidden" name="page_content_type[]"
                                                               value="{{ $pages_content->type }} ">

                                                        @if ($pages_content->type == 'image')
                                                            @if ($pages_content->value)
                                                                <img src="{{ url($pages_content->value) }}" width="75px"
                                                                     height="75px" alt="{{ $pages_content->name }}">
                                                                &nbsp &nbsp
                                                            @else
                                                                -No Image Selected
                                                            @endif
                                                            <input class="form-control" type="hidden" name="page_content_value[]"
                                                                   value="{{ $pages_content->type }} ">
                                                            <input type="file" name="{{ $pages_content->name }}"
                                                                   class="form-control @if ($errors->has($pages_content->name)) is-invalid @endif"
                                                                   id="Input{{ $pages_content->name }}"
                                                                   placeholder="Select {{ $pages_content->display_name }}"
                                                                   aria-describedby="{{ $pages_content->name }}Error"
                                                                   aria-invalid="true">
                                                            <span id="{{ $pages_content->name }}Error"
                                                                  class="error invalid-feedback">
                                                            @if ($errors->has($pages_content->name))
                                                                    {{ $errors->first($pages_content->name) }}
                                                                @endif
                                                        </span>
                                                        @elseif($pages_content->type == 'textarea')

                                                        <div class="form-group">
                                                            <label for="InputDescription">{{$pages_content->display_name}} ({{$language->code}})</label>
                                                            <textarea name="data[{{$pages_content->name}}][{{$language->code}}]" id="{{$pages_content->name}}_{{$language->code}}"
                                                                      class="form-control @if ($errors->has($pages_content->name.'.'.$language->code)) is-invalid @endif" rows="3" placeholder="Please Enter"
                                                                      aria-describedby="DescriptionError-{{$language->code}}" aria-invalid="true">{{ $pages_content->getTranslation('value', $language->code); }}</textarea>
                                                            <span id="DescriptionError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has($pages_content->name.'.'.$language->code))
                                                                    {{ $errors->first($pages_content->name.'.'.$language->code) }}
                                                                @endif
                                                     </span>
                                                        </div>
{{--                                                        <script>--}}
{{--                                                                $(document).ready(function() {--}}
{{--                                                                    ClassicEditor.create(document.querySelector('#discription_editor_{{$language->code}}')).catch(error => { console.error(error); });--}}
{{--                                                                });--}}
{{--                                                            </script>--}}
                                                        @else
                                                        <div class="form-group">
                                                            <label for="InputName-{{$language->code}}">{{$pages_content->display_name}} ({{$language->code}})</label>
                                                            <input type="text" name="data[{{$pages_content->name}}][{{$language->code}}]" value="{{ $pages_content->getTranslation('value', $language->code); }}"
                                                                   class="form-control @if ($errors->has($pages_content->name.'.'.$language->code)) is-invalid @endif"
                                                                   id="InputName-{{$language->code}}" placeholder="Please Enter" aria-describedby="NameError-{{$language->code}}"
                                                                   aria-invalid="true">
                                                            <span id="NameError-{{$language->code}}" class="error invalid-feedback">
                                                    @if ($errors->has($pages_content->name.'.'.$language->code))
                                                                    {{ $errors->first($pages_content->name.'.'.$language->code) }}
                                                                @endif
                                                </span>
                                                        </div>
                                                        @endif


                                                    @endforeach

                                            </div>
                                        @endforeach
                                    </div>
                                        @php
                                            $i++;
                                        @endphp
                                    </tbody>

                                </table>

                                <button type="submit" class="btn btn-primary">Update</button>

                            </form>
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

            @foreach ($active_languages as $key => $language)
            @foreach ($pages_contents as $pages_content)
            @if($pages_content->type == 'textarea')
            // CKEDITOR.replace('{{$pages_content->name}}_{{$language->code}}');
            ClassicEditor.create(document.querySelector('#{{$pages_content->name}}_{{$language->code}}')).catch(error => { console.error(error); });
            @endif
            @endforeach
            @endforeach
        });
    </script>
@endsection
