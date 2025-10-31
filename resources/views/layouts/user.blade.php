<!DOCTYPE html>
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @include('partials.seo')

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}"/>
    <script src="{{asset('js/fontawesomepro.js')}}"></script>

    @stack('css-lib')

    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>

    @stack('style')
</head>


<body>
    <!-- content -->
        <div class="overlay mb-4">

            <!-- main -->
            @yield('content')

        </div>


@stack('loadModal')

@stack('extra-content')


<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/chart.min.js')}}"></script>

@stack('extra-js')
{{--
<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script> --}}
<script src="{{asset('js/user-panel.js')}}"></script>

@stack('script')

@include('plugins')

</body>
</html>
