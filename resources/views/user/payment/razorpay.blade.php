@extends('layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')

    <section id="dashboard">
        <div class="container add-fund">
            <div class="row">
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
                                    <form action="{{$data->url}}" method="{{$data->method}}">
                                        <script src="{{$data->checkout_js}}"
                                                @foreach($data->val as $key=>$value)
                                                data-{{$key}}="{{$value}}"
                                            @endforeach >
                                        </script>
                                        <input type="hidden" custom="{{$data->custom}}" name="hidden">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready(function () {
                $('input[type="submit"]').addClass("btn greenColorBg mt-3");
                $('input[type="submit"]').click();
            })
        </script>
    @endpush
@endsection




