@extends('layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')

    <section id="dashboard">
        <div class="container add-fund">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card secbg">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{$order->gateway->image}}"
                                        class="card-img-top gateway-img br-4" alt="..">
                                </div>
                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                    {{-- <h4 class="mt-15 mb-15">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4> --}}

                                    <button type="button" class="btn greenColorBg mt-3" id="btn-confirm"
                                            onClick="payWithRave()">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- @push('script') --}}
        <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
        <script>
            var btn = document.querySelector("#btn-confirm");
            btn.setAttribute("type", "button");
            const API_publicKey = "{{$data->API_publicKey ?? ''}}";
            // const API_publicKey = "FLWPUBK_TEST-361fcefccf136098e8c7a5763ce70f74-X"
            function payWithRave() {
                console.log('hekllo')
                var x = getpaidSetup({
                    PBFPubKey: API_publicKey,
                    student_email: "{{$data->student_email ?? 'example@example.com'}}",
                    amount: "{{ $data->amount ?? '0' }}",
                    student_phone: "{{ $data->student_phone ?? '0123' }}",
                    currency: "{{ $data->currency ?? 'USD' }}",
                    txref: "{{ $data->txref ?? '' }}",
                    onclose: function () {
                    },
                    callback: function (response) {
                        let txref = response.tx.txRef;
                        let status = response.tx.status;
                        window.location = '{{ url('payment/flutterwave') }}/' + txref + '/' + status;
                    }
                });
            }
        // </script>
    {{-- @endpush --}}
@endsection
