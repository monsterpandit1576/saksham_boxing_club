<?php echo e(Form::open(array('url'=>'health-update','method'=>'post'))); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('trainee',__('Trainee'),array('class'=>'form-label '))); ?>

            <?php echo Form::select('trainee', $trainee, null,array('class' => 'form-control hidesearch basic-select')); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('measurement_date',__('Measurement Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('measurement_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter notes')))); ?>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="#" class="btn btn-primary btn-xs health_clone float-end"><i class="ti ti-plus"></i></a>
        </div>
    </div>
    <div class="row health">
        <div class="form-group col-md-5 col-lg-5">
            <?php echo e(Form::label('type',__('Measurement Type'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('type[]', $measurement_type, null,array('class' => 'form-control')); ?>

        </div>
        <div class="form-group col-md-5 col-lg-5">
            <?php echo e(Form::label('result',__('Measurement Result'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('result[]',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-auto">
            <a href="#" class="fs-20 text-danger schedule_remove health_remove btn-sm "> <i class="ti ti-trash"></i></a>
        </div>
    </div>
    <div class="health_results"></div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
    $('.wrapper').on('click', '.health_remove', function () {
        $('.health_remove').closest('.wrapper').find('.health').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.health_clone', function () {
        $('.health_clone').closest('.wrapper').find('.health').first().clone().find("input").val("").end().show().appendTo(".health_results:last");
    });
</script>
<?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/health_update/create.blade.php ENDPATH**/ ?>