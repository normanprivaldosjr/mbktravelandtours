<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('/') !!}">MBK</a>
        </div>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li class="
                <?php $this_url = url('/').'/inquiries/airline-ticketing'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default">Flights</a>
                @else
                    "><a href="{!! url('/') !!}/inquiries/airline-ticketing">Flights</a>
                @endif
                </li>

                <li class="
                <?php $this_url = url('/').'/tour-packages'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default"> Packages</a>
                @else
                    "><a href="{!! url('/') !!}/tour-packages">Packages</a>
                @endif
                </li>

                <li class="
                <?php $this_url = url('/').'/inquiries/bus-booking'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default">Bus</a>
                @else
                    "><a href="{!! url('/') !!}/inquiries/bus-booking">Bus</a>
                @endif
                </li>

                <li class="
                <?php $this_url = url('/').'/visa-assistance'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default">Visa</a>
                @else
                    "><a href="{!! url('/') !!}/visa-assistance">Visa</a>
                @endif
                </li>

                <!-- <li class="
                <?php $this_url = url('/').'/travel-insurance'; ?>
                @if(Request::url() === $this_url)
                    active
                @endif
                "><a href="{!! url('/') !!}/travel-insurance">Insurance</a></li> -->

                <li class="
                <?php $this_url = url('/').'/inquiries/hotel-reservation'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default">Hotels</a>
                @else
                    "><a href="{!! url('/') !!}/inquiries/hotel-reservation">Hotels</a>
                @endif
                </li>
                <li class="
                <?php $this_url = url('/').'/inquiries/van-rental'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default">Van Rental</a>
                @else
                    "><a href="{!! url('/') !!}/inquiries/van-rental">Van Rental</a>
                @endif
                </li>
                <!-- <li class="social"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                <li class="social"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                <li class="social"><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li> -->
                <li class="
                <?php $this_url = url('/').'/shopping-cart'; ?>
                @if(Request::url() === $this_url)
                    active"><a style="cursor:default"><i class="fa fa-shopping-cart" style="margin-right: 10px"></i> Cart</a>
                @else
                    "><a href="{!! url('/') !!}/shopping-cart"><i class="fa fa-shopping-cart" style="margin-right: 10px"></i> Cart</a>
                @endif
                

                </li>
                @if (Auth::check())
                    <li class="dropdown">
                    @if (\Entrust::hasRole('manager', 'member'))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin 
                    @elseif (\Entrust::hasRole('member'))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Member 
                    @endif
                    <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if (\Entrust::hasRole('manager', 'member'))
                                <li><a href="{!! url('/') !!}/admin/dashboard">Dashboard</a></li> 
                            @endif
                            <li><a href="{!! url('/') !!}/users/profile">Profile</a></li>
                            <li><a href="{!! url('/') !!}/users/logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{!! url('/') !!}/users/login">Sign In</a></li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>
<!-- Navigation -->