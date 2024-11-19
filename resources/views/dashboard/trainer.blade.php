@extends('layouts.app')
@section('page-title')
    {{__('Dashboard')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Trainee')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$result['totalTrainee']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Class')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$result['totalClass']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Today Note')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span >{{$result['totalNote']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Contact')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span >{{$result['totalContact']}}</span>
                    </h2>
                </div>
            </div>
        </div>

    </div>

@endsection


