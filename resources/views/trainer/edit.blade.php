{{ Form::model($trainer, array('route' => array('trainers.update', $trainer->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('email',__('Email'),array('class'=>'form-label'))}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter email'),'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('phone_number',__('Phone Number'),array('class'=>'form-label')) }}
            {{Form::text('phone_number',null,array('class'=>'form-control','placeholder'=>__('Enter phone number'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('dob',__('Date of Birth'),array('class'=>'form-label')) }}
            {{Form::date('dob',!empty($trainer->trainerDetail)?$trainer->trainerDetail->dob:null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('gender',__('Gender'),array('class'=>'form-label')) }}
            {!! Form::select('gender', $gender, !empty($trainer->trainerDetail)?$trainer->trainerDetail->gender:null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('qualification',__('Qualification'),array('class'=>'form-label')) }}
            {{Form::text('qualification',!empty($trainer->trainerDetail)?$trainer->trainerDetail->qualification:null,array('class'=>'form-control','placeholder'=>__('Enter qualification')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('country',__('Country'),array('class'=>'form-label')) }}
            {{Form::text('country',!empty($trainer->trainerDetail)?$trainer->trainerDetail->country:null,array('class'=>'form-control','placeholder'=>__('Enter country')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('state',__('State'),array('class'=>'form-label')) }}
            {{Form::text('state',!empty($trainer->trainerDetail)?$trainer->trainerDetail->state:null,array('class'=>'form-control','placeholder'=>__('Enter state')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('city',__('City'),array('class'=>'form-label')) }}
            {{Form::text('city',!empty($trainer->trainerDetail)?$trainer->trainerDetail->city:null,array('class'=>'form-control','placeholder'=>__('Enter city')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('zip_code',__('Zip Code'),array('class'=>'form-label')) }}
            {{Form::text('zip_code',!empty($trainer->trainerDetail)?$trainer->trainerDetail->zip_code:null,array('class'=>'form-control','placeholder'=>__('Enter zip code')))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('address',__('Address'),array('class'=>'form-label')) }}
            {{Form::textarea('address',!empty($trainer->trainerDetail)?$trainer->trainerDetail->address:null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter address')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('status',__('Status'),array('class'=>'form-label')) }}
            {!! Form::select('status', $status, !empty($trainer->trainerDetail)?$trainer->trainerDetail->status:null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

