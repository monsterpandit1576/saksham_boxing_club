@extends('layouts.app')

@section('page-title')
    {{__('Membership')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Membership')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create membership'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('membership.create') }}"
           data-title="{{__('Create Membership')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Membership')}}
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
                            <th>{{__('Package')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('No. of Sessions')}}</th>
                            @if(Gate::check('edit membership') ||  Gate::check('delete membership')||  Gate::check('show membership'))
                                <th>{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($memberships as $membership)

                            <tr>
                                <td>{{ $membership->title }} </td>
                                <td>
                                    {{\App\Models\Membership::$package[$membership->package]}}
                                </td>
                                <td>{{ priceFormat($membership->amount) }} </td>

                                <td>
                                {{ ($membership->no_session) }} 
                                    <!-- @if(!empty($membership->classes_id))
                                        @foreach($membership->claases() as $class )
                                            {{ $class->title }}<br>
                                        @endforeach
                                    @else
                                        -
                                    @endif -->
                                </td>

                                @if(Gate::check('edit membership') ||  Gate::check('delete membership')||  Gate::check('show membership'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['membership.destroy', $membership->id]]) !!}
                                            @can('show membership')
                                                <a class="text-warning " data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="{{__('Details')}}"
                                                   href="{{ route('membership.show',\Illuminate\Support\Facades\Crypt::encrypt($membership->id)) }}"
                                                > <i class="fa fa-eye"></i>
                                            @endcan
                                            @can('edit membership')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('membership.edit',$membership->id) }}"
                                                   data-title="{{__('Edit Membership')}}"><i class="fa fa-edit"></i>
                                            @endcan
                                            @can('delete membership')
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
