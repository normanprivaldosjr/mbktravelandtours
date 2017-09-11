@extends('master')


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            margin-top: 70px;
            padding: 0px 70px;
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
            margin-top: 0px;
            padding: 150px 50px 100px 50px;
        }

        #cart-title{
            background: #DDDDDD;
            padding: 15px;
            margin-bottom: 10px;
        }

        .cart .row{
            padding: 10px 0px;
        }

        img{
            width: 200px;
        }

        h5{
            font-weight: bold;
        }

        .media p{
            font-size: 12px;
        }

        .btn{
            margin: 5px 0px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        @media (max-width: 768px) and (min-width: 426px){
            #content{
                padding: 100px 15px 50px 15px;
            }

            .cart{
                margin-bottom: 50px;
            }
        }

        @media (max-width: 425px){
            #content{
                padding: 75px 0px 50px 0px;
            }

            .media{
                position: relative;
                float: left;
                width: 100%;
                margin-bottom: 0px;
            }

            .media-left{
                position: relative;
                float: left;
                width: 100%;
                padding: 0px;
            }

            .media-left img{
                width: 100%;
                margin-bottom: 10px;
            }

            .media-body{
                padding: 0px;
            }

            .cart .row{
                margin-bottom: 25px;
            }

            .cart h5{
                margin: 0px;
            }

            .btn-lg{
                font-size: 14px;
            }
        }

        .navbar {
            background: #FFFFFF;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .navbar-default .navbar-nav > li > a {
            color: #616161;
        }

        .navbar-default .navbar-nav > li > a:hover {
            color: #2196F3;
        }

        .navbar-default .navbar-brand {
            color: #2196F3;
        }

        .navbar .container-fluid {
            padding: 0px 5% 0px 5%;
        }
        table > tr > td {
            vertical-align: center;
        }
        .form-group {
            margin:0px;
        }
    </style>
@endsection

@section('title', 'MBK - Shopping Cart')

