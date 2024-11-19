

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Membership')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Membership')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create membership')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('membership.create')); ?>"
           data-title="<?php echo e(__('Create Membership')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Membership')); ?>

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
                            <th><?php echo e(__('Package')); ?></th>
                            <th><?php echo e(__('Amount')); ?></th>
                            <th><?php echo e(__('No. of Sessions')); ?></th>
                            <?php if(Gate::check('edit membership') ||  Gate::check('delete membership')||  Gate::check('show membership')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($membership->title); ?> </td>
                                <td>
                                    <?php echo e(\App\Models\Membership::$package[$membership->package]); ?>

                                </td>
                                <td><?php echo e(priceFormat($membership->amount)); ?> </td>

                                <td>
                                <?php echo e(($membership->no_session)); ?> 
                                    <!-- <?php if(!empty($membership->classes_id)): ?>
                                        <?php $__currentLoopData = $membership->claases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($class->title); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?> -->
                                </td>

                                <?php if(Gate::check('edit membership') ||  Gate::check('delete membership')||  Gate::check('show membership')): ?>
                                    <td>
                                        <div class="cart-action">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['membership.destroy', $membership->id]]); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show membership')): ?>
                                                <a class="text-warning " data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Details')); ?>"
                                                   href="<?php echo e(route('membership.show',\Illuminate\Support\Facades\Crypt::encrypt($membership->id))); ?>"
                                                > <i class="fa fa-eye"></i>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit membership')): ?>
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                   data-url="<?php echo e(route('membership.edit',$membership->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Membership')); ?>"><i class="fa fa-edit"></i>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete membership')): ?>
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i class="fa fa-trash-o"></i></a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saksham_boxing_club\resources\views/membership/index.blade.php ENDPATH**/ ?>