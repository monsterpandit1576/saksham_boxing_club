<?php
    $profile = asset(Storage::url('upload/profile/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Trainers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>">
                <h1><?php echo e(__('Dashboard')); ?></h1>
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Trainers')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create trainer')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
            data-url="<?php echo e(route('trainers.create')); ?>" data-title="<?php echo e(__('Create Trainer')); ?>"> <i class="ti-plus mr-5"></i>
            <?php echo e(__('Create Trainer')); ?>

        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('User')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Phone Number')); ?></th>
                                <th><?php echo e(__('Classes')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit trainer') || Gate::check('delete trainer') || Gate::check('show trainer')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(trainerPrefix() . $trainer->trainerDetail->trainer_id); ?> </td>
                                    <td class="table-user">
                                        <img src="<?php echo e(!empty($trainer->avatar) ? asset(Storage::url('upload/profile')) . '/' . $trainer->avatar : asset(Storage::url('upload/profile')) . '/avatar.png'); ?>"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#" class="text-body font-weight-semibold"><?php echo e($trainer->name); ?></a>
                                    </td>
                                    <td><?php echo e($trainer->email); ?> </td>
                                    <td><?php echo e(!empty($trainer->phone_number) ? $trainer->phone_number : '-'); ?> </td>
                                    <td>
                                        <?php $__currentLoopData = $trainer->classAssign(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($class); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($trainer->trainerDetail) && $trainer->trainerDetail->status == 1): ?>
                                            <span
                                                class="badge badge-success"><?php echo e(App\Models\TrainerDetail::$status[$trainer->trainerDetail->status]); ?></span>
                                        <?php else: ?>
                                            <span
                                                class="badge badge-danger"><?php echo e(App\Models\TrainerDetail::$status[$trainer->trainerDetail->status]); ?></span>
                                        <?php endif; ?>

                                    </td>
                                    <?php if(Gate::check('edit trainer') || Gate::check('delete trainer') || Gate::check('show trainer')): ?>
                                        <td>
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['trainers.destroy', $trainer->id]]); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show trainer')): ?>
                                                    <a class="text-warning " data-bs-toggle="tooltip" data-size="lg"
                                                        data-bs-original-title="<?php echo e(__('Details')); ?>"
                                                        href="<?php echo e(route('trainers.show', \Illuminate\Support\Facades\Crypt::encrypt($trainer->id))); ?>">
                                                        <i data-feather="eye"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit trainer')): ?>
                                                    <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                                        data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                        data-url="<?php echo e(route('trainers.edit', $trainer->id)); ?>"
                                                        data-title="<?php echo e(__('Edit Trainer')); ?>"> <i data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete trainer')): ?>
                                                    <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                            data-feather="trash-2"></i></a>
                                                <?php endif; ?>
                                                <?php echo Form::close(); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/trainer/index.blade.php ENDPATH**/ ?>