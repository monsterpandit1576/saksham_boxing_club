@extends('layouts.app')
@php
    $profile=asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{__('Trainees')}}

@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Trainees')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create trainee'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('trainees.create') }}"
           data-title="{{__('Create Trainee')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Trainee')}}
        </a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone Number')}}</th>
                            <th>{{__('Plan')}}</th>
                            <th>{{__('Membership')}}</th>
                            <th>{{__('Expiry Date')}}</th>
                            <th>{{ __('Status') }}</th>
                            @if(Gate::check('edit trainee') ||  Gate::check('delete trainee') ||  Gate::check('show trainee'))
                                <th>{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                            <!-- dd($trainees); -->
                        @foreach ($trainees as $trainee)

                            <tr>
                            <td>{{ traineePrefix().$trainee->id }} </td>
        <td class="table-user">
            <img
                src="{{ !empty($trainee->profile_picture) ? asset(Storage::url('upload/profile')).'/'.$trainee->profile_picture : asset(Storage::url('upload/profile')).'/avatar.png' }}"
                alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
            <a href="#" class="text-body font-weight-semibold">{{ $trainee->name }}</a>
        </td>
        <td>{{ $trainee->email }} </td>
        <td>{{ !empty($trainee->phone_number) ? $trainee->phone_number : '-' }} </td>

        <!-- Handle the Category Field -->
        <td>{{ !empty($trainee->categorys) ? $trainee->categorys->title : '-' }} </td>

        <!-- Handle the Membership Field -->
        <td>{{ !empty($trainee->membership) ? $trainee->membership->title : '-' }} </td>

        <!-- Handle the Membership Expiry Date -->
        <td>{{ !empty($trainee->membership_expiry_date) ? dateFormat($trainee->membership_expiry_date) : __('Lifetime') }}</td>

        <!-- Status Field -->
        <td>
            @if (!empty($trainee->status) && $trainee->status == 1)
                <span class="badge badge-success">{{ App\Models\TraineeDetail::$status[$trainee->status] }}</span>
            @else
                <span class="badge badge-danger">{{ App\Models\TraineeDetail::$status[$trainee->status] }}</span>
            @endif
        </td>
                                @if(Gate::check('edit trainee') ||  Gate::check('delete trainee') ||  Gate::check('show trainee'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['trainees.destroy', $trainee->id]]) !!}
                                            @can('show trainee')
                                                <a class="text-warning " data*-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="{{__('Details')}}"
                                                   href="{{ route('trainees.show',\Illuminate\Support\Facades\Crypt::encrypt($trainee->id)) }}"
                                                > <i class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('edit trainee')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="lg"
                                                   data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('trainees.edit',$trainee->id) }}"
                                                   data-title="{{__('Edit Trainee')}}"> <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete trainee')
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Detete')}}" href="#"> <i class="fa fa-trash-o"></i></a>
                                            @endcan
                                            {!! Form::close() !!}
                                        </div>

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
@endsection
