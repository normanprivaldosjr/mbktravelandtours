<!-- Promo -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="promo-container">
        <div class="fill box text-center">
            <h2 class="text-white" id="promo-title">{!! $homepage->promo_title !!}</h2>
            <p class="text-white" id="promo-desc">{!! $homepage->promo_desc !!}</p>
            <a href="{!! url('/') !!}/{!! $homepage->promo_link !!}" class="btn btn-primary text-uppercase">Buy Now</a>
        </div>
    </div>
</div>
<!-- Promo -->