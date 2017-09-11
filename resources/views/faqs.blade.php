@extends('master')

@section('meta-description', 'Frequently Asked Questions of MBK, A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'faq, faqs, frequently, asked, questions, question, tour, packages, airline, ticketing, bus, booking, hotel, reservation, van, rental, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 75vh;
            background: url('{!! url('/') !!}/assets/images/faqs_header.jpg') bottom no-repeat;
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

        ol li{
            padding: 15px 0px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
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
        }
    </style>
@endsection

@section('title')
    MBK - Frequently Asked Questions
@endsection

@section('content')
    <!-- Header -->
    <div id="header">
        <div class="fill">
            <h2 class="text-white">Frequently Asked Questions</h2>
        </div>
    </div>
    <!-- Header -->



    <!-- Content -->
    <div id="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h4 class="text-blue"><a id="airline-ticketing-link" href="#airline-ticketing-faqs">Airline Ticketing</a></h4>
                <h4 class="text-blue"><a id="tour-packages-link" href="#tour-packages-faqs">Tour Packages</a></h4>
                <h4 class="text-blue"><a id="hotel-reservation-link" href="#hotel-reservation-faqs">Hotel Reservation</a></h4>
                <h4 class="text-blue"><a id="bus-booking-link" href="#bus-booking-faqs">Bus Booking</a></h4>
                <h4 class="text-blue"><a id="van-rental-link" href="#van-rental-faqs">Van Rental</a></h4>
                <hr>
                <br>
                <h2 class="text-blue" id="airline-ticketing-faqs">Airline Ticketing</h2>
                <hr>
                <ol>
                    @foreach ($flight_faqs as $faq) 
                        <li>
                        <b>{!! $faq->question !!}</b><br>
                            {!! $faq->answer !!}
                        </li>
                    @endforeach
                </ol>
                <br>
                <h2 class="text-blue" id="tour-packages-faqs">Tour Packages</h2>
                <ol>
                    @foreach ($tour_faqs as $faq) 
                        <li>
                        <b>{!! $faq->question !!}</b><br>
                            {!! $faq->answer !!}
                        </li>
                    @endforeach
                </ol>
                <h2 class="text-blue" id="hotel-reservation-faqs">Hotel Reservation</h2>
                <ol>
                    @foreach ($hotel_faqs as $faq) 
                        <li>
                        <b>{!! $faq->question !!}</b><br>
                            {!! $faq->answer !!}
                        </li>
                    @endforeach
                </ol>
                <h2 class="text-blue" id="bus-booking-faqs">Bus Booking</h2>
                <ol>
                    @foreach ($bus_faqs as $faq) 
                        <li>
                        <b>{!! $faq->question !!}</b><br>
                            {!! $faq->answer !!}
                        </li>
                    @endforeach
                </ol>
                <h2 class="text-blue" id="van-rental-faqs">Van Rental</h2>
                <ol>
                    @foreach ($van_faqs as $faq) 
                        <li>
                        <b>{!! $faq->question !!}</b><br>
                            {!! $faq->answer !!}
                        </li>
                    @endforeach
                </ol>


            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            </div>
        </div>
    </div>
    <!-- Content -->


@endsection

@section ('modified-script')
    <script type="text/javascript">
        $("#airline-ticketing-link").click(function() {
            $('html, body').animate({
                scrollTop: $("#airline-ticketing-faqs").offset().top -100
            }, 500);
        });
        $("#tour-packages-link").click(function() {
            $('html, body').animate({
                scrollTop: $("#tour-packages-faqs").offset().top -100
            }, 500);
        });
        $("#hotel-reservation-link").click(function() {
            $('html, body').animate({
                scrollTop: $("#hotel-reservation-faqs").offset().top -100
            }, 500);
        });
        $("#bus-booking-link").click(function() {
            $('html, body').animate({
                scrollTop: $("#bus-booking-faqs").offset().top -100
            }, 500);
        });
        $("#van-rental-link").click(function() {
            $('html, body').animate({
                scrollTop: $("#van-rental-faqs").offset().top -100
            }, 500);
        });
    </script>
@endsection