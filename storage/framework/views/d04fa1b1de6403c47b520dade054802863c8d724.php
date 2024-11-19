
<?php $__env->startSection('page-title'); ?>
    <?php echo e(traineePrefix().$traineeDetail->id); ?> <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('trainees.index')); ?>"><?php echo e(__('Trainee')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(traineePrefix().$traineeDetail->id); ?> <?php echo e(__('Details')); ?>

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
                    <h4>  <?php echo e(traineePrefix().$traineeDetail->id); ?> <?php echo e(__('Details')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                            <img class="img-fluid"
                                src="<?php echo e(!empty($traineeDetail->profile_picture) ? asset(Storage::url('upload/profile')).'/'.$traineeDetail->profile_picture : asset(Storage::url('upload/profile')).'/avatar.png'); ?>"
                                alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Name')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->name); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Parent Name')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->parent_name); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Address')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->address); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Date of Birth')); ?></h6>
                                <p class="mb-20"><?php echo e(dateFormat($traineeDetail->dob)); ?> </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Email')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->email); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Phone number')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->phone_number); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Height')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->height); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Weight')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->weight); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Injuries')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->injuries); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Medication')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->medication); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Fee')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->fee); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Payment Mode')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->paymentmode); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Age')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->age); ?> </p>
                            </div>
                        </div>                        
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Membership Plan')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->membership_plan); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Membership Start Date')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->membership_start_date); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Gender')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->gender); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Created At')); ?></h6>
                                <p class="mb-20"><?php echo e($traineeDetail->created_at); ?> </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_club\resources\views/trainee/show.blade.php ENDPATH**/ ?>