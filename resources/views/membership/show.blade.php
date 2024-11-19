@extends('layouts.app')
@section('page-title')
    {{$membership->title}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('membership.index')}}">{{__('Membership')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{$membership->title}} {{__('Details')}}
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
                    <h4> {{$membership->title}}</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Title')}}</h6>
                                <p class="mb-20">{{$membership->title}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Package')}}</h6>
                                <p class="mb-20">{{$membership->package }} </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Amount')}}</h6>
                                <p class="mb-20"> Rs {{ ($membership->amount) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Number of Session')}}</h6>
                                <p class="mb-20">
                                {{ ($membership->no_session) }} 
                                   
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('User Created At')}}</h6>
                                <p class="mb-20"> {{ $membership->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
