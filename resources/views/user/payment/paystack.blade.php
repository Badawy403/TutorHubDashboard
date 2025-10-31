@extends('layouts.user')
@section('title')
    {{ 'Pay with ' . optional($order->gateway)->name ?? '' }}
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
                                    <img src="{{ $order->gateway->image }}" class="card-img-top gateway-img" alt="..">
                                </div>

                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{ getAmount($order->final_amount) }}
                                        {{ $order->gateway_currency }}</h4>
                                    <button type="button" class="btn greenColorBg mt-3"
                                        id="btn-confirm">@lang('Pay Now')</button>
                                    <form
                                        action="{{ route('ipn', [optional($order->gateway)->code, $order->transaction]) }}"
                                        method="POST">
                                        @csrf
                                        <script src="//js.paystack.co/v1/inline.js" data-key="{{ $data->key }}" data-email="{{ $data->email }}"
                                            data-amount="{{ $data->amount }}" data-currency="{{ $data->currency }}" data-ref="{{ $data->ref }}"
                                            data-custom-button="btn-confirm"></script>
                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
