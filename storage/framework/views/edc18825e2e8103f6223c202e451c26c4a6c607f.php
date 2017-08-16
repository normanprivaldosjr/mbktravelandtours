<?php $__env->startSection('title', 'About'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="content">
            <div class="title">About Page</div>
            <div class="quote">Our about page!</div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>