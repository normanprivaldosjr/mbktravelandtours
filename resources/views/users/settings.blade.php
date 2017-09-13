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

        table tr td{
            padding: 5px 0px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        .profile-picture{
            width: 100px;
            margin-right: 15px;
        }

        #picture-input-btn{
            position: relative;
            overflow: hidden;
        }

        #picture-input{
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
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

@section('title', 'MBK Travel and Tours')

@section('content')

    <div id="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="text-blue text-uppercase" style="margin: 0px">Account Settings</h2>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['id' => 'update-profile-form', 'data-toggle' => 'validator', 'role' => 'form', 'enctype' => 'multipart/form-data'])  !!}
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card bg-blue">
                    <div id="croppie"></div>
                <!--<img src="{!! Auth::user()->profile_picture !!}" class="profile-picture">
                        {!! Form::file('profile_picture') !!}-->
                <!-- <button class="btn btn-primary text-uppercase">
                        @if (!empty(Auth::user()->profile_picture))
                    Change Photo
                @else
                    Upload Photo
                @endif
                        </button> -->
                </div>
                <span class="btn btn-primary text-uppercase" id="picture-input-btn">
                        Change Image
                        <input type="file" id="picture-input" accept="image/*">
                    </span>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                <h5><b class="text-uppercase">Accout Information</b></h5>
                <hr>
                <table>
                    <tr>
                        <td width="150">First Name: </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('first_name', Auth::user()->first_name, ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'Enter First Name', 'required' => 'required']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Middle Initial: </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('middle_initial', Auth::user()->middle_initial, ['class' => 'form-control', 'id' => 'middle_initial', 'placeholder' => 'Enter Middle Initial']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('last_name', Auth::user()->last_name, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Enter Last Name', 'required' => 'required']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Email Address: </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        <i>{!! Auth::user()->email !!}</i>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('phone_number', Auth::user()->phone_number, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'Enter Phone Number', 'pattern' => '^([0-9+]{1,2})?\(?[0-9]{3}\)?[.-]?[0-9]{3}[.-]?[0-9]{4,5}$']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Address (City/Town): </td>
                        <td><b>
                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('city', Auth::user()->city, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Enter City']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </b></td>
                    </tr>
                    <tr>
                        <td>Province: </td>
                        <td><b><div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        {!! Form::text('province', Auth::user()->province, ['class' => 'form-control', 'id' => 'province', 'placeholder' => 'Enter Province']) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div></b></td>
                    </tr>
                    <tr>
                        <td>Birthdate: </td>
                        <td><b>

                                {!! Form::text('birthday', '', ['class' => 'form-control', 'id' => 'profile-birthdate', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required', 'onkeydown' => 'return false']) !!}
                            </b></td>
                    </tr>
                    <tr>
                        <td>Linked Account:</td>
                        <td>
                            <?php $link_type = Auth::user()->link_type ?>
                            @if ($link_type == 0)
                                None
                            @elseif ($link_type == 1)
                                <b class="text-blue"><i class="fa fa-facebook"></i> Facebook</b>
                            @elseif ($link_type == 2)
                                <b class="text-red"><i class="fa fa-google"></i> Google</b>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Newsletter:</td>
                        <td>
                            <?php
                            $subscriber = DB::table('subscribers')->where('email', Auth::user()->email)->first();
                            if (empty($subscriber)) {
                                echo '<b><a class="text-blue" href="'.url('/').'/subscribe-to-newsletter/registered-user">Click here to subscribe</a></b>';
                            }
                            else {
                                echo '<b><a class="text-red" href="'.url('/').'/unsubscribe-registered/'.$subscriber->uniqid.'">Unsubscirbe?</a></b>';
                            }
                            ?>

                        </td>
                    </tr>
                    <!--<tr>
                        <td>Facebook:</td>
                        <td><b class="text-blue"><i class="fa fa-check"></i> Linked</b></td>
                    </tr>
                    <tr>
                        <td>Google:</td>
                        <td><b class="text-red"><i class="fa fa-times"></i> Not Linked</b></td>
                    </tr>-->
                </table>
                <br>
                @if (!empty($_GET['for']))
                    @if ($_GET['for'] == 'checkout')
                        {!! Form::button('Proceed to Checkout', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
                        {!! Form::hidden('for', 'checkout') !!}
                    @endif
                @else
                    {!! Form::button('Update Information', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
                    <a class="btn btn-default text-uppercase" href="{!! url('/') !!}/users/change-password">Change Password</a>
                @endif

            </div>
            {!! Form::close() !!}
        </div>

    </div>


@endsection

@section('modified-script')
    <script type="text/javascript">
        $dp = $("#croppie").croppie({
            enableExif: true,
            url: '{!! Auth::user()->profile_picture !!}',
            viewport: {
                width: 150,
                height: 150,
                type: 'circle'
            },
            boundary: {
                width: 150,
                height: 150
            },
            showZoomer: false
        });

        function readFile(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $dp.croppie('bind', {
                        url : e.target.result
                    });
                }
            }
            reader.readAsDataURL(input.files[0]);
        }

        $(window).on('load', function(){
            $("#container").addClass("loaded");
            $("#loader").fadeOut("slow");

            setTimeout(function(){
                $("#loader").addClass("inactive");
            }, 1000);

            $("#payment-method").on("change", function(e){
                if($("#payment-method").val() == 1){
                    $("#bank-deposit").css("display", "block");
                    $("#other").css("display", "none");
                } else {
                    $("#bank-deposit").css("display", "none");
                    $("#other").css("display", "block");
                }
            });
        });
        $(document).ready(function() {
            <?php
                $birthday = "";
                $old_birthday = old('birthday');
                if (!empty($old_birthday)) {
                    $birthday = date("m/d/Y", strtotime($old_birthday));
                }
                else if (!empty(Auth::user()->birthday)) {
                    $birthday = date("m/d/Y", strtotime(Auth::user()->birthday));
                }
                else {
                    $birthday = "";
                }
            ?>

            $('#profile-birthdate').datetimepicker({
                maxDate: moment(),
                date: '{!! $birthday !!}',
                format: 'MM/DD/YYYY',
                icons: {
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right'
                }
            });

            $("#picture-input").on('change', function(){
                readFile(this);
            });

            $("#update-profile-form").on("submit", function(e){
                e.preventDefault();

                $dp.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                }).then(function(resp){
                    var formData = new FormData($("#update-profile-form")[0]);
                    formData.append('profile_picture', resp);

                    $.ajax({
                        url: "{!! url('/') !!}/users/settings",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            window.location.href = "{!! url('/') !!}/users/profile";
                        }
                    });
                });
            });
        });
    </script>
@endsection