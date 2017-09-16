@extends('admin.master')

@section('title', 'ADMIN - Testimonials')

@section('modified-style')
    <style type="text/css">
        .card{
            margin: 10px 0px 20px 0px;
        }

        #main{
            margin-top: 20px;
        }

        #main .card{
            padding: 0px;
        }

        #main .card img{
            width: 100%;
        }

        #main .card p{
            font-size: 12px;
        }

        .nav .badge{
            margin-left: 5px;
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
        <div class="row">
            <div class="col"><p>Testimonials</p></div>
        </div>
        <div class="row" id="main">
            <div class="col">
                 <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                        <?php
                            $num_pending_testimonials = count($pending_testimonials);
                            $num_approved_testimonials = count($approved_testimonials);
                            $num_denied_testimonials = count($denied_testimonials);
                        ?>
                        <a class="nav-link
                        @if ($num_pending_testimonials > 0)
                            active
                        @endif
                        " id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-expanded="true">Pending 
                        @if ($num_pending_testimonials > 0)
                            <span class="badge badge-danger">
                                {!! $num_pending_testimonials !!}
                            </span>
                        @endif
                        </a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link 
                        @if ($num_pending_testimonials == 0)
                            active
                        @endif
                        " id="approve-tab" data-toggle="tab" href="#approve" role="tab" aria-controls="approve" aria-expanded="true">Approved 
                        @if ($num_approved_testimonials > 0)
                            <span class="badge badge-danger">
                                {!! $num_approved_testimonials !!}
                            </span>
                        @endif
                        </a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="denied-tab" data-toggle="tab" href="#denied" role="tab" aria-controls="denied" aria-expanded="true">Denied 
                        @if ($num_denied_testimonials > 0)
                            <span class="badge badge-danger">
                                {!! $num_denied_testimonials !!}
                            </span>
                        @endif
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="margin-top: 20px">
                    <div class="tab-pane fade 
                        @if ($num_pending_testimonials > 0)
                            show active
                        @endif
                    " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="row">
                            @foreach ($pending_testimonials as $pt)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="card white card-light">
                                        <div class="body">
                                            <h6 class="text-blue-dark">{!! $pt->full_name !!}</h6>
                                            <hr>
                                            <p>
                                                {!! $pt->message !!}<br><br>
                                                <button class="btn btn-success text-uppercase" onclick="approveTestimonial({!! $pt->id !!})">Approve</button>
                                                <button class="btn btn-danger text-uppercase pull-right" onclick="denyTestimonial({!! $pt->id !!})">Deny</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="tab-pane fade
                        @if ($num_pending_testimonials == 0)
                            show active
                        @endif
                    " id="approve" role="tabpanel" aria-labelledby="approve-tab">
                        <div class="row">
                            @foreach ($approved_testimonials as $at)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="card white card-light">
                                        <div class="body">
                                            <h6 class="text-blue-dark">{!! $at->full_name !!}</h6>
                                            <hr>
                                            <p>
                                                {!! $at->message !!}<br><br>
                                                <button class="btn btn-danger text-uppercase pull-right" onclick="deleteTestimonial({!! $at->id !!})">Delete</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
                        <div class="row">
                            @foreach ($denied_testimonials as $dt)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="card white card-light">
                                        <div class="body">
                                            <h6 class="text-blue-dark">{!! $dt->full_name !!}</h6>
                                            <hr>
                                            <p>
                                                {!! $dt->message !!}<br><br>
                                                <button class="btn btn-danger text-uppercase pull-right" onclick="deleteTestimonial({!! $dt->id !!})">Delete</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('modified-script')
    <script type="text/javascript">
        function approveTestimonial(id) {
            swal({
                title: "Approve Testimonial?",
                type: "info",
                html: "Are you sure you want to approve this testimonial?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then(function() {
                <?php
                    $link = url('/').'/admin/testimonials/approve/';
                ?>
                window.location.href = '{!! $link !!}'+id;
            });
        }

        function denyTestimonial(id) {
            swal({
                title: "Deny Testimonial?",
                type: "info",
                html: "Are you sure you want to deny this testimonial?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then(function() {
                <?php
                    $link = url('/').'/admin/testimonials/deny/';
                ?>
                window.location.href = '{!! $link !!}'+id;
            });
        }

        function deleteTestimonial(id) {
            swal({
                title: "Delete Testimonial?",
                type: "info",
                html: "Are you sure you want to delete this testimonial?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then(function() {
                <?php
                    $link = url('/').'/admin/testimonials/delete/';
                ?>
                window.location.href = '{!! $link !!}'+id;
            });
        }
    </script>
@endsection