<?php echo e(Form::open(array('url'=>'trainers','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('email',__('Email'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter email'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('password',__('Password'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter password'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('phone_number',__('Phone Number'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('phone_number',null,array('class'=>'form-control','placeholder'=>__('Enter phone number'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('dob',__('Date of Birth'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('dob',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('gender',__('Gender'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('gender', $gender, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('qualification',__('Qualification'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('qualification',null,array('class'=>'form-control','placeholder'=>__('Enter qualification')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign_class',__('Classes'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('assign_class[]', $classes, null,array('class' => 'form-control hidesearch basic-select','multiple')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('country',__('Country'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('country',null,array('class'=>'form-control','placeholder'=>__('Enter country')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('state',__('State'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('state',null,array('class'=>'form-control','placeholder'=>__('Enter state')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city',__('City'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('city',null,array('class'=>'form-control','placeholder'=>__('Enter city')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('zip_code',__('Zip Code'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('zip_code',null,array('class'=>'form-control','placeholder'=>__('Enter zip code')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('address',__('Address'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('address',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter address')))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\saksham_boxing_clubs\resources\views/trainer/create.blade.php ENDPATH**/ ?>