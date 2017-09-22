@extends('admin.master')

@section('title', 'ADMIN - Add Tour Package')

@section('modified-style')
    <style>
        #preview{
            position: relative;
            float: left;
            width: 100%;
            height: 300px;
            overflow-y: auto;
            padding-top: 20px;
        }

        #package-image-modal img{
            max-width: 100%;
        }

        .cropper{
            width: 100%;
        }

        .card{
            margin-bottom: 20px;
        }

        .input-group-addon{
            font-size: 13px !important;
        }

        .list-group{
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="bg-light-gray">
        <form id="package-form">
            <div class="row" id="main">
                <div class="col">
                    <div class="card white card-light">
                        <div class="head">
                            <h6 class="text-blue-dark">Add New Tour Package</h6>
                            <hr>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Destination (Package Name) *</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>

                                    <div class="form-group">
                                        <div id="summernote"></div>
                                    </div>

                                    <div class="form-group">
                                        <label>URL *</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">www.mbktravelntours.com/tour-packages/</div>
                                            <input type="text" class="form-control" name="slug" id="slug" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="no_of_days">No. of Days *</label>
                                                <input type="number" class="form-control" name="no_of_days" id="no_of_days" required min="1" value="1">
                                            </div>
                                            <div class="col">
                                                <label for="no_of_nights">No. of Nights *</label>
                                                <input type="number" class="form-control" name="no_of_nights" id="no_of_nights" required min="1" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="selling_day_start">Selling Date (Start) *</label>
                                                <input type="text" class="form-control" name="selling_day_start" id="selling_day_start" required onkeydown="return false" placeholder="MM/DD/YYYY">
                                            </div>

                                            <div class="col">
                                                <label for="selling_day_end">Selling Date (End) *</label>
                                                <input type="text" class="form-control" name="selling_day_end" id="selling_day_end" required onkeydown="return false" placeholder="MM/DD/YYYY">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="travel_day_start">Travel Date (Start) *</label>
                                                <input type="text" class="form-control" name="travel_day_start" id="travel_day_start" required onkeydown="return false" placeholder="MM/DD/YYYY">
                                            </div>

                                            <div class="col">
                                                <label for="travel_day_end">Travel Date (End) *</label>
                                                <input type="text" class="form-control" name="travel_day_end" id="travel_day_end" required onkeydown="return false" placeholder="MM/DD/YYYY">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label>Price Starts at *</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">P</div>
                                                    <input type="text" class="form-control" name="price_starts" id="price_starts" required>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label>Destination Type *</label>
                                                <select class="form-control" name="destination" id="destination">
                                                    <option value="0">Local</option>
                                                    <option value="1">International</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Package Image *</label><br>
                                        <img id="package-image" style="width: 100%; margin-bottom: 10px;">
                                        <div class="btn btn-primary" id="file-input-container">
                                            <span>Upload Image *</span>
                                            <input type="file" id="new-image" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <small>Preview</small>
                                        <div id="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card white card-light">
                        <div class="head">
                            <h6 class="text-blue-dark">Package Types <button type="button" class="btn btn-primary" style="margin-left: 20px" data-toggle="modal" data-target="#package-type-modal">Add New Type</button> </h6>
                            <hr>
                        </div>
                        <div class="body">
                            <div class="list-group" id="package-type-list">
                                <p class="text-center">No Package Type Added Yet</p>
                            </div>
                            <button class="btn btn-primary pull-right" type="submit" name="submit" id="submit">Submit</button>
                            <a href="tourpackages.html" class="btn btn-default pull-right" style="margin-right: 5px">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="package-image-modal" tabindex="-1" role="dialog" aria-labelledby="packageImageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- cropping plugin -->
                    <div class="cropper">
                        <img id="cropper-image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-crop">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-image-btn">Crop</button>
                </div>
            </div>
        </div>
    </div>
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
                        <div class="form-group">
                            <label for="package-type-name">Package Type Name</label>
                            <input type="text" class="form-control" id="package-type-name" name="package-type-name">
                        </div>

                        <div class="form-group">
                            <label for="package-help-desc">Help Text</label>
                            <textarea class="form-control" id="package-help-desc" name="package-help-desc" style="resize: none" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="package-pax-price">Package Price Per PAX</label>
                            <input type="text" class="form-control" id="package-pax-price" name="package-pax-price">
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
    <div id="loading-container">
        <img src="{!! url('/') !!}/assets/admin/images/Rolling.gif">
    </div>
@endsection

@section('modified-script')
    <script>
        var package_types = [], imageData;

        $(document).ready(function () {
            var $image = $("#cropper-image");
            var image_source = null; var content = null;

            if($("#package-image").attr('src') == null){
                $("#package-image").css('display', 'none');
                $("#file-input-container span").text("Upload Image *");
            } else {
                $("#package-image").css('display', 'block');
                $("#file-input-container span").text("Change Image");
            }

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
                popover: {},
                callbacks: {
                    onChange: function(contents, $editable) {
                        content = contents;
                        $("#preview").html(contents);
                    }
                }
            });

            $("#new-image").on('change', function () {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);

                reader.onload = function (event) {
                    image_source = this.result;
                    $("#package-image-modal").modal({
                        keyboard: false,
                        backdrop: 'static'
                    });
                };
            });

            $("#package-image-modal").on('shown.bs.modal', function () {
                $image.attr('src', image_source);
                $image.cropper('destroy');
                $image.cropper({
                    movable: false,
                    zoomable: false,
                    rotatable: false,
                    scalable: false,
                    strict: false,
                    aspectRatio: 16/9,
                    autoCropArea: 0,
                });
            }).on('hidden.bs.modal', function () {
                $image.cropper('destroy');
            });

            $("#cancel-crop").on('click', function () {
                $("#new-image").val("");
                $("#package-image").css('display', 'none');
                $("#file-input-container span").text("Upload Image *");
            });

            $("#save-image-btn").on('click', function () {
                $("#loading-container").toggleClass('active');

                imageData = $image.cropper('getCroppedCanvas', { width: 950, height: 550 }).toDataURL();

                $("#package-image").attr('src', imageData);
                $("#package-image").css('display', 'block');
                $("#file-input-container span").text("Change Image");

                $("#package-image-modal").modal('toggle');
                $("#loading-container").toggleClass('active');
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
                minDate: moment(),
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
                minDate: moment(),
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

            package_types.types = {};

            $("#package-type-form").on('submit', function (e) {
                e.preventDefault();

                var item = {};
                if($("#package-type-name").val() != "" && $("#package-help-desc").val() != "" && $("#package-pax-price").val()){
                    if($("#package-type-name").val() != "") item["package_type_name"] = $("#package-type-name").val();
                    if($("#package-help-desc").val() != "") item["package_help_desc"] = $("#package-help-desc").val();
                    if($("#package-pax-price").val() != "") item["package_pax_price"] = $("#package-pax-price").val();

                    package_types.push(item);
                }

                $("#package-type-modal").modal('toggle');
                $("#package-type-form")[0].reset();

                refreshPackageTypes();
            });

            // to submit tour package ajax is highly required due to
            // cropping plugin and html editor plugin
            $("#package-form").on('submit', function (e) {
                e.preventDefault();

                if(imageData == "" || content == "" || package_types == ""){
                    // sweet alert package form is not complete
                    swal({
                        title: 'Incomplete Submission!',
                        text: 'Please fill out the form completely',
                        icon: 'error',
                        button: 'Close'
                    });
                } else{
                    $("#loading-container").toggleClass('active');

                    var formData = new FormData($("#package-form")[0]);
                    formData.append('package_image', imageData); // this is base64 image, need to decode before upload c/o norman
                    formData.append('package_description', $("#preview").html());
                    formData.append('package_types', JSON.stringify(package_types));
                    formData.append('_token', "{!! csrf_token() !!}");

                    $.ajax({
                        url: "{!! url('/') !!}/admin/tour-packages/add",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $("#loading-container").toggleClass('active');

                            var data = JSON.parse(response);

                            if(data.type == "error"){
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    icon: 'error',
                                    button: 'Close'
                                });
                            } else if(data.type == "success"){
                                $("#package-form")[0].reset();

                                $("#summernote").summernote('code', '');
                                $("#preview").html('');

                                $("#package-image").attr('src', '');
                                $("#package-image").css('display', 'none');
                                $("#new-image").val('');
                                $("#file-input-container span").text("Upload Image *");

                                package_types = [];
                                refreshPackageTypes();

                                swal(data.title, data.message, "success")
                                    .then((value) => {
                                        window.location.href = "{!! url('/') !!}/admin/tour-packages";
                                    });
                            }
                        },
                        error: function () {
                            $("#loading-container").toggleClass('active');
                            swal("Unable to Save Tour Package", "Server connection failure", "error");
                        }
                    });
                }
            });
        });

        function refreshPackageTypes() {
            if(package_types.length == 0){
                $("#package-type-list").html('<p class="text-center">No Package Type Added Yet</p>');
            } else{
                $("#package-type-list").html("");
                for(var i = 0; i < package_types.length; i++){
                    $("#package-type-list").append('<div class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><h6 class="mb-1 text-blue-dark">' + package_types[i].package_type_name + '</h6></div><p class="mb-1">' + package_types[i].package_help_desc + '<br><br>Package Price: <b>P ' + ReplaceNumberWithCommas(package_types[i].package_pax_price) + '</b></p><button class="btn btn-danger" onclick="deletePackageType(' + i + ')" style="margin-top: 10px">Delete</button></div>');
                }
            }
        }

        function ReplaceNumberWithCommas(yourNumber) {
            //Seperates the components of the number
            var n= yourNumber.toString().split(".");
            //Comma-fies the first part
            n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //Combines the two sections
            return n.join(".");
        }

        function deletePackageType(index) {
            package_types.splice(index, 1);
            refreshPackageTypes();
        }
    </script>
@endsection