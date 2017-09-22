@extends('admin.master')

@section('title', 'ADMIN - Tour Packages')

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
    </style>
@endsection

@section('content')

    <div id="content" class="bg-light-gray">
        <div class="row">
            <div class="col"><small>Tour Packages</small></div>
            <div class="col text-right">
                <a href="{!! url('/') !!}/admin/tour-packages/add" class="btn btn-primary">Add New Package</a>
            </div>
        </div>
        <div class="row" id="main">
            @foreach($packages as $package)
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="card white card-light">
                        <img src="{!! $package->package_image !!}">
                        <div class="body">
                            <a href="{!! url('/') !!}/admin/tour-packages/{!! $package->slug !!}" class="text-blue-dark"><b>{!! $package->name !!}</b></a>
                            <hr>
                            @if(strlen($package->package_description) > 200)
                                <?php echo substr($package->package_description, 0, 200)."..." ?>
                            @else
                                <?php echo $package->package_description; ?>
                            @endif
                            <p>
                                <br>
                                Travel Period: <b>{!! $package->no_of_days !!}D{!! $package->no_of_nights !!}N</b><br>
                                Price Starts at: <b>₱ {!! number_format($package->price_starts, 2, '.', ',') !!}</b><br><br>
                            </p>
                            <a href="{!! url('/') !!}/admin/tour-packages/{!! $package->slug !!}" class="btn btn-default text-uppercase">Edit</a>
                            <button class="btn btn-danger text-uppercase pull-right" onclick="deletePackage({!! $package->id !!})">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('modified-script')
    <script>
        function deletePackage(id) {
            swal({
                text: "Are you sure you want to delete this tour package?",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if(willDelete){
                    $.ajax({
                        url: "{!! url('/') !!}/admin/tour-packages/" + id + "/delete",
                        type: "POST",
                        data: { '_token':"{!! csrf_token() !!}" },
                        success: function () {
                            swal("Tour Package Removed", "Information regardin tour package has been removed", "success")
                                .then((value) => {
                               window.location.reload();
                            });
                        }, error: function () {
                            swal("Unable to Remove Tour Package", "Server connection failed", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection