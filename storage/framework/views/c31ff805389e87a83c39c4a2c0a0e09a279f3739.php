<?php echo e(Form::model($membership, array('route' => array('membership.update', $membership->id), 'method' => 'PUT'))); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title',__('Title'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('package',__('Package'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('package', $package, null,array('class' => 'form-control hidesearch basic-select')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('Plan Type',__('Plan Type'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('category', $category, null,array('class' => 'form-control hidesearch',)); ?>

        </div>
      
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount',__('Amount'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('amount',null,array('class'=>'form-control','placeholder'=>__('Enter amount'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
        <?php echo e(Form::label('Number of session',__('Number of session'),array('class'=>'form-label'))); ?>

        <?php echo e(Form::number('no_session',null,array('class'=>'form-control','placeholder'=>__('Enter Number Session'),'required'=>'required'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/membership/edit.blade.php ENDPATH**/ ?>