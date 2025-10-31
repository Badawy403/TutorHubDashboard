@extends('super_admins.layouts.master')

@section('title')
    Edit Withdraw Request
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
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.withdraw_requests.index') }}">
                                Withdraw Requests</a></li>
                        <li class="breadcrumb-item active">
                            Edit Withdraw Request
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
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Withdraw Request
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" method="POST"
                            action="{{ route('super_admin.withdraw_requests.update', ['withdraw_request' => $withdraw_request->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputFirstName">Name</label>
                                        <input type="text" name="name" disabled
                                            value="{{ $withdraw_request->user->name }}"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            id="InputFirstName" placeholder="Please Enter" aria-describedby="FirstNameError"
                                            aria-invalid="true">
                                        <span id="FirstNameError" class="error invalid-feedback">
                                            @if ($errors->has('name'))
                                                {{ $errors->first('name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Code</label>
                                        <input type="text" name="code" disabled value="{{ $withdraw_request->code }}"
                                            class="form-control @if ($errors->has('code')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('code'))
                                                {{ $errors->first('code') }}
                                            @endif
                                        </span>
                                    </div>
                                </div> --}}

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Amount</label>
                                        <input type="text" name="amount" disabled
                                            value="{{ $withdraw_request->amount }}"
                                            class="form-control @if ($errors->has('amount')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('amount'))
                                                {{ $errors->first('amount') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Account Holder Name</label>
                                        <input type="text" name="account_holder" disabled
                                            value="{{ $withdraw_request->account_holder }}"
                                            class="form-control @if ($errors->has('account_holder')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('account_holder'))
                                                {{ $errors->first('account_holder') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Acount Number</label>
                                        <input type="text" name="account_number" disabled
                                            value="{{ $withdraw_request->account_number }}"
                                            class="form-control @if ($errors->has('account_number')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('account_number'))
                                                {{ $errors->first('account_number') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Bank Name</label>
                                        <input type="text" name="bank" disabled
                                            value="{{ $withdraw_request->bank }}"
                                            class="form-control @if ($errors->has('bank')) is-invalid @endif"
                                            id="InputLastName" placeholder="Please Enter" aria-describedby="LastNameError"
                                            aria-invalid="true">
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('bank'))
                                                {{ $errors->first('bank') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Additional Note</label>
                                        <textarea name="additional_note" class="form-control" disabled id="" cols="30" rows="10">{{$withdraw_request->additional_note}}</textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InputLastName">Status</label>
                                        <div class="input-group ">
                                            <select name="status" class="form-control" id="status">
                                                <option @if ($withdraw_request->status == 'pending') selected @endif value="pending">
                                                    Pending</option>
                                                <option @if ($withdraw_request->status == 'approved') selected @endif value="approved">
                                                    Approved</option>
                                                <option @if ($withdraw_request->status == 'rejected') selected @endif value="rejected">
                                                    Rejected</option>
                                            </select>
                                        </div>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('status'))
                                                {{ $errors->first('status') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6" id="reasonField" style="display: none;">
                                    <div class="form-group">
                                        <label for="InputLastName">Reaject Reason</label>
                                        <div class="input-group ">
                                            <textarea class="form-control" name="rejected_reason" cols="30" rows="10">{{$withdraw_request->rejected_reason}}</textarea>
                                        </div>
                                        <span id="LastNameError" class="error invalid-feedback">
                                            @if ($errors->has('status'))
                                                {{ $errors->first('status') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <br>
                              <div class="col-md-12">
                                <button type="submit" class="btn btn-primary px-3 py-1 rounded-3">Update</button>
                              </div>
                            {{-- </div> --}}
                        </form>
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
    @include('super_admins.includes.image_cropper_modal')
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('discription_editor');
        });
    </script>
    <script>
        "use strict";

        $(document).ready(function() {
            // setCurrency();
            $(document).on('change', '.currency-change', function() {
                // setCurrency();
            });

            // function setCurrency() {
            //     let currency = $('.currency-change').val();
            //     let fiatYn = $('.currency-change option:selected').attr('data-fiat');
            //     if(fiatYn == 0){
            //         $('.set-currency').text(currency);
            //     }else{
            //         $('.set-currency').text('USD');
            //     }
            // }

            $(document).on('click', '.copy-btn', function() {
                var _this = $(this)[0];
                var copyText = $(this).parents('.input-group-append').siblings('input');
                $(copyText).prop('disabled', false);
                copyText.select();
                document.execCommand("copy");
                $(copyText).prop('disabled', true);
                $(this).text('Coppied');
                setTimeout(function() {
                    $(_this).text('');
                    $(_this).html('<i class="fas fa-copy"></i>');
                }, 500)
            });

            $('#image').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            var statusSelect = $('#status');
            var reasonField = $('#reasonField');

            // Initial check
            toggleReasonField();

            // Attach change event listener
            statusSelect.change(function() {
                toggleReasonField();
            });

            function toggleReasonField() {
                // Show the field if the selected value is "reject", otherwise hide it
                reasonField.toggle(statusSelect.val() === 'rejected');
            }
        });
    </script>
    @include('super_admins.includes.image_cropper_scripts')
@endsection
