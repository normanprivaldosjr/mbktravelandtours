@extends('master')


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 70vh;
            background: url('../assets/images/header.jpg') center no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #header .fill .btn{
            position: absolute;
            right: 60px;
            bottom: 55px;
        }

        #profile-container{
            position: absolute;
            float: left;
            width: 50%;
            bottom: 0px;
            left: 60px;
            padding: 50px 0px;
        }

        #image-container{
            position: relative;
            float: left;
            width: 15%;
            height: 100%;
            text-align: center;
        }

        #image-container img{
            width: 100%;
        }

        #name-container{
            position: relative;
            float: left;
            width: 85%;
            height: 100%;
            padding-left: 50px; 
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
            padding: 50px 60px;
        }

        #header .fill .btn,
        #suggested .btn{
            letter-spacing: 0px;
        }

        .footer{
            position: relative;
            float: left;
        }
    </style>
@endsection

@section('title', 'MBK Travel and Tours')

@section('content')

    <div id="header">
        <div class="fill">
            <div id="profile-container">
                <div id="image-container">
                    <img src="{!! Auth::user()->profile_picture !!}">
                </div>
                <div id="name-container">
                    <h1 class="text-white">{!! ucwords(Auth::user()->first_name)." ".ucwords(Auth::user()->last_name) !!}</h1>
                    <p class="text-white">{!! Auth::user()->email !!}</p>
                </div>
            </div>

            <a href="{!! url('/') !!}/users/settings" class="btn btn-primary">Account Settings</a>
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-uppercase text-blue">Orders</h3>
                <hr>
                @foreach ($purchases as $purchase)
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <p>
                                <b>OR NO. {!! $purchase->id !!}</b><br>
                                Date: <b>{!! date("F j, Y", strtotime($purchase->created_at)) !!}</b><br>
                                Payment Method: <b>{!! $purchase->bank_name !!}</b><br>
                                Price: ₱ {!! number_format($purchase->total, 2, '.', ',') !!}<br>
                                <?php
                                    $purchase_status;
                                    //0 for pending without payment; 1 for pending with payment; 2 for approved; 3 for denied
                                    if ($purchase->purchase_status == 0) {
                                        $purchase_status = '<b class="label label-warning" style="font-size:12px">No deposit slip yet</b>';
                                    }
                                    else if ($purchase->purchase_status == 1) {
                                        $purchase_status = '<b class="label label-info" style="font-size:12px">Paid, pending</b>';
                                    }
                                    else if ($purchase->purchase_status == 2) {
                                        $purchase_status = '<b class="label label-success" style="font-size:12px">Approved</b>';
                                    }
                                    else {
                                        $purchase_status = '<b class="label label-danger" style="font-size:12px">Denied</b>';
                                    }
                                ?>
                                Status: {!! $purchase_status !!}<br>
                                
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a class="btn btn-sm btn-primary" href="{!! url('/') !!}/users/profile/purchases/{!!  $purchase->uniqid !!}">View Details
                            @if ($purchase->purchase_status == 0)
                                <br> and Upload Deposit Receipt
                            @endif
                            </a>
                            
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row">
                    <center>
                        {!! $purchases->links() !!}
                    </center>
                </div>
            </div>
        </div>
        @if (!$tour_packages->isEmpty())
            <div id="suggested" class="row" style="margin-top: 100px">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-uppercase text-blue">Suggested Tour Packages</h3>
                    <hr>
                    <div class="row" id="grid-container">
                        @foreach ($tour_packages as $tour_package)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="package-container">
                                    <img src="{!! url('/') !!}/assets/images/{!! $tour_package->package_image !!}">
                                    <div class="location-container"><h3>{!! $tour_package->name !!}</h3></div>
                                    <div class="primary-tour-details">
                                        {!! $tour_package->package_description !!}
                                        <br><br>
                                        Duration: <b>{!! $tour_package->no_of_days !!} days &amp; {!! $tour_package->no_of_nights !!} nights</b><br>
                                        Price starts at: <b class="text-blue">₱ {!! number_format($tour_package->price_starts, 2, '.', ',') !!}</b><br><br>
                                        <a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}?from=profile" class="btn btn-primary text-white">Read More</a>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        
    </div>

@endsection

@section('modified-script')
@endsection