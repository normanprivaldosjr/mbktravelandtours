<!-- Airline Partners -->
<div class="row">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 text-center box">
        <h2 class="title text-uppercase text-blue">Airline Partners</h2>
        <div id="logo-swiper" class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($airline_partners as $airline_partner)
                    <div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/{!! $airline_partner->image !!}"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Airline Partners -->