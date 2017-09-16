@extends('admin.master')

@section('title', 'ADMIN - Pages > Home')

@section('modified-style')
    <style type="text/css">
        #content > .row{
            margin-bottom: 20px;
        }
        
        .card .head{
            padding-bottom: 0px;
        }
        
        .card .body{
            padding-top: 5px;
        }
        
        .card .body p{
            font-size: 13px;
        }
        
        .tab-pane img{
            width: 50px;
        }
    </style>
@endsection

@section('content')
<div id="content" class="bg-light-gray">
    <div class="row">
        <div class="col"><p>HOME PAGE</p></div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card white card-light">
                <div class="head">
                    <h6 class="text-blue-dark text-uppercase">About</h6>
                    <hr>
                </div>
                <div class="body">
                    <p>
                        {!! $homepage->about !!}<br><br>
                        <button class="btn btn-default" onclick="edit_settings('About')">Edit</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card white card-light">
                <div class="head">
                    <h6 class="text-blue-dark text-uppercase">Mission</h6>
                    <hr>
                </div>
                <div class="body">
                    <p>
                        {!! $homepage->mission !!}<br><br>
                        <button class="btn btn-default" onclick="edit_settings('Mission')">Edit</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card white card-light">
                <div class="head">
                    <h6 class="text-blue-dark text-uppercase">Vision</h6>
                    <hr>
                </div>
                <div class="body">
                    <p>
                        {!! $homepage->vision !!}<br><br>
                        <button class="btn btn-default" onclick="edit_settings('Vision')">Edit</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card white card-light">
                <div class="head">
                    <h6 class="text-blue-dark text-uppercase">Services</h6>
                    <hr>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <?php $counter = 0; ?>
                                @foreach ($services as $service)
                                    <a class="list-group-item list-group-item-action 
                                    @if ($counter == 0)
                                        active
                                    @endif
                                    " id="list-{!! $service->id !!}-list" data-toggle="list" href="#list-{!! $service->id !!}" role="tab" aria-controls="{!! $service->id !!}">{!! $service->name !!}</a>

                                    <?php $counter++; ?>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <?php $counter = 0; ?>
                                @foreach ($services as $service)
                                    <div class="tab-pane fade show
                                    @if ($counter == 0)
                                        active
                                    @endif
                                    " id="list-{!! $service->id !!}" role="tabpanel" aria-labelled-by="list-{!! $service->id !!}-list">
                                        <img src="{!! url('/') !!}/assets/images/{!! $service->icon !!}">
                                        <br><br>
                                        <p>
                                            {!! $service->description !!}<br><br>
                                            <button class="btn btn-default" onclick="edit_service('{!! $service->id !!}', '{!! $service->name !!}', '{!! $service->description !!}')">Edit</button>
                                        </p>
                                    </div>
                                    <?php $counter++; ?>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="homepage-modal" tabindex="-1" role="dialog" aria-labelledby="vanRentalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'homepage-form', 'url' => url('/').'/admin/pages/home/update', 'role' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">About</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <textarea class="form-control" id="description" name="description" rows="10" required="required"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="vanRentalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'service-form', 'url' => url('/').'/admin/pages/home/update-service', 'role' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" id="service_name" name="service_name" required="required">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="service_description" name="service_description" rows="5" required="required"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



@endsection

@section('modified-script')
    <script type="text/javascript">

        function edit_settings(settings_type) {
            
            $('#modal-title').html(settings_type);
            var link = '{!! url("/") !!}'+'/admin/pages/home/update-';
            link += settings_type.toLowerCase();
            $('#homepage-form').attr("action", link);
            
            $('.help-block').html("");

            if (settings_type == "About") {
                $('#description').val('{!! $homepage->about !!}');
            }
            else if (settings_type == "Mission") {
                $('#description').val('{!! $homepage->mission !!}');
            }
            else {
                $('#description').val('{!! $homepage->vision !!}');
            }

            $('#homepage-modal').modal('toggle');
        }

        function edit_service(id, name, description) {
            var link = '{!! url("/") !!}'+'/admin/pages/home/update-service/';
            link += id;
            $('#service-form').attr("action", link);
            
            $('.help-block').html("");
            $('#service_name').val(name);
            $('#service_description').val(description);

            $('#service-modal').modal('toggle');
        }
    </script>
@endsection