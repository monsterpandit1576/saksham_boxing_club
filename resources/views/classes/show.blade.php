@extends('layouts.app')
@section('page-title')
    {{$classes->title}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('classes.index')}}">{{__('Classes')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{$classes->title}} {{__('Details')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Class Details')}}</h4>
                    @can('edit class')
                        <div class="setting-card action-menu">
                            <a class="text-success customModal" data-bs-toggle="tooltip"
                               data-size="lg" data-bs-original-title="{{__('Edit')}}" href="#"
                               data-url="{{ route('classes.edit',$classes->id) }}"
                               data-title="{{__('Edit Class')}}"> <i data-feather="edit"></i></a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6>{{__('Title')}}</h6>
                                <p class="mb-20">{{$classes->title}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6>{{__('Fees')}}</h6>
                                <p class="mb-20">{{priceFormat($classes->fees) }} </p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6>{{__('Address')}}</h6>
                                <p class="mb-20"> {{ $classes->address }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6>{{__('Notes')}}</h6>
                                <p class="mb-20"> {{ $classes->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Schedule')}}</h4>
                    @can('edit class')
                        <div class="setting-card action-menu">
                            <a class="text-success customModal" data-bs-toggle="tooltip"
                               data-size="lg" data-bs-original-title="{{__('Edit')}}" href="#"
                               data-url="{{ route('classes.edit',$classes->id) }}"
                               data-title="{{__('Edit Class')}}"> <i data-feather="edit"></i></a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('Day')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('End Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($classes->classSchedule as $schedule)
                                <tr>
                                    <td>{{ $schedule->days }} </td>
                                    <td>{{ timeFormat($schedule->start_date) }} </td>
                                    <td>{{ timeFormat($schedule->end_date)}} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-6 cdx-xxl-50">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Trainee')}}</h4>
                    @if(Gate::check('user assign class'))
                        <div class="setting-card action-menu">
                            <div class="setting-card action-menu">
                                <a class="text-primary customModal" data-bs-toggle="tooltip"
                                   data-size="lg" data-bs-original-title="{{__('Assign Trainee')}}" href="#"
                                   data-url="{{ route('classes.user.assign',[$classes->id,'trainee']) }}"
                                   data-title="{{__('Assign Trainee')}}"> <i data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Phone Number')}}</th>
                                @if( Gate::check('user delete class'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($classes->classAssignTrainee as $trainee)

                                <tr>
                                    <td>{{ traineePrefix().!empty($trainee->userDetail)?!empty($trainee->userDetail->traineeDetail)?$trainee->userDetail->traineeDetail->trainee_id:'-':'-' }} </td>
                                    <td class="table-user">
                                        <img
                                            src="{{isset($trainee->userDetail->avatar)&&!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold">{{ !empty($trainee->userDetail)?$trainee->userDetail->name:'-' }}</a>
                                    </td>
                                    <td>{{ isset($trainee->userDetail->phone_number) && !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-' }} </td>
                                    @if(Gate::check('user delete class'))
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['classes.user.remove', $trainee->id]]) !!}

                                            <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                    data-feather="trash-2"></i></a>

                                            {!! Form::close() !!}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 cdx-xxl-50">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Trainer')}}</h4>
                    @if(Gate::check('user assign class'))
                        <div class="setting-card action-menu">
                            <div class="setting-card action-menu">
                                <a class="text-primary customModal" data-bs-toggle="tooltip"
                                   data-size="lg" data-bs-original-title="{{__('Assign Trainer')}}" href="#"
                                   data-url="{{ route('classes.user.assign',[$classes->id,'trainer']) }}"
                                   data-title="{{__('Assign Trainer')}}"> <i data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Phone Number')}}</th>
                                @if( Gate::check('user delete class'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($classes->classAssignTrainer as $trainer)

                                <tr>
                                    <td>{{ trainerPrefix().$trainer->userDetail->trainerDetail->trainee_id }} </td>
                                    <td class="table-user">
                                        <img
                                            src="{{!empty($trainer->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainer->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold">{{ $trainer->userDetail->name }}</a>
                                    </td>
                                    <td>{{ !empty($trainer->userDetail->phone_number)?$trainer->userDetail->phone_number:'-' }} </td>
                                    @if( Gate::check('user delete class'))
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['classes.user.remove', $trainer->id]]) !!}
                                            <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                    data-feather="trash-2"></i></a>
                                            {!! Form::close() !!}
                                        </td>
                                    @endif
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
