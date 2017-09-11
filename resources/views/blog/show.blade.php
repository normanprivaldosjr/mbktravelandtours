@extends('master')

@section('meta-description', $post->meta_description)
@section('meta-keywords', $post->meta_keys)

@section('modified-style')

    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 75vh;
            background: url('{!! $post->src !!}') bottom no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #header h2{
            position: absolute;
            width: calc(100% - 140px);
            bottom: 50px;
            left: 70px;
            font-size: 45px;
            line-height: 30px;
        }

        #header h2 small{
            font-size: 12px;
            color: #FFFFFF;
            padding-left: 4px;
        }

        #header .btn{
            margin: 3px 0px 0px 0px;
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
            padding: 50px 70px;
        }

        #content img{
            width: 100%;
            margin-bottom: 10px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        @media (max-width: 768px) and (min-width: 426px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #content{
                padding: 50px 15px;
            }
        }

        @media (max-width: 425px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #header h2 .btn{
                display: none;
            }

            #content{
                padding: 50px 15px;
            }
        }
    </style>
@endsection

@section('title', 'MBK - '.$post->title)

@section('content')
    
    <!-- Header -->
    <div id="header">
        <div class="fill">
            <h2 class="text-white"> {!! $post->title !!}<br><small>{!! date("F j, Y", strtotime($post->date_published)) !!}</small></h2>
        </div>
    </div>
    <!-- Header -->

    <!-- Content -->
    <div id="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <a href="{!! url('/') !!}/blogs" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back to Blogs</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                {!! $post->content !!}
                <br>
                <br>
                <i>~ {!! $post->author !!}</i>
                <br><br>
                <a href="{!! url('/') !!}/blogs" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back to Blogs</a>
                <!-- <button class="btn btn-default text-blue text-uppercase pull-right">Next</button> -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <img src="../assets/images/ads/ad_landscape_two.jpg" style="width: 100%">
                <br>
                <img src="../assets/images/ads/ad_landscape_two.jpg" style="width: 100%">
                <br>
                <img src="../assets/images/ads/ad_landscape_two.jpg" style="width: 100%">
            </div>
        </div>
    </div>
    <!-- Content -->

    
@endsection

@section('modified-script')
    <script type="text/javascript">
    </script>
@endsection
