@extends('admin.master')

@section('title', 'MBK - Dashboard')

@section('modified-style')
    <style type="text/css">
        .card{
            margin: 10px 0px 20px 0px;
        }

        #main .card{
            padding: 0px;
        }

        #quick-stat p{
            font-size: 13px;
            margin: 0px 0px 10px 0px;
        }

        #quick-stat h5{
            margin: 0px 0px 5px 0px
        }

        .card h6{
            margin: 5px 0px 0px 0px;
        }

        .card small{
            font-size: 12px;
        }

        table thead tr th,
        table tbody tr td{
            font-size: 13px;
        }

        .table th{
            border-top: none;
        }

        table tbody tr{
            cursor: pointer;
        }

        .table tbody tr{
            transition: all ease 0.3s;
        }

        .table tbody tr:hover{
            background: #2196F3;
        }

        .table tbody tr:hover td{
            color: #FFFFFF;
        }
    </style>
@endsection

@section('content')
    <!-- Page Content Holder -->
    <div id="content" class="bg-light-gray">
        <!-- <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                        <i class="glyphicon glyphicon-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                    </ul>
                </div>
            </div>
        </nav> -->
        <div class="row" style="margin-bottom: 30px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2>Hi {!! ucwords(Auth::user()->first_name) !!},</h2>
                <small>Welcome back to your dashboard!</small>
            </div>
        </div>

        <div class="row">
            <div class="col"><small>Quick Statistics</small></div>
        </div>

        <div class="row" id="quick-stat">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card bg-blue card-light text-white">
                    <p>Total Inquiries</p>
                    <h3><b>{!! $total_inquiries !!}</b></h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card bg-green card-light text-white">
                    <p>Total Tour Clients</p>
                    <h3><b>{!! $total_tour_clients !!}</b></h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card bg-amber card-light text-white">
                    <p>Total Registered Users</p>
                    <h3><b>{!! $total_registered_users !!}</b></h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card bg-pink card-light text-white">
                    <p>Total Revenue</p>
                    <h3><b>₱ {!! number_format($total_revenue, 2, '.', ',') !!}</b></h3>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col"><small>Inquiries and Orders</small></div>
        </div>

        <div class="row" id="main" style="margin-top: 10px">
            <div class="col">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a href="#pills-tourpackage" class="nav-link active" id="pills-tourpackage-tab" data-toggle="pill" role="tab" aria-controls="pills-tourpackage" aria-expanded="true">Custom Tour Inquiries 
                        @if (count($custom_tour_pending) > 0)
                            <span class="badge badge-danger">{!! count($custom_tour_pending) !!}</span>
                        @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-flight" class="nav-link" id="pills-flight-tab" data-toggle="pill" role="tab" aria-controls="pills-flight" aria-expanded="true">Flight Reservation Inquiries 
                        @if (count($flight_reservation_pending) > 0)
                            <span class="badge badge-danger">{!! count($flight_reservation_pending) !!}</span>
                        @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-hotel" class="nav-link" id="pills-hotel-tab" data-toggle="pill" role="tab" aria-controls="pills-hotel" aria-expanded="true">Hotel Reservation Inquiries 
                        @if (count($hotel_reservation_pending) > 0)
                            <span class="badge badge-danger">{!! count($hotel_reservation_pending) !!}</span>
                        @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-bus" class="nav-link" id="pills-bus-tab" data-toggle="pill" role="tab" aria-controls="pills-bus" aria-expanded="true">Bus Booking Inquiries 
                        @if (count($bus_booking_pending) > 0)
                            <span class="badge badge-danger">{!! count($bus_booking_pending) !!}</span>
                        @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-van" class="nav-link" id="pills-van-tab" data-toggle="pill" role="tab" aria-controls="pills-van" aria-expanded="true">Van Rental Inquiries 
                        @if (count($van_rental_pending) > 0)
                            <span class="badge badge-danger">{!! count($van_rental_pending) !!}</span>
                        @endif
                        </a>
                    </li>
                </ul>   
                <div class="tab-content" style="margin-top: 20px;">
                    <!--===============================  CUSTOM TOUR PACKAGE  =============================-->
                    <div class="tab-pane fade show active" id="pills-tourpackage" role="tabpanel" aria-labelledby="pills-tourpackage-tab">
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Pending Custom Tour Inquiries</h6>
                                <small class="text-white">Click the row to cater inquiry</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="pending-tour-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Destination</th>
                                                <th class="text-center">Timeframe</th>
                                                <th>Budget</th>
                                                <th class="text-center">No. of PAX</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Custom Tour Inquiries</h6>
                                <small class="text-white">Click the row to view inquiry details</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="tour-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Destination</th>
                                                <th class="text-center">Timeframe</th>
                                                <th>Budget</th>
                                                <th class="text-center">No. of PAX</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--===============================  AIRLINE TICKETING  =============================-->
                    <div class="tab-pane fade" id="pills-flight" role="tabpanel" aria-labelledby="pills-flight-tab">
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Pending Flight Inquiries</h6>
                                <small class="text-white">Click the row to cater inquiry</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="pending-flight-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th class="text-center">From</th>
                                                <th class="text-center">To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Flight Inquiries</h6>
                                <small class="text-white">Click the row to view  thedetails</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="flight-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th class="text-center">From</th>
                                                <th class="text-center">To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--============================  HOTEL RESERVATION  ==========================-->
                    <div class="tab-pane fade" id="pills-hotel" role="tabpanel" aria-labelledby="pills-hotel-tab">
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Pending Hotel Inquiries</h6>
                                <small class="text-white">Click the row to cater inquiry</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="pending-hotel-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Location</th>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th class="text-center">No. of PAX</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Hotel Inquiries</h6>
                                <small class="text-white">Click the row to view the details</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="hotel-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Location</th>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th class="text-center">No. of PAX</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============================  BUS BOOKING  =============================-->
                    <div class="tab-pane fade" id="pills-bus" role="tabpanel" aria-labelledby="pills-bus-tab">
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Pending Bus Inquiries</h6>
                                <small class="text-white">Click the row to cater inquiry</small>
                            </div>
                            <div class="body">
                                <!-- For empty pending inquiries -->
                                <!-- <p class="text-center text-gray" style="margin-top: 15px">No Pending Bus Inquiries Yet</p> -->
                                <!-- For empty pending inquiries -->
                                <div class="table-responsive">
                                    <table class="table" id="pending-bus-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Bus Inquiries</h6>
                                <small class="text-white">Click the row to view the details</small>
                            </div>
                            <div class="body">
                                <!-- For empty pending inquiries -->
                                <!-- <p class="text-center text-gray" style="margin-top: 15px">No Pending Bus Inquiries Yet</p> -->
                                <!-- For empty pending inquiries -->
                                <div class="table-responsive">
                                    <table class="table" id="bus-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===============================  VAN RENTAL  =============================-->
                    <div class="tab-pane fade" id="pills-van" role="tabpanel" aria-labelledby="pills-van-tab">
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Pending Van Rental Inquiries</h6>
                                <small class="text-white">Click the row to cater inquiry</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="pending-van-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card white card-light">
                            <div class="head bg-blue">
                                <h6 class="text-white">Van Rental Inquiries</h6>
                                <small class="text-white">Click the row to view the details</small>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table" id="van-inquiries">
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Date Depart</th>
                                                <th>Date Return</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modals -->
    <!-- custom tour package -->
    <div class="modal fade" id="custom-tour-modal" tabindex="-1" role="dialog" aria-labelledby="customTourLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customTourLabel">Custom Tour Package Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-blue-dark">Client Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Client Name: </td>
                                    <td><b><span id="ctpi-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="ctpi-modal-birthday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="ctpi-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="ctpi-modal-email"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Custom Tour Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Desired Destination:</td>
                                    <td><b><span id="ctpi-modal-location"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Timeframe:</td>
                                    <td><b><span id="ctpi-modal-timeframe"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Budget:</td>
                                    <td><b><span id="ctpi-modal-budget"></span></b></td>
                                </tr>
                                <tr>
                                    <td>No. of PAX</td>
                                    <td><b><span id="ctpi-modal-pax"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Remark</td>
                                    <td><b><span id="ctpi-modal-remark"></span></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="ctpi-mark-processed-btn" ctpi_id="0">Mark as Processed</button>
                    <button type="button" class="btn btn-danger" id="ctpi-delete-btn" ctpi_id="0">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- flight reservation -->
    <div class="modal fade" id="flight-reservation-modal" tabindex="-1" role="dialog" aria-labelledby="flightReservationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="flightReservationLabel">Flight Rservation Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-blue-dark">Client Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Client Name:</td>
                                    <td><b><span id="fri-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="fri-modal-birthday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="fri-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="fri-modal-email"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Flight Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Flight Type:</td>
                                    <td><b><span id="fri-modal-flight-type"></span></b></td>
                                </tr>
                                <tr>
                                    <td>From:</td>
                                    <td><b><span id="fri-modal-from"></span></b></td>
                                </tr>
                                <tr>
                                    <td>To:</td>
                                    <td><b><span id="fri-modal-to"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Depart:</td>
                                    <td><b><span id="fri-modal-depart"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Return:</td>
                                    <td><b><span id="fri-modal-return"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Adult No.:</td>
                                    <td><b><span id="fri-modal-adult-no"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Child No.:</td>
                                    <td><b><span id="fri-modal-child-no"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Infant No.</td>
                                    <td><b><span id="fri-modal-infant-no"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Remark</td>
                                    <td><b><span id="fri-modal-remark"></span></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="fri-mark-processed-btn" fri_id="0">Mark as Processed</button>
                    <button type="button" class="btn btn-danger" id="fri-delete-btn" fri_id="0">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- hotel reservation -->
    <div class="modal fade" id="hotel-reservation-modal" tabindex="-1" role="dialog" aria-labelledby="hotelReservationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hotelReservationLabel">Hotel Reservation Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-blue-dark">Client Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Client Name:</td>
                                    <td><b><span id="hri-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="hri-modal-birthday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="hri-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="hri-modal-email"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Hotel Reservation Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Location:</td>
                                    <td><b><span id="hri-modal-location"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Check In:</td>
                                    <td><b><span id="hri-modal-check-in"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Check Out:</td>
                                    <td><b><span id="hri-modal-check-out"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Adult No.</td>
                                    <td><b><span id="hri-modal-adult-no"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Child No.</td>
                                    <td><b><span id="hri-modal-child-no"></span></b></td>
                                </tr>
                                <tr>
                                    <td>For Work</td>
                                    <td><b><span id="hri-modal-for-work"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><b><span id="hri-modal-remark"></span></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="hri-mark-processed-btn">Mark as Processed</button>
                    <button type="button" class="btn btn-danger" id="hri-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bus reservation -->
    <div class="modal fade" id="bus-booking-modal" tabindex="-1" role="dialog" aria-labelledby="busReservationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busReservationLabel">Bus Booking Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-blue-dark">Client Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Client Name:</td>
                                    <td><b><span id="bbi-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="bbi-modal-birthday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="bbi-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="bbi-modal-email"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Bus Booking Information</h6>
                            <table>
                                <tr>
                                    <td width="150">From:</td>
                                    <td><b><span id="bbi-modal-from"></span></b></td>
                                </tr>
                                <tr>
                                    <td>To:</td>
                                    <td><b><span id="bbi-modal-to"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Depart:</td>
                                    <td><b><span id="bbi-modal-departure"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Return:</td>
                                    <td><b><span id="bbi-modal-return"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Travel Type</td>
                                    <td><b><span id="bbi-modal-travel-type"></span></b></td>
                                </tr>
                                <tr>
                                    <td>ID Number:</td>
                                    <td><b><span id="bbi-modal-id-number"></span></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="bbi-mark-processed-btn">Mark as Processed</button>
                    <button type="button" class="btn btn-danger" id="bbi-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- van rental -->
    <div class="modal fade" id="van-rental-modal" tabindex="-1" role="dialog" aria-labelledby="vanRentalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vanRentalLabel">Van Rental Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-blue-dark">Client Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Client Name:</td>
                                    <td><b><span id="vr-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="vr-modal-birthday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="vr-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="vr-modal-email"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Van Rental Information</h6>
                            <table>
                                <tr>
                                    <td width="150">From:</td>
                                    <td><b><span id="vr-modal-from"></span></b></td>
                                </tr>
                                <tr>
                                    <td>To:</td>
                                    <td><b><span id="vr-modal-to"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Depart:</td>
                                    <td><b><span id="vr-modal-departure"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Date Return:</td>
                                    <td><b><span id="vr-modal-return"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Van Type:</td>
                                    <td><b><span id="vr-modal-van-type"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td><b><span id="vr-modal-remark"></span></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="vr-mark-processed-btn">Mark as Processed</button>
                    <button type="button" class="btn btn-danger" id="vr-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modified-script')
    <script type="text/javascript">
        //$(document).ready(function() {


            //===================  PENDING TOUR INQUIRIES  ===================//


            var pti_table = $('#pending-tour-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/custom-tour/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "location" },
                    { "data": "timeframe" },
                    { "data": "budget" },
                    { "data": "no_of_pax" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleCustomTour("+data.id+")");
                },
            }).columns.adjust().draw();


            var ti_table = $('#tour-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/custom-tour/get-all",
                
                "columns": [
                    { "data": "name" },
                    { "data": "location" },
                    { "data": "timeframe" },
                    { "data": "budget" },
                    { "data": "no_of_pax" },
                    { "data": "remark" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [5],
                        "width": "15%",
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleCustomTour("+data.id+")");
                },
            }).columns.adjust().draw();

            function toggleCustomTour(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/custom-tour/get-inquiry/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#ctpi-modal-name').html(data[0].name);
                        $('#ctpi-modal-birthday-age').html(data[0].bday_and_age);
                        $('#ctpi-modal-phone-number').html(data[0].phone_number);
                        $('#ctpi-modal-email').html(data[0].email);
                        $('#ctpi-modal-location').html(data[0].location);
                        $('#ctpi-modal-timeframe').html(data[0].timeframe);
                        $('#ctpi-modal-budget').html(data[0].budget);
                        $('#ctpi-modal-pax').html(data[0].no_of_pax);
                        $('#ctpi-modal-remark').html(data[0].remark);
                        if (data[0].status == 0) {
                            $('#ctpi-mark-processed-btn').show();
                            $('#ctpi-mark-processed-btn').attr('onclick', 'markAsProcessedCustomTour('+id+')');
                        }
                        else {
                            $('#ctpi-mark-processed-btn').hide();
                        }
                        
                        $('#ctpi-delete-btn').attr('onclick', 'deleteCustomTour('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#custom-tour-modal").modal("toggle");
            }

            function markAsProcessedCustomTour(id) {
                //
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/custom-tour/mark-as-processed/"+id,
                    delay: 250,
                    data: {
                        'id': id
                    },
                    beforeSend: function () {
                        $('#ctpi-mark-processed-btn').html('<i class="fa fa-spinner"></i> Loading...');
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        //console.log(data);
                        $('#ctpi-mark-processed-btn').html('Mark As Processed');
                        $("#custom-tour-modal").modal("toggle");
                        if (data == "success") {
                            swal({
                                title: "Success",
                                type: "success",
                                html: "<div class=\"swal-success-status\">The item has been marked as processed.</div>"
                            });
                        }
                        else {
                            swal({
                                title: "Error",
                                type: "error",
                                html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                            });
                        }
                        pti_table.ajax.reload();
                        ti_table.ajax.reload();
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
            }

            function deleteCustomTour(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete Inquiry?",
                    type: "info",
                    html: "Are you sure you want to delete this inquiry?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/custom-tour/delete-inquiry/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#ctpi-delete-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#ctpi-delete-btn').html('Delete');
                            $("#custom-tour-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The item has been deleted.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            pti_table.ajax.reload();
                            ti_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }

            //===================  PENDING FLIGHT INQUIRIES  ===================//
            
            var pfri_table = $('#pending-flight-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/airline-ticketing/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "loc_from" },
                    { "data": "loc_to" },
                    { "data": "departure" },
                    { "data": "return" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleFlightReservation("+data.id+")");
                },
            }).columns.adjust().draw();

            var fri_table = $('#flight-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/airline-ticketing/get-all",
                
                "columns": [
                    { "data": "name" },
                    { "data": "loc_from" },
                    { "data": "loc_to" },
                    { "data": "departure" },
                    { "data": "return" },
                    { "data": "remark" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [5],
                        "width": "15%",
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleFlightReservation("+data.id+")");
                },
            }).columns.adjust().draw();


            function toggleFlightReservation(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/airline-ticketing/get-inquiry/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#fri-modal-name').html(data[0].name);
                        $('#fri-modal-birthday-age').html(data[0].bday_and_age);
                        $('#fri-modal-phone-number').html(data[0].phone_number);
                        $('#fri-modal-email').html(data[0].email);

                        $('#fri-modal-from').html(data[0].origin);
                        $('#fri-modal-to').html(data[0].destination);

                        $('#fri-modal-flight-type').html(data[0].flight_route);

                        $('#fri-modal-depart').html(data[0].departure);
                        $('#fri-modal-return').html(data[0].return);

                        $('#fri-modal-adult-no').html(data[0].adult_no);
                        $('#fri-modal-child-no').html(data[0].child_no);
                        $('#fri-modal-infant-no').html(data[0].infant_no);

                        $('#fri-modal-remark').html(data[0].remark);

                        if (data[0].status == 0) {
                            $('#fri-mark-processed-btn').show();
                            $('#fri-mark-processed-btn').attr('onclick', 'markAsProcessedFlightInquiry('+id+')');
                        }
                        else {
                            $('#fri-mark-processed-btn').hide();
                        }
                        
                        $('#fri-delete-btn').attr('onclick', 'deleteFlightInquiry('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#flight-reservation-modal").modal("toggle");
            }

            function markAsProcessedFlightInquiry(id) {
                //
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/airline-ticketing/mark-as-processed/"+id,
                    delay: 250,
                    data: {
                        'id': id
                    },
                    beforeSend: function () {
                        $('#fri-mark-processed-btn').html('<i class="fa fa-spinner"></i> Loading...');
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        //console.log(data);
                        $('#fri-mark-processed-btn').html('Mark As Processed');
                        $("#flight-reservation-modal").modal("toggle");
                        if (data == "success") {
                            swal({
                                title: "Success",
                                type: "success",
                                html: "<div class=\"swal-success-status\">The item has been marked as processed.</div>"
                            });
                        }
                        else {
                            swal({
                                title: "Error",
                                type: "error",
                                html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                            });
                        }
                        pfri_table.ajax.reload();
                        fri_table.ajax.reload();
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
            }

            function deleteFlightInquiry(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete Inquiry?",
                    type: "info",
                    html: "Are you sure you want to delete this inquiry?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/airline-ticketing/delete-inquiry/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#fri-delete-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#fri-delete-btn').html('Delete');
                            $("#flight-reservation-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The item has been deleted.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            pfri_table.ajax.reload();
                            fri_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }
            
            //==============  PENDING HOTEL RESERVATION INQUIRIES  ==============//

            var phri_table = $('#pending-hotel-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/hotel-reservation/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "location" },
                    { "data": "check_in" },
                    { "data": "check_out" },
                    { "data": "no_of_pax" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleHotelReservation("+data.id+")");
                },
            }).columns.adjust().draw();

            var hri_table = $('#hotel-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/hotel-reservation/get-all",
                
                "columns": [
                    { "data": "name" },
                    { "data": "location" },
                    { "data": "check_in" },
                    { "data": "check_out" },
                    { "data": "no_of_pax" },
                    { "data": "remark" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [5],
                        "width": "15%",
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleHotelReservation("+data.id+")");
                },
            }).columns.adjust().draw();

            function toggleHotelReservation(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/hotel-reservation/get-inquiry/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#hri-modal-name').html(data[0].name);
                        $('#hri-modal-birthday-age').html(data[0].bday_and_age);
                        $('#hri-modal-phone-number').html(data[0].phone_number);
                        $('#hri-modal-email').html(data[0].email);

                        $('#hri-modal-location').html(data[0].location);

                        $('#hri-modal-check-in').html(data[0].check_in);
                        $('#hri-modal-check-out').html(data[0].check_out);

                        $('#hri-modal-adult-no').html(data[0].adult_no);
                        $('#hri-modal-child-no').html(data[0].child_no);

                        $('#hri-modal-for-work').html(data[0].for_work);

                        $('#hri-modal-remark').html(data[0].remark);

                        if (data[0].status == 0) {
                            $('#hri-mark-processed-btn').show();
                            $('#hri-mark-processed-btn').attr('onclick', 'markAsProcessedHotelInquiry('+id+')');
                        }
                        else {
                            $('#hri-mark-processed-btn').hide();
                        }
                        
                        $('#hri-delete-btn').attr('onclick', 'deleteHotelInquiry('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#hotel-reservation-modal").modal("toggle");
            }

            function markAsProcessedHotelInquiry(id) {
                //
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/hotel-reservation/mark-as-processed/"+id,
                    delay: 250,
                    data: {
                        'id': id
                    },
                    beforeSend: function () {
                        $('#hri-mark-processed-btn').html('<i class="fa fa-spinner"></i> Loading...');
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        //console.log(data);
                        $('#hri-mark-processed-btn').html('Mark As Processed');
                        $("#hotel-reservation-modal").modal("toggle");
                        if (data == "success") {
                            swal({
                                title: "Success",
                                type: "success",
                                html: "<div class=\"swal-success-status\">The item has been marked as processed.</div>"
                            });
                        }
                        else {
                            swal({
                                title: "Error",
                                type: "error",
                                html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                            });
                        }
                        phri_table.ajax.reload();
                        hri_table.ajax.reload();
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
            }

            function deleteHotelInquiry(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete Inquiry?",
                    type: "info",
                    html: "Are you sure you want to delete this inquiry?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/hotel-reservation/delete-inquiry/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#hri-delete-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#hri-delete-btn').html('Delete');
                            $("#hotel-reservation-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The item has been deleted.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            phri_table.ajax.reload();
                            hri_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }
            
            //=================  PENDING BUS BOOKIGN INQUIRIES  =================//

            var pbbi_table = $('#pending-bus-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/bus-booking/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "origin" },
                    { "data": "destination" },
                    { "data": "departure" },
                    { "data": "return" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleBusBooking("+data.id+")");
                },
            }).columns.adjust().draw();

            var bi_table = $('#bus-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/bus-booking/get-all",
                
                "columns": [
                    { "data": "name" },
                    { "data": "origin" },
                    { "data": "destination" },
                    { "data": "departure" },
                    { "data": "return" },
                    { "data": "remark" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [5],
                        "width": "15%",
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleBusBooking("+data.id+")");
                },
            }).columns.adjust().draw();

            function toggleBusBooking(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/bus-booking/get-inquiry/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#bbi-modal-name').html(data[0].name);
                        $('#bbi-modal-birthday-age').html(data[0].bday_and_age);
                        $('#bbi-modal-phone-number').html(data[0].phone_number);
                        $('#bbi-modal-email').html(data[0].email);

                        $('#bbi-modal-from').html(data[0].origin);
                        $('#bbi-modal-to').html(data[0].destination);

                        $('#bbi-modal-departure').html(data[0].departure);
                        $('#bbi-modal-return').html(data[0].return);

                        $('#bbi-modal-travel-type').html(data[0].travel_type);
                        $('#bbi-modal-id-number').html(data[0].id_number);
                        $('#bbi-modal-remark').html(data[0].remark);

                        if (data[0].status == 0) {
                            $('#bbi-mark-processed-btn').show();
                            $('#bbi-mark-processed-btn').attr('onclick', 'markAsProcessedBusInquiry('+id+')');
                        }
                        else {
                            $('#bbi-mark-processed-btn').hide();
                        }
                        
                        $('#bbi-delete-btn').attr('onclick', 'deleteBusInquiry('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#bus-booking-modal").modal("toggle");
            }

            function markAsProcessedBusInquiry(id) {
                //
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/bus-booking/mark-as-processed/"+id,
                    delay: 250,
                    data: {
                        'id': id
                    },
                    beforeSend: function () {
                        $('#bbi-mark-processed-btn').html('<i class="fa fa-spinner"></i> Loading...');
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        //console.log(data);
                        $('#bbi-mark-processed-btn').html('Mark As Processed');
                        $("#bus-booking-modal").modal("toggle");
                        if (data == "success") {
                            swal({
                                title: "Success",
                                type: "success",
                                html: "<div class=\"swal-success-status\">The item has been marked as processed.</div>"
                            });
                        }
                        else {
                            swal({
                                title: "Error",
                                type: "error",
                                html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                            });
                        }
                        pbbi_table.ajax.reload();
                        bi_table.ajax.reload();
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
            }

            function deleteBusInquiry(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete Inquiry?",
                    type: "info",
                    html: "Are you sure you want to delete this inquiry?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/bus-booking/delete-inquiry/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#bbi-delete-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#bbi-delete-btn').html('Delete');
                            $("#bus-booking-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The item has been deleted.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            pbbi_table.ajax.reload();
                            bi_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }
            
            //=================  PENDING VAN RENTAL INQUIRIES  =================//

            var pvi_table = $('#pending-van-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/van-rental/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "from" },
                    { "data": "to" },
                    { "data": "rental_day_start" },
                    { "data": "rental_day_end" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleVanRental("+data.id+")");
                },
            }).columns.adjust().draw();

            var vi_table = $('#van-inquiries').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/van-rental/get-all",
                
                "columns": [
                    { "data": "name" },
                    { "data": "from" },
                    { "data": "to" },
                    { "data": "rental_day_start" },
                    { "data": "rental_day_end" },
                    { "data": "remark" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [4, 2],
                        "width": "10%",
                    },
                    {
                        "targets": [3],
                        "width": "30%",
                    },
                    {
                        "targets": [5],
                        "width": "15%",
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleVanRental("+data.id+")");
                },
            }).columns.adjust().draw();

            function toggleVanRental(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/van-rental/get-inquiry/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#vr-modal-name').html(data[0].name);
                        $('#vr-modal-birthday-age').html(data[0].bday_and_age);
                        $('#vr-modal-phone-number').html(data[0].phone_number);
                        $('#vr-modal-email').html(data[0].email);

                        $('#vr-modal-from').html(data[0].from);
                        $('#vr-modal-to').html(data[0].to);

                        $('#vr-modal-departure').html(data[0].rental_day_start);
                        $('#vr-modal-return').html(data[0].rental_day_end);

                        $('#vr-modal-van-type').html(data[0].van_type);
                        $('#vr-modal-remark').html(data[0].remark);

                        if (data[0].status == 0) {
                            $('#vr-mark-processed-btn').show();
                            $('#vr-mark-processed-btn').attr('onclick', 'markAsProcessedVanInquiry('+id+')');
                        }
                        else {
                            $('#vr-mark-processed-btn').hide();
                        }
                        
                        $('#vr-delete-btn').attr('onclick', 'deleteVanInquiry('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#van-rental-modal").modal("toggle");
            }

            function markAsProcessedVanInquiry(id) {
                //
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/van-rental/mark-as-processed/"+id,
                    delay: 250,
                    data: {
                        'id': id
                    },
                    beforeSend: function () {
                        $('#vr-mark-processed-btn').html('<i class="fa fa-spinner"></i> Loading...');
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        //console.log(data);
                        $('#vr-mark-processed-btn').html('Mark As Processed');
                        $("#van-rental-modal").modal("toggle");
                        if (data == "success") {
                            swal({
                                title: "Success",
                                type: "success",
                                html: "<div class=\"swal-success-status\">The item has been marked as processed.</div>"
                            });
                        }
                        else {
                            swal({
                                title: "Error",
                                type: "error",
                                html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                            });
                        }
                        pvi_table.ajax.reload();
                        vi_table.ajax.reload();
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
            }

            function deleteVanInquiry(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete Inquiry?",
                    type: "info",
                    html: "Are you sure you want to delete this inquiry?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/van-rental/delete-inquiry/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#vr-delete-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#vr-delete-btn').html('Delete');
                            $("#van-rental-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The item has been deleted.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            pvi_table.ajax.reload();
                            vi_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }
        //});


        

        
    </script>
@endsection