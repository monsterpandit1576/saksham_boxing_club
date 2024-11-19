
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Attendance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Attendance')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create attendance')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="<?php echo e(route('attendances.create')); ?>"
           data-title="<?php echo e(__('Create Attendance')); ?>"> <i
                    class="ti-plus mr-5"></i>
            <?php echo e(__('Create Attendance')); ?>

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
                            <th><?php echo e(__('User')); ?></th>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Checked In Time')); ?></th>
                            <th><?php echo e(__('Checked Out Time')); ?></th>
                            <th><?php echo e(__('Notes')); ?></th>
                            <?php if(Gate::check('edit attendance') ||  Gate::check('delete attendance')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(!empty($attendance->users)?$attendance->users->name:'-'); ?> </td>
                                <td><?php echo e(dateFormat($attendance->date)); ?> </td>
                                <td><?php echo e(timeFormat($attendance->checked_in_time)); ?> </td>
                                <td><?php echo e(timeFormat($attendance->checked_out_time)); ?> </td>
                                <td><?php echo e($attendance->notes); ?> </td>
                                <?php if(Gate::check('edit attendance') ||  Gate::check('delete attendance')): ?>
                                    <td>
                                        <div class="cart-action">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['attendances.destroy', $attendance->id]]); ?>


                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit attendance')): ?>
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="md" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                   data-url="<?php echo e(route('attendances.edit',$attendance->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Attendance')); ?>"> <i data-feather="edit"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete attendance')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_club\resources\views/attendance/index.blade.php ENDPATH**/ ?>