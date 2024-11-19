@extends('layouts.app')

@section('page-title')
    {{__('Health Update')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Health Update')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create health update'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="{{ route('health-update.create') }}"
           data-title="{{__('Create Health Update')}}"> <i
                    class="ti-plus mr-5"></i>
            {{__('Create Health Update')}}
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
                            <th>{{__('Trainee')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Notes')}}</th>
                            @if(Gate::check('edit health update') ||  Gate::check('delete health update')||  Gate::check('show health update'))
                                <th>{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($healthUpdates as $health)
                            <tr>
                                <td>{{ !empty($health->users)?$health->users->name:'-' }} </td>
                                <td>{{ dateFormat($health->measurement_date) }} </td>
                                <td>{{ $health->notes }} </td>
                                @if(Gate::check('edit health update') ||  Gate::check('delete health update')||  Gate::check('show health update'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['health-update.destroy', $health->id]]) !!}
                                            @can('show health update')
                                                <a class="text-warning customModal" data-bs-toggle="tooltip"
                                                   data-size="md" data-bs-original-title="{{__('Details')}}"
                                                   data-title="{{__('Details')}}"
                                                   data-url="{{ route('health-update.show',$health->id) }}"
                                                   href="#"
                                                > <i data-feather="eye"></i></a>
                                            @endcan
                                            @can('edit health update')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="md" data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('health-update.edit',$health->id) }}"
                                                   data-title="{{__('Edit Health Update')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete health update')
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Detete')}}" href="#"> <i
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
