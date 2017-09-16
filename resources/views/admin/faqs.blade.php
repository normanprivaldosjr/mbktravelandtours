@extends('admin.master')

@section('title', 'ADMIN - Faqs')

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
        <div class="col"><p>Frequently Asked Questions</p></div>
        <div class="col text-right"><button class="btn btn-primary" onclick="toggleAddFaqFormModal()">Add A New FAQ</button></div>
    </div>
    <div class="row" id="main">
        <div class="col">
             <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-expanded="true">Flight 
                    @if (count($flight_faqs) > 0) 
                        <span class="badge badge-danger">{!! count($flight_faqs) !!}</span>
                    @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tour-tab" data-toggle="tab" href="#tour" role="tab" aria-controls="tour" aria-expanded="true">Tour 
                    @if (count($tour_faqs) > 0) 
                        <span class="badge badge-danger">{!! count($tour_faqs) !!}</span>
                    @endif
                    </a>  
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-expanded="true">Hotel @if (count($hotel_faqs) > 0) 
                        <span class="badge badge-danger">{!! count($hotel_faqs) !!}</span>
                    @endif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="van-tab" data-toggle="tab" href="#van" role="tab" aria-controls="van" aria-expanded="true">Van
                    @if (count($van_faqs) > 0) 
                        <span class="badge badge-danger">{!! count($van_faqs) !!}</span>
                    @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bus-tab" data-toggle="tab" href="#bus" role="tab" aria-controls="bus" aria-expanded="true">Bus
                    @if (count($bus_faqs) > 0) 
                        <span class="badge badge-danger">{!! count($bus_faqs) !!}</span>
                    @endif
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent" style="margin-top: 20px">
                <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                    <div class="row">
                        @foreach ($flight_faqs as $ff)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="card white card-light">
                                    <div class="head">
                                        <h6 class="text-blue-dark">{!! $ff->question !!}</h6>
                                        <hr>
                                        <p>
                                            {!! $ff->answer !!}<br><br>
                                            <button class="btn btn-default text-uppercase" onclick="toggleEditFaq({!! $ff->id !!})">Edit</button>
                                            <button class="btn btn-danger text-uppercase pull-right" onclick="deleteFaq({!! $ff->id !!})">Delete</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                    <div class="row">
                        @foreach ($tour_faqs as $tf)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="card white card-light">
                                    <div class="head">
                                        <h6 class="text-blue-dark">{!! $tf->question !!}</h6>
                                        <hr>
                                        <p>
                                            {!! $tf->answer !!}<br><br>
                                            <button class="btn btn-default text-uppercase" onclick="toggleEditFaq({!! $tf->id !!})">Edit</button>
                                            <button class="btn btn-danger text-uppercase pull-right" onclick="deleteFaq({!! $tf->id !!})">Delete</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                    <div class="row">
                        @foreach ($hotel_faqs as $hf)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="card white card-light">
                                    <div class="head">
                                        <h6 class="text-blue-dark">{!! $hf->question !!}</h6>
                                        <hr>
                                        <p>
                                            {!! $hf->answer !!}<br><br>
                                            <button class="btn btn-default text-uppercase" onclick="toggleEditFaq({!! $hf->id !!})">Edit</button>
                                            <button class="btn btn-danger text-uppercase pull-right" onclick="deleteFaq({!! $hf->id !!})">Delete</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="van" role="tabpanel" aria-labelledby="van-tab">
                    <div class="row">
                        @foreach ($van_faqs as $vf)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="card white card-light">
                                    <div class="head">
                                        <h6 class="text-blue-dark">{!! $vf->question !!}</h6>
                                        <hr>
                                        <p>
                                            {!! $vf->answer !!}<br><br>
                                            <button class="btn btn-default text-uppercase" onclick="toggleEditFaq({!! $vf->id !!})">Edit</button>
                                            <button class="btn btn-danger text-uppercase pull-right" onclick="deleteFaq({!! $vf->id !!})">Delete</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="bus" role="tabpanel" aria-labelledby="bus-tab">
                    <div class="row">
                        @foreach ($bus_faqs as $bf)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="card white card-light">
                                    <div class="head">
                                        <h6 class="text-blue-dark">{!! $bf->question !!}</h6>
                                        <hr>
                                        <p>
                                            {!! $bf->answer !!}<br><br>
                                            <button class="btn btn-default text-uppercase" onclick="toggleEditFaq({!! $bf->id !!})">Edit</button>
                                            <button class="btn btn-danger text-uppercase pull-right" onclick="deleteFaq({!! $bf->id !!})">Delete</button>
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



    <!-- modals -->
    <!-- add/edit faq -->
    <div class="modal fade" id="faq-form-modal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'faq_form', 'url'=> url('/').'/admin/faqs/add-new', 'role' => 'form', 'data-toggle' => 'validator']) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="faq-form-modal-title">Add New Frequently Asked Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="faq-type-div">
                            <label for="faq-question">Faq Type</label>
                            <select class="form-control" id="faq_type" name="faq_type" required="required">
                                <option value="">Select Faq Type</option>
                                <option value="1">Flight</option>
                                <option value="2">Tour</option>
                                <option value="3">Hotel</option>
                                <option value="4">Bus</option>
                                <option value="5">Van</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="faq-question">Question</label>
                            <input type="text" class="form-control" id="faq-question" name="faq_question" placeholder="Enter Question" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="faq-answer">Answer</label>
                            <textarea class="form-control" id="faq-answer" name="faq_answer" placeholder="Enter Answer" style="resize: none" rows="5" required="required"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('modified-script')
    <script type="text/javascript">
        function toggleAddFaqFormModal() {
            $("#faq-form-modal-title").html("Add New Frequently Asked Question");
            $("#faq-question").val("");
            $("#faq-answer").val("");
            <?php
                $link = url('/').'/admin/faqs/add-new';
            ?>
            $("#faq_form").attr('action', '{!! $link !!}');
            $('#faq-type-div').show();
            $('#faq_type').attr("required", "required");
            $('.help-block').html("");
            $("#faq-form-modal").modal("toggle");
        }


        function toggleEditFaq(id){
            //ajax -> get the info
            //on submit reload
            $.ajax({
                    url: "{!! url('/') !!}/admin/ajax/faqs/get-info/"+id,
                    dataType: 'json',
                    delay: 250,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        //alert(data);
                        $("#faq-question").val(data[0].question);
                        $("#faq-answer").val(data[0].answer);
                        
                    },
                    error: function (jqXHR, exception) {
                        console.log(exception);
                    },
                    cache: true
                });
                $("#faq-form-modal-title").html("Edit Frequently Asked Question");
                <?php
                    $link = url('/').'/admin/faqs/edit/';
                ?>
                $("#faq_form").attr('action', '{!! $link !!}'+id);
                $('#faq-type-div').hide();
                $('#faq_type').removeAttr("required");
                $('.help-block').html("");
                $("#faq-form-modal").modal("toggle");
                
                
            
        }

        function deleteFaq(id) {
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
                <?php
                    $link = url('/').'/admin/faqs/delete/';
                ?>
                window.location.href = '{!! $link !!}'+id;
            });
        }
    </script>
@endsection