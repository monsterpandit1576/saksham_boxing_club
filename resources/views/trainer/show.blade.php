@extends('layouts.app')
@section('page-title')
    {{traineePrefix().$trainerDetail->id}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('trainers.index')}}">{{__('Trainer')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{traineePrefix().$trainerDetail->id}} {{__('Details')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>  {{traineePrefix().$trainerDetail->id}} {{__('Details')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Name')}}</h6>
                                <p class="mb-20">{{$trainer->name}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Email')}}</h6>
                                <p class="mb-20">{{$trainer->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Phone Number')}}</h6>
                                <p class="mb-20">{{$trainer->phone_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Date of Birth')}}</h6>
                                <p class="mb-20">{{dateFormat($trainerDetail->dob)}} </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Gender')}}</h6>
                                <p class="mb-20">{{$trainerDetail->gender}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Qualification')}}</h6>
                                <p class="mb-20">{{$trainerDetail->qualification}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Country')}}</h6>
                                <p class="mb-20">{{$trainerDetail->country}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('State')}}</h6>
                                <p class="mb-20">{{$trainerDetail->state}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('City')}}</h6>
                                <p class="mb-20">{{$trainerDetail->city}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Zip Code')}}</h6>
                                <p class="mb-20">{{$trainerDetail->zip_code}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Address')}}</h6>
                                <p class="mb-20">{{$trainerDetail->address}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Class')}}</h6>
                                <p class="mb-20">
                                    @foreach($trainer->classAssign() as $class)
                                        {{$class}}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 cdx-xxl-100">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Assign Trainee')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display dataTable cell-border datatbl-advance">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone Number')}}</th>
                                <th>{{__('Membership')}}</th>
                                <th>{{__('Membership Start Date')}}</th>
                                <th>{{__('Membership Expiry Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($trainees as $trainee)

                                <tr>
                                    <td>{{ traineePrefix().$trainee->trainee_id }} </td>
                                    <td class="table-user">
                                        <img
                                            src="{{!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold">{{ $trainee->userDetail->name }}</a>
                                    </td>
                                    <td>{{ !empty($trainee->userDetail->email)?$trainee->userDetail->email:'-' }} </td>
                                    <td>{{ !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-' }} </td>
                                    <td>{{ !empty($trainee->membership)?$trainee->membership->title:'-' }} </td>
                                    <td>{{ !empty($trainee->membership_start_date)?dateFormat($trainee->membership_start_date):'-' }} </td>
                                    <td>{{ !empty($trainee->membership_expiry_date)?dateFormat($trainee->membership_expiry_date):__('Lifetime') }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