@section('content')
    <?php
        $subtotal = 0;
    ?>
    <div id="content">
        @if (Auth::check())
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 cart">
                    <h4 class="text-uppercase" id="cart-title">Your Cart ({!! count($cart_items) !!})</h4>
                    @foreach ($cart_items as $cart_item)
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="media">
                                    <div class="media-left"><a href="{!! url('/') !!}/tour-packages/{!! $cart_item->slug !!}"><img src="{!! url('/') !!}/assets/images/{!! $cart_item->package_image !!}"></a></div>
                                    <div class="media-body">
                                        <h5 class="text-uppercase"><a href="{!! url('/') !!}/tour-packages/{!! $cart_item->slug !!}">{!! $cart_item->name !!}</a></h5>
                                        <p>
                                            Package: <b>{!! $cart_item->type_name !!}</b><br>
                                            Date of Travel: <b>{!! date("F j, Y", strtotime($cart_item->chosen_travel_date)) !!}</b><br>
                                            No. of PAX: <b>{!! $cart_item->no_of_pax !!}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
                                <h5>₱ 
                                <?php
                                    $pax = $cart_item->no_of_pax;
                                    $limit = $cart_item->pax_per_room;
                                    $division;
                                    $total;
                                    if (($pax % $limit) == 0) {
                                        $division = $pax / $limit;
                                    }
                                    else {
                                        $division = ceil($pax / $limit);
                                    }
                                    $total = $cart_item->price * $division;
                                    echo number_format($total, 2, '.', ',');
                                    $subtotal += $total;
                                ?></h5>
                                <?php
                                    
                                ?>
                                <a href="{!! url('/') !!}/cart/remove-from-cart/{!! $cart_item->id !!}"><small class="text-danger"><i class="fa fa-remove"></i> Remove from Cart</small></a>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <center>
                            {!! $cart_items->links() !!}
                        </center>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="{!! url('/') !!}/tour-packages" class="btn btn-primary text-white text-uppercase">Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card bg-blue" style="margin-bottom: 15px">
                        <h4 class="text-white text-uppercase" style="margin: 0px 0px 30px 0px">Summary</h4>
                        <hr>
                        <p class="text-white">
                            <?php
                                $taxable = ($subtotal*$homepage->tax)/100;
                            ?>
                            Subtotal <b class="pull-right">₱ {!! number_format($subtotal, 2, '.', ',') !!}</b><br>
                            Tax ({!! $homepage->tax !!}%) <b class="pull-right">₱ {!! number_format($taxable, 2, '.', ',') !!}</b>
                        </p>
                        <hr>
                        <p class="text-white">
                            <?php
                                $grand_total = $taxable+$subtotal;
                            ?>
                            Grand Total <b class="pull-right">₱ {!! number_format($grand_total, 2, '.', ',') !!}</b>
                        </p>
                    </div>
                    <button id="proceed-to-checkout" class="btn btn-primary btn-block btn-lg text-uppercase"
                    <?php
                    if (count($cart_items) == 0) {
                        echo 'disabled="disabled"';
                    }
                    ?>
                    >Checkout&nbsp;<i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        @else
            @if (empty($_COOKIE['cart_items']))

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 cart">
                        <h4 class="text-uppercase" id="cart-title">Your Cart (0)</h4>
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="{!! url('/') !!}/tour-packages" class="btn btn-primary text-white text-uppercase">Add More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card bg-blue" style="margin-bottom: 15px">
                            <h4 class="text-white text-uppercase" style="margin: 0px 0px 30px 0px">Summary</h4>
                            <hr>
                            <p class="text-white">
                                Subtotal <b class="pull-right">₱ 0.00</b><br>
                                Tax ({!! $homepage->tax !!}%) <b class="pull-right">₱ 0.00</b>
                            </p>
                            <hr>
                            <p class="text-white">
                                Grand Total <b class="pull-right">₱ 0.00</b>
                            </p>
                        </div>
                        <button id="proceed-to-checkout" class="btn btn-primary btn-block btn-lg text-uppercase" disabled="disabled"
                        >Checkout&nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            @else
                <?php 
                    $cart_items = unserialize($_COOKIE['cart_items']); 
                ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 cart">
                        <h4 class="text-uppercase" id="cart-title">Your Cart ({!! count($cart_items) !!})</h4>
                        @for ($i = 0; $i < count($cart_items); $i++)
                            <?php
                                $tour_package = DB::table('tour_packages')->whereId($cart_items[$i]['tour_package_id'])->first();
                                $package_type = DB::table('package_types')->whereId($cart_items[$i]['package_type_id'])->first();
                                //print_r($tour_package);
                            ?>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="media">
                                        <div class="media-left"><a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}"><img src="{!! url('/') !!}/assets/images/{!! $tour_package->package_image !!}"></a></div>
                                        <div class="media-body">
                                            <h5 class="text-uppercase"><a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}">{!! $tour_package->name !!}</a></h5>
                                            <p>
                                                Package: <b>{!! $package_type->type_name !!}</b><br>
                                                Date of Travel: <b>{!! date("F j, Y", strtotime($cart_items[$i]['chosen_travel_date'])) !!}</b><br>
                                                No. of PAX: <b>{!! $cart_items[$i]['no_of_pax'] !!}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
                                    <h5>₱ 
                                    <?php
                                        $pax = $cart_items[$i]['no_of_pax'];
                                        $limit = $package_type->pax_per_room;
                                        $division;
                                        $total;
                                        if (($pax % $limit) == 0) {
                                            $division = $pax / $limit;
                                        }
                                        else {
                                            $division = ceil($pax / $limit);
                                        }
                                        $total = $package_type->price * $division;
                                        echo number_format($total, 2, '.', ',');
                                        $subtotal += $total;
                                    ?></h5>
                                    <a href="{!! url('/') !!}/cart/remove-from-cart/{!! $i !!}"><small class="text-danger"><i class="fa fa-remove"></i> Remove from Cart</small></a>
                                </div>
                            </div>
                        @endfor
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="{!! url('/') !!}/tour-packages" class="btn btn-primary text-white text-uppercase">Add More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card bg-blue" style="margin-bottom: 15px">
                            <h4 class="text-white text-uppercase" style="margin: 0px 0px 30px 0px">Summary</h4>
                            <hr>
                            <p class="text-white">
                                <?php
                                    $taxable = ($subtotal*$homepage->tax)/100;
                                ?>
                                Subtotal <b class="pull-right">₱ {!! number_format($subtotal, 2, '.', ',') !!}</b><br>
                                Tax ({!! $homepage->tax !!}%) <b class="pull-right">₱ {!! number_format($taxable, 2, '.', ',') !!}</b>
                            </p>
                            <hr>
                            <p class="text-white">
                                <?php
                                    $grand_total = $taxable+$subtotal;
                                ?>
                                Grand Total <b class="pull-right">₱ {!! number_format($grand_total, 2, '.', ',') !!}</b>
                            </p>
                        </div>
                        <button id="proceed-to-checkout" class="btn btn-primary btn-block btn-lg text-uppercase"
                        <?php
                        if (count($cart_items) == 0) {
                            echo 'disabled="disabled"';
                        }
                        ?>
                        >Checkout&nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            @endif
        @endif
    </div>


@endsection

@section('modified-script')
    <script type="text/javascript">
        $(window).on('load', function(){
            $("#container").addClass("loaded");
            $("#loader").fadeOut("slow");

            setTimeout(function(){
                $("#loader").addClass("inactive");
            }, 1000);
        });
        $('#proceed-to-checkout').on('click', function(){
            location.href = "{!! url('/') !!}/cart/proceed-to-checkout";
        });
        
    </script>
@endsection