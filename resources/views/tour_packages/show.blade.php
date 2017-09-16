@extends('master')

@section('meta-description', $tour_package->meta_description) 
@section('meta-keywords', $tour_package->meta_keywords)


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 75vh;
            background: url('{!! url('/') !!}/assets/images/{!! $tour_package->package_image !!}') bottom no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #header h2{
            position: absolute;
            width: calc(100% - 140px);
            bottom: 50px;
            left: 70px;
            font-size: 45px;
        }

        #header .btn{
            margin: 3px 0px 0px 0px;
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
            padding: 50px 70px;
        }

        .title{
            margin: 0px;
        }

        #tour-details{
            margin-top: 25px;
        }

        #tour-details li{
            padding: 5px 0px;
        }

        #payment-swiper{
            margin-top: 25px;
        }

        .form-control{
            height: 50px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        .info{
            margin-left: 10px;
            color: #999999;
            cursor: pointer;
        }

        .ad_image{
            content: url('{!! url('/') !!}/assets/images/ads/ad_landscape.jpg');
        }

        @media (max-width: 768px) and (min-width: 426px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #content{
                padding: 50px 15px;
            }
        }

        @media (max-width: 425px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #header h2 .btn{
                display: none;
            }

            #content{
                padding: 50px 15px;
            }
            .ad_image{
                content: url('{!! url('/') !!}/assets/images/ads/ad_landscape_two.jpg');
            }
        }
    </style>
@endsection

@section('title')
    MBK - {!! $tour_package->name !!} Package
@endsection

