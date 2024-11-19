
{{ Form::model($trainee, array('route' => array('trainees.update', $trainee->id), 'method' => 'PUT',  'enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
    <div class="form-group col-md-6">
            {{Form::label('Title',__('Title'),array('class'=>'form-label')) }}
            {!! Form::select('Title', $title, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('Full name',__('Full Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Full name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('dob',__('Date of Birth'),array('class'=>'form-label')) }}
            {{Form::date('dob',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('parent name',__('Parent Name'),array('class'=>'form-label')) }}
            {{Form::text('parent_name',null,array('class'=>'form-control','placeholder'=>__('Enter parent name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('phone_number',__('Phone Number'),array('class'=>'form-label')) }}
            {{Form::text('phone_number',null,array('class'=>'form-control','placeholder'=>__('Enter phone number'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('email',__('Email'),array('class'=>'form-label'))}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter email'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('profile',__('Profile Picture'),array('class'=>'form-label'))}}
            {{Form::file('profile',array('class'=>'form-control'))}}
        </div>
        <!-- <div class="form-group col-md-6">/
            {{Form::label('password',__('Password'),array('class'=>'form-label')) }}
            {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter password'),'required'=>'required'))}}
        </div> -->
       
        
        <div class="form-group col-md-6">
            {{Form::label('age',__('Age'),array('class'=>'form-label')) }}
            {{Form::number('age',null,array('class'=>'form-control','placeholder'=>__('Enter age'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('gender',__('Gender'),array('class'=>'form-label')) }}
            {!! Form::select('gender', $gender, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <!-- <div class="form-group col-md-6">
            {{Form::label('country',__('Country'),array('class'=>'form-label')) }}
            {{Form::text('country',null,array('class'=>'form-control','placeholder'=>__('Enter country')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('state',__('State'),array('class'=>'form-label')) }}
            {{Form::text('state',null,array('class'=>'form-control','placeholder'=>__('Enter state')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('city',__('City'),array('class'=>'form-label')) }}
            {{Form::text('city',null,array('class'=>'form-control','placeholder'=>__('Enter city')))}}
        </div> -->
        <!-- <div class="form-group col-md-6">
            {{Form::label('zip_code',__('Zip Code'),array('class'=>'form-label')) }}
            {{Form::text('zip_code',null,array('class'=>'form-control','placeholder'=>__('Enter zip code')))}}
        </div> -->
        <div class="form-group col-md-6">
            {{Form::label('address',__('Address'),array('class'=>'form-label')) }}
            {{Form::textarea('address',null,array('class'=>'form-control','rows'=>1,'placeholder'=>__('Enter address')))}}
        </div>


        <div class="form-group col-md-6">
            {{Form::label('Plan Type',__('Plan Type'),array('class'=>'form-label')) }}
            {!! Form::select('category', $category, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('membership_plan',__('Membership'),array('class'=>'form-label')) }}
            {!! Form::select('membership_plan', $membership, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('membership_start_date',__('Membership Start Date'),array('class'=>'form-label')) }}
            {{Form::date('membership_start_date',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('height',__('Height'),array('class'=>'form-label')) }}
            {{Form::text('height',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('weight',__('Weight'),array('class'=>'form-label')) }}
            {{Form::text('weight',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('Any Known Conditions or Injuries',__('Any Known Conditions or Injuries'),array('class'=>'form-label')) }}
            {{Form::text('injuries',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('Regular medication',__('Regular medication'),array('class'=>'form-label')) }}
            {{Form::text('medication',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('fee',__('Fee'),array('class'=>'form-label')) }}
            {{Form::number('fee',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('Plan Type', __('Plan Type'), ['class' => 'form-label']) }}
            <select name="paymentmode" class="form-control hidesearch" required>
                <option value="Cash">Cash</option>
                <option value="Online">Online</option>
            </select>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

