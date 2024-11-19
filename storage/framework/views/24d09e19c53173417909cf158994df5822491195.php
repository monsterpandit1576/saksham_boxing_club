

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Classes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Classes')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create class')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('classes.create')); ?>"
           data-title="<?php echo e(__('Create Class')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Class')); ?>

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
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Fees')); ?></th>
                            <th><?php echo e(__('Address')); ?></th>
                            <th><?php echo e(__('Trainer')); ?></th>
                            <th><?php echo e(__('Total Trainee')); ?></th>
                            <?php if(Gate::check('edit class') ||  Gate::check('delete class')||  Gate::check('show class')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($class->title); ?> </td>
                                <td><?php echo e(priceFormat($class->fees)); ?> </td>
                                <td><?php echo e($class->address); ?> </td>
                                <td>
                                    <?php $__currentLoopData = $class->classAssignTrainer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(!empty($trainer->userDetail)?$trainer->userDetail->name:'-'); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e(count($class->classAssignTrainee)); ?> </td>
                                <?php if(Gate::check('edit class') ||  Gate::check('delete class')||  Gate::check('show class')): ?>
                                    <td>
                                        <div class="cart-action">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['classes.destroy', $class->id]]); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show class')): ?>
                                                <a class="text-warning " data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Details')); ?>"
                                                   href="<?php echo e(route('classes.show',\Illuminate\Support\Facades\Crypt::encrypt($class->id))); ?>"
                                                > <i data-feather="eye"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit class')): ?>
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                   data-url="<?php echo e(route('classes.edit',$class->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Class')); ?>"> <i data-feather="edit"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete class')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/classes/index.blade.php ENDPATH**/ ?>