@section('content')
    <!-- Header -->
    <div id="header">
        <div class="fill">
            <h2 class="text-white">{!! $tour_package->name !!} 
            @if(!empty($_GET['from']))
                @if ($_GET['from'] == 'profile')
                    <a href="{!! url('/') !!}/users/profile" class="btn btn-primary pull-right">Return to Profile</a>
                @endif
            @else
                <a href="{!! url('/') !!}/tour-packages" class="btn btn-primary pull-right">Return to Packages</a>
            @endif
            </h2>
            
        </div>
    </div>
    <!-- Header -->

    <!-- Content -->
    <div id="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <p>
                    {!! $tour_package->package_description !!}
                </p>
                <br>
                <h3 class="title text-uppercase text-blue">Tour Details</h3>
                <ul id="tour-details">
                    <li>Tour details goes here in a bullet form</li>
                    <li>Tour details goes here in a bullet form</li>
                    <li>Tour details goes here in a bullet form</li>
                    <li>Tour details goes here in a bullet form</li>
                </ul>
                <br><br>
                <h3 class="title text-uppercase text-blue">Price Table</h3>
                <div class="table-responsive" style="margin-top: 30px">
                    <table class="table table-striped">
                        <thead>
                            <th>Package Type</th>
                            <th class="text-right">Price</th>
                        </thead>
                        <tbody>
                            @foreach ($package_types as $package_type)
                                <tr>
                                    <td> {!! $package_type->type_name !!} <i class="fa fa-question-circle info" data-toggle="popover" title="What is {!!$package_type->type_name!!}?" data-content="{!! $package_type->help_info !!}"></i></td>
                                    <td class="text-right"><b>₱ {!! number_format($package_type->price, 2, '.', ',') !!}/pax</b></td>
                                </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                {!! Form::open(['url' => 'cart/add-to-cart', 'role' => 'form', 'data-toggle' => 'validator']) !!}
                    {!! Form::hidden('package_name', $tour_package->name) !!}
                    {!! Form::hidden('tour_package', $tour_package->id) !!}
                    <div class="form-group">
                        {!! Form::label('package_type', 'SELECT PACKAGE TYPE') !!}
                        {!! Form::select('package_type', $select_package_types, '1', ['class' => 'form-control', 'id' => 'package-type']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('no_of_pax', 'NO. OF PAX') !!}
                        {!! Form::number('no_of_pax', '', ['class' => 'form-control number-only', 'placeholder' => 'Enter No. of PAX', 'id' => 'pax-num', 'min' => '0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('chosen_travel_date', 'TRAVEL DATE (START)') !!}
                        {!! Form::text('chosen_travel_date', '', ['class' => 'form-control', 'id' => 'travel-day', 'onkeydown' => 'return false', 'placeholder' => 'MM/DD/YYYY']) !!}
                    </div>
                    <p>Subtotal: ₱ <b id="price">0.00</b></p>
                    {!! Form::button('Add to Cart', ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block text-uppercase', 'id' => 'add-btn']) !!}
                {!! Form::close() !!}
                <a href="{!! url('/') !!}/shopping-cart" class="btn btn-default btn-block text-uppercase text-blue">View Cart</a>
                <!-- <br><br>
                <h2 class="title text-uppercase text-blue">Modes Of Payment</h2>
                <small>We accept the following modes of payment for this specific service</small>
                <div id="payment-swiper" class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/american_express.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/bdo.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/bpi.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/discover.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/jcb.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/mastercard.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/paypal.jpg"></div>
                        <div class="swiper-slide"><img src="../assets/images/credit_cards/visa.jpg"></div>
                    </div>
                </div> -->
                <img src="{!! url('/') !!}/assets/images/ads/ad_landscape_two.jpg" style="width: 100%; margin-top: 50px;">
            </div>
        </div>
    </div>
    <!-- Content -->
@endsection


@section ('modified-script')
    <script type="text/javascript">
        $("#travel-day").datetimepicker({
            minDate: '{!! date("m/d/Y", strtotime($tour_package->travel_day_start)) !!}',
            maxDate: '{!! date("m/d/Y", strtotime($tour_package->travel_day_end)) !!}',
            format: 'MM/DD/YYYY',
            icons: {
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            }
        });
        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ", ");
            return parts.join(".");
        }
        Number.prototype.formatMoney = function(c, d, t){
        var n = this, 
            c = isNaN(c = Math.abs(c)) ? 2 : c, 
            d = d == undefined ? "." : d, 
            t = t == undefined ? "," : t, 
            s = n < 0 ? "-" : "", 
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
            j = (j = i.length) > 3 ? j % 3 : 0;
           return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
         };
        $(document).ready(function(){
            $('.info').popover({});

            var package_types = {!! $package_types !!};
                
            var division = 0;
            var price = 0;

            var pt_info;
            for (var i = 0; i < package_types.length; i++) {
                if (package_types[i].id == $('#package-type').val()) {

                    pt_info = package_types[i];
                    break;
                }
                else {
                    continue;
                }
            }
            price = pt_info.price;
            $('#pax-num').val(pt_info.pax_per_room);
            
            var pax = $("#pax-num").val();
            if(pax > 0 || pax != ""){
                if(pax < pt_info.pax_per_room) {
                    $("#add-btn").attr('disabled', 'disabled');
                    $("#price").html('0.00<br><span class="text-danger">Minimum PAX for this package is ('+pt_info.pax_per_room+')</span>');
                } else {
                    if((pax % pt_info.pax_per_room) == 0){
                        division = pax / pt_info.pax_per_room;
                    } else{
                        division = Math.ceil((pax / pt_info.pax_per_room));
                    }
                    
                    var total = price * division;
                    $("#add-btn").removeAttr('disabled');
                    $("#price").html(total.formatMoney(2, '.', ','));
                }
            } else {
                $("#add-btn").attr('disabled', 'disabled');
                $("#price").html("0.00");
            }
            
            $("#package-type").on('change', function(){
                
                var pt_info;
                for (var i = 0; i < package_types.length; i++) {
                    if (package_types[i].id == $('#package-type').val()) {

                        pt_info = package_types[i];
                        break;
                    }
                    else {
                        continue;
                    }
                }
                price = pt_info.price;
                $('#pax-num').attr('min', pt_info.pax_per_room);
                if ($('#pax-num').val() < pt_info.pax_per_room) {
                    $('#pax-num').val(pt_info.pax_per_room);
                }
                var pax = $("#pax-num").val();
                if(pax > 0 || pax != ""){
                    if(pax < pt_info.pax_per_room) {
                        $("#add-btn").attr('disabled', 'disabled');
                        $("#price").html('0.00<br><span class="text-danger">Minimum PAX for this package is ('+pt_info.pax_per_room+')</span>');
                    } else {
                        if((pax % pt_info.pax_per_room) == 0){
                            division = pax / pt_info.pax_per_room;
                        } else{
                            division = Math.ceil((pax / pt_info.pax_per_room));
                        }
                        
                        var total = price * division;
                        $("#add-btn").removeAttr('disabled');
                        $("#price").html(total.formatMoney(2, '.', ','));
                    }
                } else {
                    $("#add-btn").attr('disabled', 'disabled');
                    $("#price").html("0.00");
                }
            });

            $("#pax-num").on('keyup', function(){
                
                var pt_info;
                for (var i = 0; i < package_types.length; i++) {
                    if (package_types[i].id == $('#package-type').val()) {

                        pt_info = package_types[i];
                        break;
                    }
                    else {
                        continue;
                    }
                }
                price = pt_info.price;
                $('#pax-num').attr('min', pt_info.pax_per_room);
                var pax = $("#pax-num").val();
                if(pax > 0 || pax != ""){
                    if(pax < pt_info.pax_per_room) {
                        $("#add-btn").attr('disabled', 'disabled');
                        $("#price").html('0.00<br><span class="text-danger">Minimum PAX for this package is ('+pt_info.pax_per_room+')</span>');
                    } else {
                        if((pax % pt_info.pax_per_room) == 0){
                            division = pax / pt_info.pax_per_room;
                        } else{
                            division = Math.ceil((pax / pt_info.pax_per_room));
                        }
                        
                        var total = price * division;
                        $("#add-btn").removeAttr('disabled');
                        $("#price").html(total.formatMoney(2, '.', ','));
                    }
                } else {
                    $("#add-btn").attr('disabled', 'disabled');
                    $("#price").html("0.00");
                }
            });
        });
        
    </script>
@endsection
