{{Form::open(array('url'=>'membership','method'=>'post'))}}
<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('title',__('Title'),array('class'=>'form-label')) }}
            {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('Plan Type',__('Plan Type'),array('class'=>'form-label')) }}
            {!! Form::select('category', $category, null,array('class' => 'form-control hidesearch',)) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('package',__('Package'),array('class'=>'form-label')) }}
            {!! Form::select('package', $package, null,array('class' => 'form-control hidesearch basic-select')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('Number of session',__('Number of session'),array('class'=>'form-label'))}}
            {{Form::number('no_session',null,array('class'=>'form-control','placeholder'=>__('Enter Number Session'),'required'=>'required'))}}
        </div>
       
        <div class="form-group col-md-6">
            {{Form::label('amount',__('Amount'),array('class'=>'form-label'))}}
            {{Form::number('amount',null,array('class'=>'form-control','placeholder'=>__('Enter amount'),'required'=>'required'))}}
        </div>
       
        <!-- <div class="form-group col-md-12">
            {{Form::label('classes_id',__('Class'),array('class'=>'form-label')) }}
            {!! Form::select('classes_id[]', $classes, null,array('class' => 'form-control hidesearch basic-select','multiple')) !!}
        </div> -->
        <!-- <div class="form-group col-md-12">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter notes')))}}
        </div> -->
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}
