@extends('layouts.app')
@section('page-title')
    {{__('Invoice')}}
@endsection
@php
    $admin_logo=getSettingsValByName('company_logo');
    $settings=settings();
@endphp
@push('script-page')
    <script>
        $(document).on('click', '.print', function () {
            var printContents = document.getElementById('invoice-print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        });
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
            <a href="#">{{__('Details')}}</a>
        </li>
    </ul>
@endsection
@section('content')

    <div class="row mb-10">
        <div class="invoice-action ">
            <a class="btn btn-info float-end print" href="javascript:void(0);"> {{__('Print Invoice')}}</a>
            @can('create invoice payment')
                <a class="btn btn-primary float-end me-2 customModal" href="#" data-size="md"
                   data-url="{{ route('invoice.payment.create',$invoice->id) }}"
                   data-title="{{__('Add Payment')}}"> {{__('Add Payment')}}</a>
            @endcan
        </div>
    </div>

    <div id="invoice-print">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body cdx-invoice">
                        <div id="cdx-invoice">
                            <div class="head-invoice">
                                <div class="codex-brand">
                                    <a class="codexbrand-logo" href="Javascript:void(0);">
                                        <img class="img-fluid invoice-logo"
                                             src=" {{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                                             alt="invoice-logo">
                                    </a>
                                    <a class="codexdark-logo" href="Javascript:void(0);">
                                        <img class="img-fluid invoice-logo"
                                             src=" {{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                                             alt="invoice-logo">
                                    </a>
                                </div>
                                <ul class="contact-list">

                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-user"></i>
                                        </div>{{$settings['company_name']}}
                                    </li>
                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-phone"></i>
                                        </div>{{$settings['company_phone']}}
                                    </li>
                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-envelope"></i>
                                        </div>{{$settings['company_email']}}
                                    </li>

                                </ul>
                            </div>
                            <div class="invoice-user">
                                <div class="left-user">
                                    <h5>{{__('Inovice to')}}:</h5>
                                    <ul class="detail-list">
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-user"></i>
                                            </div>{{!empty($invoice->users)?$invoice->users->name:''}}
                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-phone"></i>
                                            </div>{{!empty($invoice->users)?$invoice->users->phone_number:''}}
                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                            {{!empty($invoice->users) && !empty($invoice->users->traineeDetail)?$invoice->users->traineeDetail->address:''}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="right-user">
                                    <ul class="detail-list">
                                        <li>{{__('Status')}}:
                                            @if($invoice->status=='unpaid')
                                                <span class="badge badge-danger">{{\App\Models\Invoice::$status[$invoice->status]}}</span>
                                            @elseif($invoice->status=='paid')
                                                <span class="badge badge-success">{{\App\Models\Invoice::$status[$invoice->status]}}</span>
                                            @elseif($invoice->status=='partial_paid')
                                                <span class="badge badge-warning">{{\App\Models\Invoice::$status[$invoice->status]}}</span>
                                            @endif
                                        </li>
                                        <li>{{__('Invoice No')}}:
                                            <span>{{invoicePrefix().$invoice->invoice_id}} </span>
                                        </li>
                                        <li>{{__('Invoice Date')}}:
                                            <span> {{dateFormat($invoice->invoice_date)}} </span></li>
                                        <li>{{__('Invoice Due Date')}}:
                                            <span>{{dateFormat($invoice->invoice_due_date)}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="body-invoice">
                                <div class="table-responsive1">
                                    <table class="table ml-1">
                                        <thead>
                                        <tr>
                                            <th>{{__('Type')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Description')}}</th>
                                            <th>{{__('Amount')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoice->types as $k=>$type)
                                            <tr>
                                                <td>{{!empty($type->types)?$type->types->title:'-'}}</td>
                                                <td>{{$type->title}}</td>
                                                <td>{{$type->description}}</td>
                                                <td>{{priceFormat($type->amount)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="footer-invoice">
                                <table class="table">
                                    <tr>
                                        <td>{{__('Total')}}</td>
                                        <td>{{priceFormat($invoice->getInvoiceSubTotalAmount())}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Due Amount')}}</td>
                                        <td>{{priceFormat($invoice->getInvoiceTotalDueAmount())}} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{__('Payment History')}}</h5>
                    </div>
                    <div class="card-body">
                        <table class="display dataTable cell-border datatbl-advance1">
                            <thead>
                            <tr>
                                <th>{{__('Transaction Id')}}</th>
                                <th>{{__('Payment Date')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Notes')}}</th>
                                <th>{{__('Receipt')}}</th>
                                @can('delete invoice payment')
                                    <th class="text-right">{{__('Action')}}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->payments as $payment)
                                <tr role="row">
                                    <td>{{$payment->transaction_id}} </td>
                                    <td>{{dateFormat($payment->payment_date)}} </td>
                                    <td>{{priceFormat($payment->amount)}} </td>
                                    <td>{{$payment->notes}} </td>
                                    <td>
                                        @if(!empty($payment->receipt))
                                            <a href="{{asset(Storage::url('upload/receipt')).'/'.$payment->receipt}}"
                                               download="download"><i data-feather="download"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @can('delete invoice payment')
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['invoice.payment.destroy', $invoice->id,$payment->id]]) !!}
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                            data-feather="trash-2"></i></a>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    @endcan
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

