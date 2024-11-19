@extends('layouts.app')
@section('page-title')
    {{traineePrefix().$traineeDetail->id}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('trainees.index')}}">{{__('Trainee')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{traineePrefix().$traineeDetail->id}} {{__('Details')}}
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
                    <h4>  {{traineePrefix().$traineeDetail->id}} {{__('Details')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                            <img class="img-fluid"
                                src="{{ !empty($traineeDetail->profile_picture) ? asset(Storage::url('upload/profile')).'/'.$traineeDetail->profile_picture : asset(Storage::url('upload/profile')).'/avatar.png' }}"
                                alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Name')}}</h6>
                                <p class="mb-20">{{$traineeDetail->name}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Parent Name')}}</h6>
                                <p class="mb-20">{{$traineeDetail->parent_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Address')}}</h6>
                                <p class="mb-20">{{$traineeDetail->address}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Date of Birth')}}</h6>
                                <p class="mb-20">{{dateFormat($traineeDetail->dob)}} </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Email')}}</h6>
                                <p class="mb-20">{{$traineeDetail->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Phone number')}}</h6>
                                <p class="mb-20">{{$traineeDetail->phone_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Height')}}</h6>
                                <p class="mb-20">{{$traineeDetail->height}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Weight')}}</h6>
                                <p class="mb-20">{{$traineeDetail->weight}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Injuries')}}</h6>
                                <p class="mb-20">{{$traineeDetail->injuries}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Medication')}}</h6>
                                <p class="mb-20">{{$traineeDetail->medication}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Fee')}}</h6>
                                <p class="mb-20">{{$traineeDetail->fee}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Payment Mode')}}</h6>
                                <p class="mb-20">{{$traineeDetail->paymentmode}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Age')}}</h6>
                                <p class="mb-20">{{$traineeDetail->age}} </p>
                            </div>
                        </div>                        
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Membership Plan')}}</h6>
                                <p class="mb-20">{{$traineeDetail->membership_plan}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Membership Start Date')}}</h6>
                                <p class="mb-20">{{$traineeDetail->membership_start_date}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Gender')}}</h6>
                                <p class="mb-20">{{$traineeDetail->gender}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Created At')}}</h6>
                                <p class="mb-20">{{$traineeDetail->created_at}} </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-xxl-12 cdx-xxl-100">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h4>{{__('Assign Trainee')}}</h4>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="table-responsive">--}}
    {{--                        <table class="display dataTable cell-border datatbl-advance">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th>{{__('ID')}}</th>--}}
    {{--                                <th>{{__('Name')}}</th>--}}
    {{--                                <th>{{__('Email')}}</th>--}}
    {{--                                <th>{{__('Phone Number')}}</th>--}}
    {{--                                <th>{{__('Membership')}}</th>--}}
    {{--                                <th>{{__('Membership Start Date')}}</th>--}}
    {{--                                <th>{{__('Membership Expiry Date')}}</th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}

    {{--                            @foreach ($trainees as $trainee)--}}

    {{--                                <tr>--}}
    {{--                                    <td>{{ traineePrefix().$trainee->trainee_id }} </td>--}}
    {{--                                    <td class="table-user">--}}
    {{--                                        <img--}}
    {{--                                            src="{{!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"--}}
    {{--                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">--}}
    {{--                                        <a href="#"--}}
    {{--                                           class="text-body font-weight-semibold">{{ $trainee->userDetail->name }}</a>--}}
    {{--                                    </td>--}}
    {{--                                    <td>{{ !empty($trainee->userDetail->email)?$trainee->userDetail->email:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership)?$trainee->membership->title:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership_start_date)?dateFormat($trainee->membership_start_date):'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership_expiry_date)?dateFormat($trainee->membership_expiry_date):__('Lifetime') }} </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
