@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.believers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.believers.fields.first-name')</th>
                            <td field-key='first_name'>{{ $believer->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.believers.fields.last-name')</th>
                            <td field-key='last_name'>{{ $believer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.believers.fields.address')</th>
                            <td field-key='address'>{!! $believer->address !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.believers.fields.phone-number')</th>
                            <td field-key='phone_number'>{{ $believer->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.believers.fields.email')</th>
                            <td field-key='email'>{{ $believer->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.believers.fields.date-of-birth')</th>
                            <td field-key='date_of_birth'>{{ $believer->date_of_birth }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#productdeliveries" aria-controls="productdeliveries" role="tab" data-toggle="tab">Product Deliveries</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="productdeliveries">
<table class="table table-bordered table-striped {{ count($product_deliveries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.product-deliveries.fields.beleiver')</th>
                        <th>@lang('quickadmin.product-deliveries.fields.product')</th>
                        <th>@lang('quickadmin.product-deliveries.fields.date')</th>
                        <th>@lang('quickadmin.product-deliveries.fields.quantity')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($product_deliveries) > 0)
            @foreach ($product_deliveries as $product_delivery)
                <tr data-entry-id="{{ $product_delivery->id }}">
                    <td field-key='beleiver'>{{ $product_delivery->beleiver->first_name or '' }}</td>
                                <td field-key='product'>{{ $product_delivery->product->product_name or '' }}</td>
                                <td field-key='date'>{{ $product_delivery->date }}</td>
                                <td field-key='quantity'>{{ $product_delivery->quantity }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('product_delivery_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_deliveries.restore', $product_delivery->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('product_delivery_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_deliveries.perma_del', $product_delivery->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('product_delivery_view')
                                    <a href="{{ route('admin.product_deliveries.show',[$product_delivery->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('product_delivery_edit')
                                    <a href="{{ route('admin.product_deliveries.edit',[$product_delivery->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('product_delivery_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_deliveries.destroy', $product_delivery->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.believers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
