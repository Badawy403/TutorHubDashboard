@php
    $site_title = App\Models\GeneralSetting::where('name' , 'site_title')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ $site_title && $site_title->value ? $site_title->value : env('APP_NAME')}}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    @yield('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}"> --}}
    {{-- custom css  --}}
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">




</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

body{
    font-family: "Roboto", "san-serif";
}
:root {
    --primary: #0A93E2;
    --secondary:  #0B0C2A;
    --body-bg : #E8F2FC;
    --white : #fff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #E7F4FC !important;
}

.btn-primary{
    background-color: var(--primary);
    border-color: var(--primary);
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:not(:disabled):not(.disabled):active{
    background-color: var(--primary);
    border-color: var(--primary);
}
.btn-secondary{
    background-color: var(--secondary);
    border-color: var(--secondary);
}
.btn-secondary:hover,
.btn-secondary:focus,
.btn-secondary:not(:disabled):not(.disabled):active{
    background-color: #1a2022;
    border-color: #1a2022;
}

.sidebar-mini .main-sidebar .nav-link-active{
    /* background-color: var(--body-bg); */

    background: -webkit-linear-gradient(to left, var(--secondary), #4286f4);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, var(--secondary), #4286f4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    position: relative;
    z-index: 1;
    text-align: left;
    border-radius: 15px 0 0 15px;
    margin: 10px auto 10px 9px;
    border: 0 solid transparent;
    border-right: 0;
    color: var(--white);
    width: 100%;
}
.sidebar {
  height: calc(100% - (3.5rem + 1px));
  overflow-x: none;
  overflow-y: initial;
  padding-bottom: 0;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  padding-top: 0;
  -ms-overflow-style: -ms-autohiding-scrollbar;
  scrollbar-width: thin;
  scrollbar-color: #fff transparent;
}
.content-wrapper {
    background-color: var(--body-bg);
}
.sidebar-mini .main-sidebar .nav-link{
    font-size: 14px;
    color: var(--white);
    width: 100%;
    font-weight: 400;
    padding: 5px 15px 5px 5px;
    line-height: 35px;
    margin-left: 9px;

}
.sidebar-mini .main-sidebar .nav-link .text{
    transition: all 0.5s ease-in;
    color: var(--white);
}
.sidebar-mini .main-sidebar  .nav-link .icon-size{
    font-size: 18px;
    line-height: 0;
    margin-right: 10px;
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    /* border-radius: 50%;
    box-shadow: 0 5px 10px rgba(0,0,0,.2); */
}
.sidebar-mini .main-sidebar  .nav-link-active .icon-size{

    color: white;
}

</style>
