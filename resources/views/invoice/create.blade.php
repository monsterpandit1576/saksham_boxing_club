@extends('layouts.app')
@section('page-title')
    {{__('Invoice')}}
@endsection
@push('script-page')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>

    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function() {
                    $('.hidesearch').select2({
                        minimumResultsForSearch: -1
                    });
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();
                    }
                },
                ready: function(setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }
        }
    </script>
@endpush
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('invoices.index')}}">{{__('Invoice')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Create')}}</a>
        </li>
    </ul>
@endsection

@section('content')
    {{Form::open(array('url'=>'invoices','method'=>'post',"id"=>"invoice_form"))}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-4">
                                {{Form::label('user_id',__('Trainee'),array('class'=>'form-label'))}}
                                {{Form::select('user_id',$trainee,null,array('class'=>'form-control hidesearch'))}}
                            </div>

                            <div class="form-group col-md-6 col-lg-4">
                                <div class="form-group">
                                    {{Form::label('invoice_id',__('Invoice Number'),array('class'=>'form-label'))}}
                                    <div class="input-group">
                                        <span class="input-group-text ">
                                          {{invoicePrefix()}}
                                        </span>
                                        {{Form::text('invoice_id',$invoiceNumber,array('class'=>'form-control','placeholder'=>__('Enter Invoice Number')))}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                {{Form::label('invoice_date',__('Invoice Date'),array('class'=>'form-label'))}}
                                {{Form::date('invoice_date',null,array('class'=>'form-control'))}}
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                {{Form::label('invoice_due_date',__('Invoice Due Date'),array('class'=>'form-label'))}}
                                {{Form::date('invoice_due_date',null,array('class'=>'form-control'))}}
                            </div>
                            <div class="form-group col-md-8 col-lg-8">
                                {{Form::label('notes',__('Notes'),array('class'=>'form-label'))}}
                                {{Form::textarea('notes',null,array('class'=>'form-control','rows'=>1,'placeholder'=>__('Enter Notes')))}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card repeater">
                <div class="card-header">
                    <h5>{{__('Types')}}</h5>
                    <a class="btn btn-primary btn-sm ml-20" href="#" data-repeater-create=""> <i class="ti-plus mr-5"></i>{{__('Add Type')}}</a>
                </div>
                <div class="card-body">
                    <table class="display dataTable cell-border" data-repeater-list="types">
                        <thead>
                        <tr>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody data-repeater-item>
                            <tr>
                                <td width="30%">
                                    {{Form::select('type_id',$types,null,array('class'=>'form-control hidesearch'))}}
                                </td>
                                <td>
                                    {{Form::text('title',null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    {{Form::number('amount',null,array('class'=>'form-control'))}}
                                </td>
                                <td>
                                    {{Form::textarea('description',null,array('class'=>'form-control','rows'=>1))}}
                                </td>
                                <td>
                                    <a class="text-danger" data-repeater-delete data-bs-toggle="tooltip" data-bs-original-title="{{__('Detete')}}" href="#"> <i data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="group-button text-end">
                {{Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded','id'=>'invoice-submit'))}}
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

