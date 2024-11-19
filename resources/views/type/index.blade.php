@extends('layouts.app')
@section('page-title')
    {{__('Type')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Type')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create finance type'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="{{ route('types.create') }}"
           data-title="{{__('Create Type')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Type')}}
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
                            <th>{{__('Type')}}</th>
                            <th>{{__('Created At')}}</th>
                            @if(Gate::check('edit finance type') ||  Gate::check('delete finance type'))
                                <th>{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->title }} </td>
                                <td>{{ \App\Models\Type::$types[$type->type] }} </td>
                                <td>{{ dateFormat($type->created_at) }} </td>
                                @if(Gate::check('edit finance type') ||  Gate::check('delete finance type'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['types.destroy', $type->id]]) !!}
                                            @can('edit finance type')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="md"
                                                   data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('types.edit',$type->id) }}"
                                                   data-title="{{__('Edit Type')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete finance type')
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
