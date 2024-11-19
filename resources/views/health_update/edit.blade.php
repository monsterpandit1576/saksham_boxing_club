{{ Form::model($health, array('route' => array('health-update.update', $health->id), 'method' => 'PUT')) }}
<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('trainee',__('Trainee'),array('class'=>'form-label ')) }}
            {!! Form::select('trainee', $trainee, $health->user_id,array('class' => 'form-control hidesearch basic-select')) !!}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('measurement_date',__('Measurement Date'),array('class'=>'form-label')) }}
            {{Form::date('measurement_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','rows'=>1,'placeholder'=>__('Enter notes')))}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="#" class="btn btn-primary btn-xs health_clone float-end"><i class="ti ti-plus"></i></a>
        </div>
    </div>
    @foreach($healthHistory as $history)
        <div class="row health">
            <div class="form-group col-md-5 col-lg-5">
                {{Form::label('type',__('Measurement Type'),array('class'=>'form-label')) }}
                {!! Form::select('type[]', $measurement_type, $history->type,array('class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-5 col-lg-5">
                {{Form::label('result',__('Measurement Result'),array('class'=>'form-label')) }}
                {{Form::number('result[]',$history->result,array('class'=>'form-control','required'=>'required'))}}
            </div>
            <div class="col-auto">
                <a href="#" class="fs-20 text-danger schedule_remove health_remove btn-sm "> <i class="ti ti-trash"></i></a>
            </div>
        </div>
    @endforeach
    <div class="health_results"></div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}
<script>
    $('.wrapper').on('click', '.health_remove', function () {
        $('.health_remove').closest('.wrapper').find('.health').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.health_clone', function () {
        $('.health_clone').closest('.wrapper').find('.health').first().clone().find("input").val("").end().show().appendTo(".health_results:last");
    });
</script>



