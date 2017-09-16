@extends('admin.master')

@section('title', 'ADMIN - Pages > Work with us')

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
        <div class="col"><p>WORK WITH US PAGE</p></div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card white card-light">
                <div class="head">
                    <h6 class="text-blue-dark text-uppercase">WORK WITH US</h6>
                    <hr>
                </div>
                <div class="body">
                    {!! $sub->work_with_us !!}
                </div>
                <div class="footer">
                    <button class="btn btn-default" data-toggle="modal" data-target="#sub-modal">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="sub-modal" tabindex="-1" role="dialog" aria-labelledby="vanRentalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'sub-form', 'url' => url('/').'/admin/pages/update-sub/'.$sub->id, 'role' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Work with Us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <textarea class="form-control" id="summernote" name="description" rows="10" required="required">{!! $sub->work_with_us !!}</textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::hidden('sub_type', 4) !!}
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
        $(document).ready(function(){
            $("#summernote").summernote({
                minHeight: 400,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['misc', 'redo','undo','fullscreen','help']
                ],
                popover: {}
            });
        });
    </script>
@endsection