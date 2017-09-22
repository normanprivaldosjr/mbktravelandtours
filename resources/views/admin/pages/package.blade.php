@extends('admin.master')

@section('title', 'ADMIN - Tour Package')

@section('modified-style')
    <style type="text/css">
        .card .head{
            padding-bottom: 5px;
        }

        .card .body{
            padding-top: 0px;
            padding-bottom: 25px;
        }

        .row{
            margin-top: 15px;
        }

        .card{
            padding: 0px;
        }

        .card img{
            width: 100%;
        }

        .card p,
        .card li{
            font-size: 12px;
        }

        .list-group p{
            margin-top: 10px;
        }

        .list-group .btn{
            margin-top: 10px;
        }

        #package-image-modal img{
            max-width: 100%;
        }

        .cropper{
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="bg-light-gray">
        <div class="row" style="margin-top: 0px">
            <div class="col">
                <small>Tour Packages</small>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card white card-light">
                    <div class="head">
                        <h6 class="text-blue-dark" style="margin-top: 5px">Package Information</h6>
                        <hr>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <img src="{!! $tour_package->package_image !!}" style="width: 100%">
                                <br><br>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#package-image-modal" data-backdrop="static" data-keyboard="false">Change Image</button>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                <h6>{!! strtoupper($tour_package->name) !!} ({!! $tour_package->no_of_days !!}D{!! $tour_package->no_of_nights !!}N)</h6>
                                {!! $tour_package->package_description !!}
                                <p>
                                    Price Starts: <b>₱ {!! number_format($tour_package->price_starts, 2, '.', ',') !!}</b><br>
                                    Selling Timeframe: <b>{!! date('m/d/Y', strtotime($tour_package->selling_day_start)) !!} - {!! date('m/d/Y', strtotime($tour_package->selling_day_end)) !!}</b><br>
                                    Travel Timeframe: <b>{!! date('m/d/Y', strtotime($tour_package->travel_day_start)) !!} - {!! date('m/d/Y', strtotime($tour_package->travel_day_end)) !!}</b>
                                </p>
                                <a href="{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/package" class="btn btn-primary pull-right">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card white card-light">
                    <div class="head">
                        <h6 class="text-blue-dark">Package Types</h6>
                        <hr>
                    </div>
                    <div class="body">
                        <div class="list-group">
                            @foreach($package_types as $package_type)
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 text-blue-dark">{!! $package_type->type_name !!}</h6>
                                    </div>
                                    <p class="mb-1">
                                        {!! $package_type->help_info !!}<br><br>
                                        Package Price: <b>₱ {!! number_format($package_type->price, 2, '.', ',') !!}</b>
                                    </p>
                                    <button class="btn btn-default" style="margin-right: 5px" onclick="editPackageType({!! $package_type->id !!})">Edit</button>
                                    <button class="btn btn-danger" onclick="deletePackageType({!! $package_type->id !!})">Delete</button>
                                </div>
                            @endforeach
                            {{--<div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 text-blue-dark">Twin Package</h6>
                                </div>
                                <p class="mb-1">
                                    Twin Package means two people will be staying for each hotel room to occupy during the entire tour<br>
                                    Package Price: <b>P 26, 401.00/pax</b>
                                </p>
                                <button class="btn btn-default" style="margin-right: 5px;" onclick="editPackageType()">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </div>--}}
                        </div>
                        <button class="btn btn-primary pull-right" style="margin-top: 20px" onclick="addPackageType()">Add New Package Type</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modals -->
    <!-- change image -->
    <div class="modal fade" id="package-image-modal" tabindex="-1" role="dialog" aria-labelledby="packageImageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageImageLabel">Update Package Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- cropping plugin -->
                    <div class="cropper">
                        <img id="cropper-image">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary mr-auto" id="file-input-container">
                        Change Photo
                        <input type="file" id="new-image">
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-image-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add/edit package type modal -->
    <div class="modal fade" id="package-type-modal" tabindex="-1" role="dialog" aria-labelledby="packageTypeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="package-type-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="packageTypeLabel">Add Package Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="type_name">Package Type Name *</label>
                            <input type="text" class="form-control" id="type_name" name="type_name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Package Type Price *</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="help_info">Package Type Description *</label>
                            <textarea class="form-control" id="help_info" name="help_info" rows="5" style="resize: none" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- loading animation -->
    <!-- to prevent user from doing something while performing background task -->
    <div id="loading-container">
        <img src="{!! url('/') !!}/assets/admin/images/Rolling.gif">
    </div>
    <!-- end loading animation -->
@endsection

@section('modified-script')
    <script>
        function editPackageType(id){
            $.ajax({
                url: "{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/package-type/" + id,
                type: "POST",
                data: {
                    '_token':"{!! csrf_token() !!}"
                },
                success: function (res) {
                    var data = JSON.parse(res);

                    if(data.type == "success"){
                        $("#id").val(id);
                        $("#type_name").val(data.type_name);
                        $("#price").val(data.price);
                        $("#help_info").html(data.help_info);
                        $("#packageTypeLabel").html("Edit Package Type");
                        $("#package-type-modal").modal('toggle');
                    } else if(data.type == "error"){
                        swal(data.title, data.message, "error");
                    }
                }, error: function () {
                    swal("Unable to Update Package Type", "Server connection failure", "error");
                }
            });
        }

        function addPackageType(){
            $("#id").val("0");
            $("#type_name").val("");
            $("#help_info").html("");
            $("#price").val("");

            $("#packageTypeLabel").html("Add Package Type");

            $("#package-type-modal").modal("toggle");
        }

        function deletePackageType(id){
            swal({
                text: "Are you sure you want to delete this package type?",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if(willDelete){
                    $.ajax({
                       url: "{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/package-type/" + id + "/delete",
                        type: "POST",
                        data: { '_token':"{!! csrf_token() !!}" },
                        success: function(res){
                           swal("Package Type Removed", "Package type information has been removed", "success")
                               .then((value) => {
                              window.location.reload();
                           });
                        }, error: function () {
                            swal("Unable to Delete Package Type", "Server connection failure", "error");
                        }
                    });
                }
            });
        }

        $(document).ready(function(){
            var $image = $("#cropper-image");

            $("#package-image-modal").on('shown.bs.modal', function(){
                // load predefined tour package image
                $image.attr('src', '{!! $tour_package->package_image !!}');

                $image.cropper({
                    movable: false,
                    zoomable: false,
                    rotatable: false,
                    scalable: false,
                    strict: false,
                    aspectRatio: 16/9,
                    autoCropArea: 0
                });
            }).on('hidden.bs.modal', function(){
                $image.cropper('destroy');
            });

            $("#new-image").on('change', function(){
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function(event) {
                    $image.attr('src', this.result);
                    $image.cropper('destroy');
                    $image.cropper({
                        movable: false,
                        zoomable: false,
                        rotatable: false,
                        scalable: false,
                        strict: false,
                        aspectRatio: 16/9,
                        autoCropArea: 0
                    });
                };
            });

            $("#save-image-btn").on('click', function(){
                $("#package-image-modal").modal('toggle');
                $("#loading-container").toggleClass('active');

                var imageData = $image.cropper('getCroppedCanvas', { width: 950, height: 550 }).toDataURL();

                $.ajax({
                    url: "{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/image",
                    type: "POST",
                    data: {
                        'id' : "{!! $tour_package->id !!}",
                        'package_image' : imageData,
                        '_token' : "{!! csrf_token() !!}"
                    },
                    success: function (res) {
                        $("#loading-container").toggleClass('active');

                        var data = JSON.parse(res);
                        if(data.type == "error"){
                            swal(data.title, data.message, "error");
                        } else if(data.type == "success"){
                            swal(data.title, data.message, "success")
                                .then((value) => {
                                    window.location.reload();
                                });
                        }
                    },
                    error: function () {
                        $("#loading-container").toggleClass('active');
                        swal("Unable to Update Package Image", "Server connection failure", "error");
                    }
                });
            });

            $("#package-type-form").on('submit', function (e) {
                e.preventDefault();

                var id = $("#id").val();
                var name = $("#type_name").val();
                var price = $("#price").val();
                var help = $("#help_info").val();

                $("#package-type-modal").modal('toggle');
                $("#loading-container").toggleClass('active');

                $.ajax({
                    url: "{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/package-type/" + id + "/update",
                    type: "POST",
                    data: {
                        'id':id,
                        'type_name':name,
                        'price':price,
                        'help_info':help,
                        '_token':"{!! csrf_token() !!}"
                    },
                    success: function (res) {
                        $("#loading-container").toggleClass('active');
                        var data = JSON.parse(res);

                        if(data.type == "error"){
                            swal(data.title, data.message, "error");
                        } else{
                            swal(data.title, data.message, "success")
                                .then((value) => {
                                window.location.reload();
                        });
                        }
                    }, error: function () {
                        $("#loading-container").toggleClass('active');
                        swal("Unable to Update Package Type", "Server connection failed", "error");
                    }
                });
            })
        });
    </script>
@endsection