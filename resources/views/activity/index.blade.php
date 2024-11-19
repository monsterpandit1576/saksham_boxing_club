@extends('layouts.app')
@section('page-title')
    {{__('Workout Activity')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Workout Activity')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create workout activity'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="{{ route('activity.create') }}"
           data-title="{{__('Create Activity')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Activity')}}
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
                            <th>{{__('Title')}}</th>
                            <th>{{__('Created At')}}</th>
                            @if(Gate::check('edit workout activity') ||  Gate::check('delete workout activity'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->title }} </td>
                                <td>{{ dateFormat($activity->created_at) }} </td>
                                @if(Gate::check('edit workout activity') ||  Gate::check('delete workout activity'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['activity.destroy', $activity->id]]) !!}
                                            @can('edit workout activity')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="md"
                                                   data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('activity.edit',$activity->id) }}"
                                                   data-title="{{__('Edit Activity')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete workout activity')
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
