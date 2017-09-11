<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="copyright" content="Madya Biyahe Kita Travel and Tours Agency is a registered business in the Philippines">
    <meta name="description" content="@yield('meta-description')">
    <!--A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines-->
    <meta name="keywords" content="@yield('meta-keywords')">
    <!--travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita-->

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/fonts/font_awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/css/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/css/swiper/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/css/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/assets/css/style.css">
    @yield('modified-style')

</head>
<body>

<div id="container" class="container-fluid">

    @include('shared.loader')

    @yield('content')


</div>



<script type="text/javascript" src="{!! url('/') !!}/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/moment/moment.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/typeahead/typeahead.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/bootstrap_datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/swiper/swiper.jquery.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/select2/select2.full.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/validator.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/assets/js/script.js"></script>
<script type="text/javascript">

    $(function(){
        $("#cart-popover").popover({
            container: 'body'
        });
    });
</script>
@yield('modified-script')
<script type="text/javascript">
    $(document).ready(function() {
        var errors = '';
        @foreach ($errors->all() as $error)
            errors += '<li>{{ $error }}'+'</li>';
        @endforeach
        
        if (errors.length > 0) {
            swal({
                title: "Error!",
                type: "error",
                html: '<div class="swal-errors text-left" ><ul>'+errors+'</ul></div>'
            });
        }
        else {
            @if (session('status'))
                swal({
                    title: "Success!",
                    type: "success",
                    html: "<div class=\"swal-success-status\">{{ session('status') }}</div>"
                });
            @elseif (session('error'))
                swal({
                    title: "Before you proceed",
                    type: "warning",
                    html: "<div class=\"swal-success-status\">{{ session('error') }}</div>"
                });
            @endif
        }
       
    });
</script>
</body>

</html>