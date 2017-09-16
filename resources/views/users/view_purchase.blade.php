@extends('master')


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 70vh;
            background: url('{!! url('/') !!}/assets/images/faqs_header.jpg') center no-repeat;
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

@section('title', 'View Order Details')

@section('content')
    <?php 
        $user_info = DB::table('users')->where('id', $purchase->user_id)->first();
    ?>
    <div id="header">
        <div class="fill">
            <div id="profile-container">

                <div id="name-container">
                    <h1 class="text-white">OR NO. {!! $purchase->id !!} </h1>
                    <p class="text-white">{!! $user_info->first_name !!} {!! $user_info->last_name !!}</p>
                </div>
            </div>
            @if ($purchase->purchase_status != 2 && $purchase->purchase_status != 1)
                <button id="cancel-order-btn" class="btn btn-danger">Cancel Order</button>
            @endif
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding: 0px">
                @if (Auth::user()->hasRole('manager'))
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <a href="{!! url('/') !!}/dashboard/tour-clients" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Tour Clients</a>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <a href="{!! url('/') !!}/users/profile" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Profile</a>
                        </div>
                    </div>
                @endif
                    
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        ORDER BY<br>
                        <b>
                        
                        {!! $user_info->first_name !!} {!! $user_info->last_name !!}</b><br>
                        {!! $user_info->city !!}, {!! $user_info->province !!}<br>
                        {!! $user_info->phone_number !!}<br><br>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        DATE &amp; TIME<br>
                        <b>
                            {!! date("F j, Y h:m A", strtotime($purchase->created_at)) !!}<br><br>
                        </b>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                            function file_upload_max_size() {
                              static $max_size = -1;

                              if ($max_size < 0) {
                                // Start with post_max_size.
                                $post_max_size = parse_size(ini_get('post_max_size'));
                                if ($post_max_size > 0) {
                                  $max_size = $post_max_size;
                                }

                                // If upload_max_size is less, then reduce. Except if upload_max_size is
                                // zero, which indicates no limit.
                                $upload_max = parse_size(ini_get('upload_max_filesize'));
                                if ($upload_max > 0 && $upload_max < $max_size) {
                                  $max_size = $upload_max;
                                }
                              }
                              return $max_size;
                            }

                            function parse_size($size) {
                              $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
                              $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
                              if ($unit) {
                                // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
                                return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
                              }
                              else {
                                return round($size);
                              }
                            }

                            function formatBytes($size, $precision = 2)
                            {
                                $base = log($size, 1024);
                                $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

                                return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
                            }
                        ?>
                        <h3>DEPOSIT RECEIPT</h3>
                            <img src="{!! $purchase->proof_of_purchase !!}" class="proof-of-purchase">
                            {!! Form::open(['url' => url('/').'/users/profile/purchases/upload-receipt', 'id' => 'upload-deposit-receipt', 'data-toggle' => 'validator', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                            {!! Form::hidden('purchase_id', $purchase->id) !!}                        
                            <p>
                                Please deposit your payment to <b class="text-blue">{!! $bank_info->branch !!}</b> with
                                the account name <b class="text-blue">{!! $bank_info->account_name !!}</b> and
                                account number <b class="text-blue">{!! $bank_info->account_number !!}</b> and upload a clear
                                photo/scan of your deposit receipt your order page located in your profile.
                            </p>
                            @if (empty($purchase->proof_of_purchase))
                                <i>If you want to change the receipt, just re-upload the new proof of payment.</i>
                                <br>
                                <b class="text-blue">The accepted file types are PDF, and images with a maximum of 
                                {!! formatBytes(parse_size(file_upload_max_size()), 0) !!} in file size;</b>
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    {!! Form::file('proof_of_purchase', ['required' => 'required']) !!}
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            {!! Form::button('Upload', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
                            {!! Form::close() !!}
                        
                    </div>
                </div>
                <div class="row">
                <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Package Name</th>
                                    <th>Travel Date</th>
                                    <th>Travel Period</th>
                                    <th class="text-center">No. of PAX</th>
                                    <th class="text-right">Price</th>
                                </thead>
                                <tbody>
                                    @foreach ($purchased_items as $purchased_item)
                                        <tr>
                                            <td>{!! $purchased_item->package_name !!} ({!! $purchased_item->package_type !!})</td>
                                            <td>{!! date("F j, Y", strtotime($purchased_item->chosen_travel_date)) !!}</td>
                                            <td>{!! $purchased_item->travel_period !!}</td>
                                            <td class="text-center">{!! $purchased_item->customer_pax !!}</td>
                                            <td class="text-right">₱ {!! number_format($purchased_item->price, 2, '.', ',') !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Subtotal</th>
                                        <th class="text-right">₱ {!! number_format($purchase->subtotal, 2, '.', ',') !!}</th>
                                    </tr>
                                    <tr id="mis-container">
                                        <th colspan="4" class="text-right">Tax ({!! $homepage->tax !!}%)</th>
                                        <th id="mis-charge" class="text-right">₱ {!! number_format($purchase->tax, 2, '.', ',') !!}</th>
                                    </tr>
                                    <tr id="mis-container">
                                        <th colspan="4" class="text-right">Miscellaneous Fee</th>
                                        <th id="mis-charge" class="text-right">₱ {!! number_format($purchase->miscellaneous_fee, 2, '.', ',') !!}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th id="total" class="text-right text-blue">₱ {!! number_format($purchase->total, 2, '.', ',') !!}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


@endsection

@section('modified-script')
    <script type="text/javascript">
        $('#cancel-order-btn').on('click', function() {
            swal({
                title: "Are you sure?",
                type: "info",
                html: "Do you really want to cancel you order?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then(function() {
                window.location.href = "{!! url('/') !!}/users/purchase/cancel-order/{!! $purchase->id !!}";
            });
        });
            
    </script>
@endsection