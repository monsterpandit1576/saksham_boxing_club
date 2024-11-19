<?php echo e(Form::open(array('url'=>'attendances','method'=>'post'))); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('user_id',__('User'),array('class'=>'form-label '))); ?>

            <?php echo Form::select('user_id', $users, null,array('class' => 'form-control hidesearch basic-select')); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('date',__('Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('date',date('Y-m-d'),array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('checked_in_time',__('Checked In Time'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::time('checked_in_time',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('checked_out_time',__('Checked Out Time'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::time('checked_out_time',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter notes')))); ?>

        </div>
    </div>

</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\saksham_boxing_club\resources\views/attendance/create.blade.php ENDPATH**/ ?>