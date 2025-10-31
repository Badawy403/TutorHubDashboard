@extends('super_admins.layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card small-box h-100 py-4 " style="background-color: var(--primary);height: 240px !important;
                    border-radius: 30px;">
                        <div class="card-body d-flex justify-content-center align-items-center h-100">
                            <div class="d-flex justify-content-start flex-column align-items-start flex-wrap w-100">
                                <div class="icon d-flex justify-content-center mb-3 ml-3"
                                style="width: 70px;height:70px;border-radius:50%;background-color:#f1efeb">
                               <img src="{{url('assets/Images/dashboard-image-1.png')}}" alt="dashboard-image-1.png">
                                </div>
                                <div class="inner ml-3">
                                    <p class="text-white fw-bold mb-0">Total Tutors</p>
                                    <h3 class="fw-bold mb-0" style="color:white">{{ $data['totalTeachers'] ?? 0 }} Tutors
                                    </h3>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="card-footer py-2 bg-primary"
                            style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3" >
                    <div class="card small-box h-100 py-4" style="height: 240px !important; border-radius: 30px;">
                        <div class="card-body d-flex justify-content-center align-items-center h-100">
                            <div class="d-flex justify-content-start flex-column align-items-start flex-wrap w-100">
                                <div class="icon d-flex justify-content-center mb-3 ml-3"
                                style="width: 70px;height:70px;border-radius:50%;background-color:#f1efeb">
                                <img src="{{url('assets/Images/total-students.png')}}" alt="total-users.png">
                              </div>
                                <div class="inner">
                                    <p class="text-dark fw-bold mb-0">Total Students</p>
                                    <h3 class="fw-bold mb-0" style="color:#0A93E2;">{{ $data['totalUsers'] ?? 0 }} Students</h3>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="card-footer py-2 bg-primary"
                            style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                        </div> --}}
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-6">
                                                                                                        <div class="small-box bg-primary">
                                                                                                            <div class="icon">
                                                                                                                <i class="ion ion-ios-paper"></i>
                                                                                                            </div>
                                                                                                            <div class="inner">
                                                                                                                <h3>{{ $data['totalBlogCategories'] }}</h3>
                                                                                                                <p>Total Blog Categories</p>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                    </div> -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card small-box bg-white h-100 py-4" style="height: 240px !important; border-radius: 30px;">
                        <div class="card-body d-flex justify-content-center align-items-center h-100">
                            <div class="d-flex justify-content-start flex-column align-items-start flex-wrap w-100">
                                <div class="icon d-flex justify-content-center mb-3 ml-3"
                                    style="width: 70px;height:70px;border-radius:50%;background-color:#f1efeb">
                                   <img src=" {{url('assets/Images/subscription.png')}}" alt="">
                                </div>
                                <div class="inner">
                                    <p class="text-dark fw-bold mb-0">Total Subscriptions</p>
                                    <h3 class="fw-bold mb-0" style="color:#0A93E2">{{ $data['totalSubscriptions'] }} Subscriptions</h3>
                                </div>


                            </div>
                        </div>
                        {{-- <div class="card-footer py-2 bg-primary"
                            style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card small-box bg-white h-100 py-4" style="height: 240px !important;border-radius: 30px;">
                        <div class="card-body d-flex justify-content-center align-items-center h-100">
                            <div class="d-flex justify-content-start flex-column align-items-start flex-wrap w-100">

                                <div class="icon d-flex justify-content-center mb-3 ml-3"
                                    style="width: 70px;height:70px;border-radius:50%;background-color:#f1efeb">
                                   <img src=" {{url('assets/Images/events-dashboard.png')}}" alt="events-dashboard">
                                </div>
                                <div class="inner">
                                    <p class="text-dark fw-bold mb-0">Total Events</p>
                                    <h3 class="fw-bold mb-0" style="color:#0A93E2;">{{ $data['totalEvents'] ?? 0 }} Events</h4>
                                </div>


                            </div>
                        </div>
                        {{-- <div class="card-footer py-2 bg-primary"
                            style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="fw-bold mt-4 mb-0">Total Students</h3>
                                <!-- <a href="javascript:void(0);">View Report</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{ $data['totalUsers'] ?? 0 }}</span>
                                    <span>Students Over Time</span>
                                </p>
                                <!-- <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Since last week</span>
                                </p> -->
                            </div>

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="visitors-chart" height="400" width="2184"
                                    style="display: block; width: 1092px; height: 200px;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square" style=" color : #0A93E2"></i> This Week
                                </span>
                                <span>
                                    <i class="fas fa-square" style=" color : #232a2d "></i> Last Week
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="fw-bold mt-4 mb-0">Total Appointments</h3>
                                <!-- <a href="javascript:void(0);">View Report</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{ $data['totalBookedAppointments'] ?? 0 }}</span>
                                    <span>Appointments Over Time</span>
                                </p>
                                <!-- <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 33.1%
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p> -->
                            </div>

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas height="400"
                                id="sales-chart"
                                    style="display: block; width: 1092px; height: 200px;" width="2184"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square" style=" color : #0A93E2"></i> This year
                                </span>
                                <span>
                                    <i class="fas fa-square" style=" color : #232a2d "></i> Last year
                                </span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    {{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">teachers Members</h3>
                            <div class="card-tools">
                                <span class="badge badge-danger">8 New Members</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                <li>
                                    <img src="../dist/img/user1-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Alexander Pierce</a>
                                    <span class="users-list-date">Today</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user8-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Norman</a>
                                    <span class="users-list-date">Yesterday</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user7-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Jane</a>
                                    <span class="users-list-date">12 Jan</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user6-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">John</a>
                                    <span class="users-list-date">12 Jan</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user2-160x160.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Alexander</a>
                                    <span class="users-list-date">13 Jan</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user5-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Sarah</a>
                                    <span class="users-list-date">14 Jan</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user4-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Nora</a>
                                    <span class="users-list-date">15 Jan</span>
                                </li>
                                <li>
                                    <img src="../dist/img/user3-128x128.jpg" alt="User Image">
                                    <a class="users-list-name" href="#">Nadia</a>
                                    <span class="users-list-date">15 Jan</span>
                                </li>
                            </ul>

                        </div>

                        <div class="card-footer text-center">
                            <a href="javascript:">View All Users</a>
                        </div>

                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Appointments Total</h3>
                                <!-- <a href="javascript:void(0);">View Report</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">$18,230.00</span>
                                    <span>Sales Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 33.1%
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p>
                            </div>

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="sales-chart" height="400"
                                    style="display: block; width: 532px; height: 200px;" width="1064"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This year
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Last year
                                </span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section> --}}



    {{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Online Store Visitors</h3>
                                <!-- <a href="javascript:void(0);">View Report</a> -->
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Products</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Some Product
                                        </td>
                                        <td>$13 USD</td>
                                        <td>
                                            <small class="text-success mr-1">
                                                <i class="fas fa-arrow-up"></i>
                                                12%
                                            </small>
                                            12,000 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Another Product
                                        </td>
                                        <td>$29 USD</td>
                                        <td>
                                            <small class="text-warning mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                0.5%
                                            </small>
                                            123,234 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Amazing Product
                                        </td>
                                        <td>$1,230 USD</td>
                                        <td>
                                            <small class="text-danger mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                3%
                                            </small>
                                            198 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Perfect Item
                                            <span class="badge bg-danger">NEW</span>
                                        </td>
                                        <td>$199 USD</td>
                                        <td>
                                            <small class="text-success mr-1">
                                                <i class="fas fa-arrow-up"></i>
                                                63%
                                            </small>
                                            87 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>



            </div>

        </div>

    </section> --}}






@endsection
@section('scripts')
    <script>
        var thisYearData = {!! json_encode($data['appointmentRecordsByMonthsKeyed']) !!};
        var lastYearData = {!! json_encode($data['appointmentRecordsByLasteYearMonthsKeyed']) !!};

        var currentWeekStudents = {!! json_encode($data['currentWeekStudents']) !!};
        var lastWeekStudents = {!! json_encode($data['lastWeekStudents']) !!};

        var totalStudents = {!! json_encode($data['totalUsers']) !!};
        if(lastWeekStudents !== null && lastWeekStudents !== undefined){
            var currentWeekStudentsLabel = Object.keys(currentWeekStudents);
          var currentWeekStudentsValues = Object.values(currentWeekStudents);
                  if(lastWeekStudents !== null && lastWeekStudents !== undefined){
            var lastWeekStudentsLabel = Object.keys(lastWeekStudents);
          var lastWeekStudentsValues = Object.values(lastWeekStudents);
        }
        }
$(function(){'use strict'
var ticksStyle={fontColor:'#495057',fontStyle:'bold'}
var mode='index'
var intersect=true
var $salesChart=$('#sales-chart')
var salesChart=new Chart($salesChart,
{type:'bar',data:
    {labels:['JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
        datasets:[
            {backgroundColor:'#0A93E2',
            borderColor:'#0A93E2',data:[thisYearData.June ?? 0,thisYearData.July ?? 0 ,thisYearData.August ?? 0,thisYearData.September ?? 0,thisYearData.October ?? 0,thisYearData.November ?? 0,thisYearData.December ?? 0,thisYearData.Total ?? 0]}
            ,
            {backgroundColor:'#000',borderColor:'#232a2d',data:[lastYearData.June ?? 0,lastYearData.July ?? 0 ,lastYearData.August ?? 0,lastYearData.September ?? 0,lastYearData.October ?? 0,lastYearData.November ?? 0,lastYearData.December ?? 0,thisYearData.Total ?? 0]}]
        },
            options:{maintainAspectRatio:false,tooltips:{mode:mode,intersect:intersect},hover:{mode:mode,intersect:intersect},
            legend:{display:false},
            scales:{yAxes:
                [{gridLines:{display:true,lineWidth:'4px',color:'rgba(0, 0, 0, .2)',
                zeroLineColor:'transparent'},ticks:$.extend({beginAtZero:true,callback:function(value){if(value>=1000){value/=1000
value+=''}
return '-'+value}},ticksStyle)}],xAxes:[{display:true,gridLines:{display:false},ticks:ticksStyle}]}}})
var $visitorsChart=$('#visitors-chart')
var visitorsChart=new Chart($visitorsChart,{data:
    {labels:currentWeekStudentsLabel.concat(lastWeekStudentsLabel) ?? [],
        datasets:[{type:'line',data:currentWeekStudentsValues ?? [],
            backgroundColor:'transparent',borderColor:'#0A93E2',pointBorderColor:'#0A93E2',pointBackgroundColor:'#0A93E2',fill:false},
            {type:'line',data:lastWeekStudentsValues ?? [] ,backgroundColor:'tansparent',borderColor:'#232a2d',pointBorderColor:'#232a2d',pointBackgroundColor:'#232a2d',fill:false}]},
            options:{maintainAspectRatio:false,tooltips:{mode:mode,intersect:intersect},hover:{mode:mode,intersect:intersect},legend:{display:false},scales:{yAxes:[{gridLines:{display:true,lineWidth:'4px',color:'rgba(0, 0, 0, .2)',zeroLineColor:'transparent'},ticks:$.extend({beginAtZero:true,suggestedMax:totalStudents ?? 0},ticksStyle)}],xAxes:[{display:true,gridLines:{display:false},ticks:ticksStyle}]}}})})
    </script>
@endsection
