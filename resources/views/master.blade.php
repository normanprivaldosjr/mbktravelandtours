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
    @include('shared.navbar')

    <?php
        if (!isset($homepage)) {
            $homepage = DB::table('homepage')->first();
        }
    ?>

    @yield('content')

    @include('shared.footer')
    @include('shared.chatbox')
    @include('shared.social_medias')


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
    <?php
        ?>
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
            @elseif (session('continue'))
                swal({
                    title: "Success!",
                    type: "success",
                    html: "<div class=\"swal-success-status\">{{ session('continue') }}</div>",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    window.location.href = "{!! url('/') !!}/shopping-cart";
                });
            @endif
        }
        <?php
            $check_info = session('user_info');
            if (!empty($check_info)) {
                session()->forget('user_info');
                ?>

                swal({
                    title: "Welcome, "+"{!! $check_info !!}!",
                    type: "info",
                    html: "Do you want to complete your profile details?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes"
                }).then(function() {
                    window.location.href = "{!! url('/') !!}/users/settings";
                });
                    
                <?php 
            }
        ?>
       
    });
</script>
</body>

</html>