@extends('admin.master')

@section('title', 'ADMIN - Tour Clients')

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

        #main .dataTable{
            border-collapse: collapse !important;
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
        <div class="row"><div class="col"><small>Quick Statistics</small></div></div>
        <div class="row" id="quick-stat">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="card card-light bg-blue text-white">
                    <p>Total Revenue</p>
                    <h3><b>₱ {!! number_format($total_revenue, 2, '.', ',') !!}</b></h3>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="card card-light bg-green text-white">
                    <p>Monthly Revenue</p>
                    <h3><b>₱ {!! number_format($monthly_revenue, 2, '.', ',') !!}</b></h3>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="card card-light bg-amber text-white">
                    <p>Accounts Receivable</p>
                    <h3><b>₱ {!! number_format($accounts_receivable, 2, '.', ',') !!}</b></h3>
                </div>
            </div>
        </div>
        <div class="row" id="main">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <small>Pending Tour Clients</small>
                <div class="card white card-light">
                    <div class="head bg-blue">
                        <h6 class="text-white">Pending Tour Clients <span class="badge badge-danger">{!! $total_pending_tour_clients !!}</span></h6>
                        <small class="text-white">Click the row to cater client</small>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table" id="pending-clients">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Package(s)</th>
                                        <th class="text-center">Chosen Travel Date(s)</th>
                                        <th class="text-right">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <small>Previous Tour Clients</small>
                <div class="card white card-light">
                    <div class="head bg-blue">
                        <h6 class="text-white">Previous Tour Clients</h6>
                        <small class="text-white">Click the row to review tour information</small>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table" id="previous-clients">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Package(s)</th>
                                        <th class="text-center">Total Charge</th>
                                        <th>Date and Time Paid</th>
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
    <!-- modals -->
    <!-- pending tour modal -->
    <div class="modal fade" id="tour-client-modal" tabindex="-1" role="dialog" aria-labelledby="pendingTourLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pendingTourLabel">Pending Tour Client</h5>
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
                                    <td><b><span id="tc-modal-name"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Birthdate &amp; Age:</td>
                                    <td><b><span id="tc-modal-bday-age"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><b><span id="tc-modal-phone-number"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><b><span id="tc-modal-email"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><b><span id="tc-modal-address"></span></b></td>
                                </tr>
                            </table>
                            <br>
                            <h6 class="text-blue-dark">Tour Package Information</h6>
                            <table>
                                <tr>
                                    <td width="150">Package Name(s) and Type(s):</td>
                                    <td><b><span id="tc-modal-package"></span></b></td>
                                </tr>
                                <tr>
                                    <td width="150">Travel Date(s) and Travel Period:</td>
                                    <td><b><span id="tc-modal-travel-date-period"></span></b></td>
                                </tr>
                                <tr>
                                    <td>No. of PAX:</td>
                                    <td><b><span id="tc-modal-pax"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Subtotal:</td>
                                    <td><b><span id="tc-modal-subtotal"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Miscellaneous Fee:</td>
                                    <td><b><span id="tc-modal-misc"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Tax:</td>
                                    <td><b><span id="tc-modal-tax"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Total Charge:</td>
                                    <td><b><span id="tc-modal-total"></span></b></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        <span id="tc-modal-status"></span>
                                        <!-- show image of deposit receipt if already paid -->
                                    </td>
                                </tr>
                                <tr class="is-paid">
                                    <td>Date &amp; time paid:</td>
                                    <td>
                                        <span id="tc-modal-datetime-paid"></span>
                                        <!-- show image of deposit receipt if already paid -->
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="is-paid">
                                <h6 >Deposit Receipt</h6>
                                <span id="tc-modal-receipt"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="tc-modal-mark-approved-btn">Approve?</button>
                    <button type="button" class="btn btn-danger" id="tc-modal-deny-btn">Deny &amp; Delete</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('modified-script')
    <script type="text/javascript">
        //$(document).ready(function() {


            //===================  PENDING TOUR INQUIRIES  ===================//


            var tc_table = $('#pending-clients').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/tour-clients/get-all-pending",
                
                "columns": [
                    { "data": "name" },
                    { "data": "package" },
                    { "data": "chosen_travel_date" },
                    { "data": "purchase_status" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [0],
                        "width": "20%",
                    },
                    {
                        "targets": [1, 2],
                        "width": "30%",
                    },
                    {
                        "targets": [3],
                        "width": "10%",
                    },
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleTourModal("+data.id+")");
                },
            }).columns.adjust().draw();


            var pc_table = $('#previous-clients').DataTable({
                "resposive": true,
                "ajax": "{!! url('/') !!}/admin/ajax/tour-clients/get-all-previous",
                
                "columns": [
                    { "data": "name" },
                    { "data": "package" },
                    { "data": "total" },
                    { "data": "chosen_travel_date" },
                    { "data": "id"}
                ],
                "columnDefs": [
                    {
                        "targets": [0],
                        "width": "20%",
                    },
                    {
                        "targets": [1, 3],
                        "width": "30%",
                    },
                    {
                        "targets": [2],
                        "width": "10%",
                    },
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    //console.log(data)
                    $(row).attr("onclick", "toggleTourModal("+data.id+")");
                },
            }).columns.adjust().draw();

            function toggleTourModal(id){
                $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/tour-clients/get-info/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        //console.log(data);
                        $('#tc-modal-name').html(data[0].name);
                        $('#tc-modal-bday-age').html(data[0].bday_and_age);
                        $('#tc-modal-phone-number').html(data[0].phone_number);
                        $('#tc-modal-email').html(data[0].email);
                        $('#tc-modal-address').html(data[0].address);
                        $('#tc-modal-package').html(data[0].package);
                        $('#tc-modal-travel-date-period').html(data[0].travel_date_period);
                        $('#tc-modal-pax').html(data[0].no_of_pax);
                        $('#tc-modal-subtotal').html(data[0].subtotal);
                        $('#tc-modal-misc').html(data[0].misc);
                        $('#tc-modal-tax').html(data[0].tax);
                        $('#tc-modal-total').html(data[0].total);
                        $('#tc-modal-status').html(data[0].purchase_status);
                        $('#tc-modal-datetime-paid').html(data[0].datetime_paid);
                        $('#tc-modal-receipt').html(data[0].proof_of_purchase);
                        if (data[0].status == 0 || data[0].status == 1) {
                            $('#tc-modal-mark-approved-btn').show();
                            $('#tc-modal-mark-approved-btn').attr('onclick', 'markAsApproved('+id+')');
                            if (data[0].status == 0) {
                                $('.is-paid').hide();
                            }
                            else {//paid but pending
                                $('.is-paid').show();
                            }
                        }
                        else {
                            $('.is-paid').show();
                            $('#tc-modal-mark-approved-btn').hide();
                        }
                        
                        $('#tc-modal-deny-btn').attr('onclick', 'denyTourClient('+id+')');
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#tour-client-modal").modal("toggle");
            }


            function markAsApproved(id) {
                //
                swal({
                    title: "Are you sure to approve this client?",
                    type: "info",
                    html: "Before approving, make sure that the payment he/she has given is valid.",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/tour-clients/mark-as-approved/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#tc-modal-mark-approved-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#tc-modal-mark-approved-btn').html('Approve?');
                            $("#tour-client-modal").modal("toggle");
                            if (data == "success") {
                                swal({
                                    title: "Success",
                                    type: "success",
                                    html: "<div class=\"swal-success-status\">The client's order has been approved.</div>"
                                });
                            }
                            else {
                                swal({
                                    title: "Error",
                                    type: "error",
                                    html: "<div class=\"swal-success-status\">Something went wrong, please try again later.</div>"
                                });
                            }
                            pc_table.ajax.reload();
                            tc_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
            }

            function denyTourClient(id) {
                //loading -> success -> error -> swal -> table reload
                swal({
                    title: "Delete and Deny Tour Client?",
                    type: "info",
                    html: "Are you sure you want to delete this purchase?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    $.ajax({
                        url: "{!! url('/') !!}/admin/ajax/tour-clients/deny/"+id,
                        delay: 250,
                        data: {
                            'id': id
                        },
                        beforeSend: function () {
                            $('#tc-modal-deny-btn').html('<i class="fa fa-spinner"></i> Loading...');
                        },
                        success: function (data) {
                            //alert(data);
                            //console.log(data);
                            //console.log(data);
                            $('#tc-modal-deny-btn').html('Deny &amp; Delete');
                            $("#tour-client-modal").modal("toggle");
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
                            pc_table.ajax.reload();
                            tc_table.ajax.reload();
                            
                        },
                        error: function (jqXHR, exception) {
                            console.log(exception);
                        },
                        cache: true
                    });
                });
                    
                
            }


        

        
    </script>
@endsection