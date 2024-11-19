
<?php $__env->startSection('page-title'); ?>
    <?php echo e($membership->title); ?> <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('membership.index')); ?>"><?php echo e(__('Membership')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e($membership->title); ?> <?php echo e(__('Details')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4> <?php echo e($membership->title); ?></h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Title')); ?></h6>
                                <p class="mb-20"><?php echo e($membership->title); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Package')); ?></h6>
                                <p class="mb-20"><?php echo e($membership->package); ?> </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Amount')); ?></h6>
                                <p class="mb-20"> Rs <?php echo e(($membership->amount)); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Number of Session')); ?></h6>
                                <p class="mb-20">
                                <?php echo e(($membership->no_session)); ?> 
                                   
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('User Created At')); ?></h6>
                                <p class="mb-20"> <?php echo e($membership->created_at); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_club\resources\views/membership/show.blade.php ENDPATH**/ ?>