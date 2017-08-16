<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row banner">

            <div class="col-md-12">

                <h1 class="text-center margin-top-100 editContent">
                    Learning Laravel 5
                </h1>

                <h3 class="text-center margin-top-100 editContent">Building Practical Applications</h3>

                <div class="text-center">
                    <img src="https://learninglaravel.net/img/LearningLaravel5_cover0.png" width="302" height="391" alt="">
                </div>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>