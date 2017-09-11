@extends('master')

@section('meta-description', 'Blogs of MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'blogs, articles, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')

    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 75vh;
            background: url('{!! url('/') !!}/assets/images/blog/blog.jpg') bottom no-repeat;
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

        #content .row-centered img{
            width: 100%;
            margin-bottom: 10px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        .ad_image{
            content: url('{!! url('/') !!}/assets/images/ads/ad_landscape.jpg');
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

            .ad_image{
                content: url('{!! url('/') !!}/assets/images/ads/ad_landscape_two.jpg');
            }
        }
    </style>
@endsection

@section('title', 'MBK - Blogs')

@section('content')
    
    <!-- Header -->
    <div id="header">
        <div class="fill">
            <h2 class="text-white">Blogs</h2>
        </div>
    </div>
    <!-- Header -->

    <!-- Content -->
    <div id="content">
        @if ($posts->isEmpty())
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <h4 class="text-blue">
                    Sorry, there is no available blog post for now.
                </h4>
            </div>
        @else
            <div class="row row-centered">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        
                            <a href="{!! url('/') !!}/blog/{!! $post->slug !!}"><img src="{!! $post->src !!}"></a>
                            <div class="caption text-left">
                                <a href="{!! url('/') !!}/blog/{!! $post->slug !!}"><h4 class="text-blue">{!! $post->title !!}</h4></a>
                                <p>
                                    <?php
                                        $pos=strpos($post->content, ' ', 160); 
                                    ?>
                                    
                                    {!! substr($post->content, 0, $pos) !!}...
                                </p>
                                <p class="text-gray"> {!! date("F j, Y", strtotime($post->date_published)) !!} <span class="pull-right"><i class="fa fa-comment"></i> 2</span></p>
                            </div>
                        
                    </div>
                @endforeach
            </div>
            <div class="row">
                <center>
                    {!! $posts->links() !!}
                </center>
            </div>
        @endif

    </div>
    <!-- Content -->

    
@endsection

@section('modified-script')
    <script type="text/javascript">
    </script>
@endsection
