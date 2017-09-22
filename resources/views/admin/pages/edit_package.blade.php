@extends('admin.master')

@section('title', 'ADMIN - Edit Tour Package')

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

        .card > p,
        .card li{
            font-size: 12px;
        }

        .list-group p{
            margin-top: 10px;
        }

        .list-group .btn{
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="bg-light-gray">
        <div class="row" style="margin-top: 0px">
            <div class="col">
                <small>Edit Tour Package</small>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card white card-light">
                    <form id="package-form">
                        <div class="head">
                            <h6 class="text-blue-dark" style="margin-top: 5px">{!! $tour_package->name !!}</h6>
                            <hr>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="package-name">Package Name *</label>
                                        <input type="text" class="form-control" value="{!! $tour_package->name !!}" id="name" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="summernote">
                                        {!! $tour_package->package_description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>URL *</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" style="font-size: 12px">www.mbktravelntours.com/tour-packages/</div>
                                            <input type="text" class="form-control" name="slug" id="slug" required value="{!! $tour_package->slug !!}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Price Starts at *</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" style="font-size: 12px">₱</div>
                                            <input type="text" class="form-control" name="price_starts" id="price_starts" required value="{!! $tour_package->price_starts !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label>No. of days *</label>
                                        <input type="number" class="form-control" min="1" required value="{!! $tour_package->no_of_days !!}" id="no_of_days" name="no_of_days">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label>No. of nights *</label>
                                        <input type="number" class="form-control" min="1" required value="{!! $tour_package->no_of_nights !!}" id="no_of_nights" name="no_of_nights">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label>Package type *</label>
                                        <select class="form-control" name="destination" id="destination">
                                            <option value="0" @if($tour_package->destination == 0) selected @endif>Local</option>
                                            <option value="1" @if($tour_package->destination == 1) selected @endif>International</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="selling_day_start">Selling Date (Start) *</label>
                                        <input type="text" class="form-control" name="selling_day_start" id="selling_day_start" required onkeydown="return false" placeholder="MM/DD/YYYY" value="{!! date('m/d/Y', strtotime($tour_package->selling_day_start)) !!}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="selling_day_end">Selling Date (End) *</label>
                                        <input type="text" class="form-control" name="selling_day_end" id="selling_day_end" required onkeydown="return false" placeholder="MM/DD/YYYY" value="{!! date('m/d/Y', strtotime($tour_package->selling_day_end)) !!}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="travel_day_start">Travel Date (Start) *</label>
                                        <input type="text" class="form-control" name="travel_day_start" id="travel_day_start" required onkeydown="return false" placeholder="MM/DD/YYYY" value="{!! date('m/d/Y', strtotime($tour_package->travel_day_start)) !!}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="travel_day_end">Travel Date (End) *</label>
                                        <input type="text" class="form-control" name="travel_day_end" id="travel_day_end" required onkeydown="return false" placeholder="MM/DD/YYYY" value="{!! date('m/d/Y', strtotime($tour_package->travel_day_end)) !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                    <a href="{!! url('/') !!}/admin/tour-packages/batanes" class="btn btn-default pull-right" style="margin-right: 5px">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="loading-container">
        <img src="{!! url('/') !!}/assets/admin/images/Rolling.gif">
    </div>
@endsection

@section('modified-script')
    <script>
        $(document).ready(function(){

            $("#summernote").summernote({
                minHeight: 300,
                toolbar: [
                    ['font', ['superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['para', ['ul', 'ol']],
                    ['height', ['height']],
                    ['color', ['color']],
                    ['clear', ['clear']]
                ],
                popover: {}
            });

            $("#name").on('keyup change blur', function (e) {
                if($("#name").val() == ""){
                    $("#slug").val("");
                }
                else{
                    var input = $("#name").val().toLowerCase();
                    input = input.replace(/\W+/g, '-');
                    $("#slug").val(input);
                }
            });

            $('#selling_day_start').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: {
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right'
                }
            });

            $('#selling_day_end').datetimepicker({
                minDate: moment(),
                format: 'MM/DD/YYYY',
                icons: {
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right'
                }
            });

            $("#selling_day_start").on("dp.change", function(e){
                $("#selling_day_end").data("DateTimePicker").minDate(e.date);
            });

            $('#travel_day_start').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: {
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right'
                }
            });

            $('#travel_day_end').datetimepicker({
                minDate: moment(),
                format: 'MM/DD/YYYY',
                icons: {
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right'
                }
            });

            $("#travel_day_start").on("dp.change", function(e){
                $("#travel_day_end").data("DateTimePicker").minDate(e.date);
            });

            $("#package-form").on('submit', function(e){
                e.preventDefault();

                $("#loading-container").toggleClass('active');

                var formData = new FormData($("#package-form")[0]);
                formData.append('id', {!! $tour_package->id !!});
                formData.append('package_description', $("#summernote").summernote('code'));
                formData.append('_token', "{!! csrf_token() !!}");

                $.ajax({
                    url: "{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}/package",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $("#loading-container").toggleClass('active');

                        var data = JSON.parse(res);

                        if(data.type == "error"){
                            swal(data.title, data.message, "error");
                        } else if(data.type == "success"){
                            swal(data.title, data.message, "success")
                                .then((value) => {
                                    window.location.href="{!! url('/') !!}/admin/tour-packages/{!! $tour_package->slug !!}"
                                });
                        }
                    }, error: function () {
                        $("#loading-container").toggleClass('active');
                        swal("Unable to Update Tour Package", "Server connection failed", "error");
                    }
                });
            });
        });
    </script>
@endsection