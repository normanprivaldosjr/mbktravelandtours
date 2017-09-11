@if (Auth::check())
    <?php
        $subscriber = DB::table('subscribers')->where('email', Auth::user()->email)->first();
        if (empty($subscriber)) {
            //not yet subscribed
            ?>
            <!-- Newsletter -->
            <div class="row bg-blue">
                {!! Form::open(['id' => 'subscription-form', 'url' => url('/').'/subscribe-to-newsletter', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                    <div id="newsletter" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="text-white text-uppercase"><i class="fa fa-envelope"></i> Subscribe To Our Newsletter</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">

                                {!! Form::email('email_address', Auth::user()->email, ['class' => 'form-control', 'id' => 'email_address', 'placeholder' => 'Enter Email Address', 'required' => 'required']) !!}
                                <div class="help-block with-errors"></div>
                            </div>  
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" id="newsletter-btn">
                            {!! Form::button('Subscribe', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- Newsletter -->
            <?php
        }
        else {
            //already subscribed
            //don't display anything
        }
    ?>
@else
    <!-- Newsletter -->
    <div class="row bg-blue">
        {!! Form::open(['id' => 'subscription-form', 'url' => url('/').'/subscribe-to-newsletter', 'data-toggle' => 'validator', 'role' => 'form']) !!}
            <div id="newsletter" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p class="text-white text-uppercase"><i class="fa fa-envelope"></i> Subscribe To Our Newsletter</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">

                        {!! Form::email('email_address', '', ['class' => 'form-control', 'id' => 'email_address', 'placeholder' => 'Enter Email Address', 'required' => 'required']) !!}
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" id="newsletter-btn">
                    {!! Form::button('Subscribe', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- Newsletter -->
@endif