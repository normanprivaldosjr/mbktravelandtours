@extends('master')


@section('modified-style')
    <style type="text/css">
        #content{
            position: relative;
            float: left;
            width: 100%;
            margin-top: 0px;
            padding: 115px 50px 100px 50px;
        }

        #content .row{
            margin-bottom: 50px;
        }

        .form-control{
            height: 50px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        @media (max-width: 425px){
            #content{
                padding: 100px 15px;
            }

            .col-xs-12.form-group{
                padding: 0px 0px !important;
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

@section('title', 'MBK - Checkout')

@section('content')
<?php
    $subtotal = 0;
?>
    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="text-blue text-uppercase" style="margin: 0px">Invoice</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding: 0px">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        INVOICE TO<br>
                        <b>{!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!}</b><br>
                        {!! Auth::user()->city !!}, {!! Auth::user()->province !!}<br>
                        {!! Auth::user()->phone_number !!}<br><br>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        DATE &amp; TIME<br>
                        <b>
                            {!! date("F j, Y h:m A") !!}<br><br>
                        </b>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        INVOICE NO. <b>0001</b><br><br>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th class="text-center">No. of PAX</th>
                                    <th class="text-right">Subtotal</th>
                                </thead>
                                <tbody>
                                    @foreach ($cart_items as $cart_item)
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
                                            //echo number_format($total, 2, '.', ',');
                                            $subtotal += $total;
                                        ?>
                                        <tr>
                                            <td>{!! $cart_item->name !!} ({!! $cart_item->type_name !!})</td>
                                            <td>₱ {!! number_format($cart_item->price_starts, 2, '.', ',') !!}</td>
                                            <td class="text-center">{!! $cart_item->no_of_pax !!}</td>
                                            <td class="text-right">₱ {!! number_format($total, 2, '.', ',') !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal</th>
                                        <th class="text-right">₱ {!! number_format($subtotal, 2, '.', ',') !!}</th>
                                    </tr>
                                    <?php
                                        $taxable = ($subtotal*$homepage->tax)/100;
                                    ?>
                                    <tr id="mis-container">
                                        <th colspan="3" class="text-right">Tax ({!! $homepage->tax !!}%)</th>
                                        <th id="mis-charge" class="text-right">₱ {!! number_format($taxable, 2, '.', ',') !!}</th>
                                    </tr>
                                    <?php
                                        $miscellaneous = 0;
                                    ?>
                                    <tr id="mis-container">
                                        <th colspan="3" class="text-right">Miscellaneous Fee</th>
                                        <th id="mis-charge" class="text-right">₱ 0.00</th>
                                    </tr>
                                    <?php
                                        $grand_total = $subtotal+$taxable+$miscellaneous;
                                    ?>
                                    <tr>
                                        <th colspan="3" class="text-right">Total</th>
                                        <th id="total" class="text-right text-blue">₱ {!! number_format($grand_total, 2, '.', ',') !!}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                {!! Form::open(['role' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <label>SELECT PAYMENT METHOD</label>
                    <select class="form-control" id="payment-method" required="required">
                        <option value="">Select Payment Method</option>
                        <option value="1">Bank Deposit</option>
                        <option value="2">Other Bank</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div id="other" class="form-group" style="display: none">
                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name">
                    <p>
                        Indicate the name of the bank or money transfer center above.
                    </p>
                </div>
                <div id="bank-deposit" class="form-group" style="display: none">
                    <p>
                        Please deposit your payment to <b class="text-blue">{!! $bank_info->branch !!}</b> with
                        the account name <b class="text-blue">{!! $bank_info->account_name !!}</b> and
                        account number <b class="text-blue">{!! $bank_info->account_number !!}</b> and upload a clear
                        photo/scan of your deposit receipt your order page located in your profile.
                    </p>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block text-white text-uppercase">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        
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
        $("#payment-method").on("change", function(e){
            if($("#payment-method").val() == 1){
                //if BDO
                $("#bank-deposit").css("display", "block");
                $("#other").css("display", "none");
                $('#bank_name').val("BDO");
            } else {
                $("#bank-deposit").css("display", "none");
                $("#other").css("display", "block");
                $('#bank_name').val("");
            }
        });
        
    </script>
@endsection