

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Today Workout')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Today Workout')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Phone Number')); ?></th>
                            <th><?php echo e(__('End Date')); ?></th>
                            <?php if(Gate::check('edit workout') ||  Gate::check('show workout')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $workouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="table-user">
                                    <img
                                        src="<?php echo e(!empty($workout->assignDetail) && !empty($workout->assignDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$workout->assignDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'); ?>"
                                        alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                    <a href="#" class="text-body font-weight-semibold"> <?php echo e(!empty($workout->assignDetail)?$workout->assignDetail->name:'-'); ?></a>
                                </td>
                                <td>
                                    <?php echo e(!empty($workout->assignDetail)?$workout->assignDetail->email:'-'); ?>

                                </td>
                                <td>
                                    <?php echo e(!empty($workout->assignDetail)?$workout->assignDetail->phone_number:'-'); ?>

                                </td>
                                <td><?php echo e(dateFormat($workout->end_date)); ?> </td>
                                <?php if(Gate::check('edit workout') ||  Gate::check('show workout')): ?>
                                    <td>
                                        <div class="cart-action">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show workout')): ?>
                                                <a class="text-warning customModal" data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Details')); ?>"
                                                   data-title="<?php echo e(__('Details')); ?>"
                                                   data-url="<?php echo e(route('workouts.show',\Illuminate\Support\Facades\Crypt::encrypt($workout->id))); ?>"
                                                   href="#"
                                                > <i data-feather="eye"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit workout')): ?>
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="xl" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                   data-url="<?php echo e(route('workouts.edit',$workout->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Workout')); ?>"> <i data-feather="edit"></i></a>
                                            <?php endif; ?>
                                        </div>

                                    </td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/workout/today.blade.php ENDPATH**/ ?>