@extends('layouts.app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('Trainers') }}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                <h1>{{ __('Dashboard') }}</h1>
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{ __('Trainers') }}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if (Gate::check('create trainer'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
            data-url="{{ route('trainers.create') }}" data-title="{{ __('Create Trainer') }}"> <i class="ti-plus mr-5"></i>
            {{ __('Create Trainer') }}
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
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th>{{ __('Classes') }}</th>
                                <th>{{ __('Status') }}</th>
                                @if (Gate::check('edit trainer') || Gate::check('delete trainer') || Gate::check('show trainer'))
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainers as $trainer)
                                <tr>
                                    <td>{{ trainerPrefix() . $trainer->trainerDetail->trainer_id }} </td>
                                    <td class="table-user">
                                        <img src="{{ !empty($trainer->avatar) ? asset(Storage::url('upload/profile')) . '/' . $trainer->avatar : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#" class="text-body font-weight-semibold">{{ $trainer->name }}</a>
                                    </td>
                                    <td>{{ $trainer->email }} </td>
                                    <td>{{ !empty($trainer->phone_number) ? $trainer->phone_number : '-' }} </td>
                                    <td>
                                        @foreach ($trainer->classAssign() as $class)
                                            {{ $class }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if (!empty($trainer->trainerDetail) && $trainer->trainerDetail->status == 1)
                                            <span
                                                class="badge badge-success">{{ App\Models\TrainerDetail::$status[$trainer->trainerDetail->status] }}</span>
                                        @else
                                            <span
                                                class="badge badge-danger">{{ App\Models\TrainerDetail::$status[$trainer->trainerDetail->status] }}</span>
                                        @endif

                                    </td>
                                    @if (Gate::check('edit trainer') || Gate::check('delete trainer') || Gate::check('show trainer'))
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['trainers.destroy', $trainer->id]]) !!}
                                                @can('show trainer')
                                                    <a class="text-warning " data-bs-toggle="tooltip" data-size="lg"
                                                        data-bs-original-title="{{ __('Details') }}"
                                                        href="{{ route('trainers.show', \Illuminate\Support\Facades\Crypt::encrypt($trainer->id)) }}">
                                                        <i data-feather="eye"></i></a>
                                                @endcan
                                                @can('edit trainer')
                                                    <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route('trainers.edit', $trainer->id) }}"
                                                        data-title="{{ __('Edit Trainer') }}"> <i data-feather="edit"></i></a>
                                                @endcan
                                                @can('delete trainer')
                                                    <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                            data-feather="trash-2"></i></a>
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
