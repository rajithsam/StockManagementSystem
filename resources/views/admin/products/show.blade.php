@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.products.fields.product-name')</th>
                            <td field-key='product_name'>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.product-category')</th>
                            <td field-key='product_category'>{{ $product->product_category->category or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.product-description')</th>
                            <td field-key='product_description'>{!! $product->product_description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.in-stock')</th>
                            <td field-key='in_stock'>{{ $product->in_stock }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#productorders" aria-controls="productorders" role="tab" data-toggle="tab">Product Orders</a></li>
<li role="presentation" class=""><a href="#productdeliveries" aria-controls="productdeliveries" role="tab" data-toggle="tab">Product Deliveries</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="productorders">
<table class="table table-bordered table-striped {{ count($product_orders) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.product-orders.fields.product')</th>
                        <th>@lang('quickadmin.product-orders.fields.quantity')</th>
                        <th>@lang('quickadmin.product-orders.fields.order-date')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($product_orders) > 0)
            @foreach ($product_orders as $product_order)
                <tr data-entry-id="{{ $product_order->id }}">
                    <td field-key='product'>{{ $product_order->product->product_name or '' }}</td>
                                <td field-key='quantity'>{{ $product_order->quantity }}</td>
                                <td field-key='order_date'>{{ $product_order->order_date }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('product_order_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_orders.restore', $product_order->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('product_order_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_orders.perma_del', $product_order->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('product_order_view')
                                    <a href="{{ route('admin.product_orders.show',[$product_order->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('product_order_edit')
                                    <a href="{{ route('admin.product_orders.edit',[$product_order->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('product_order_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product_orders.destroy', $product_order->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="productdeliveries">
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

            <a href="{{ route('admin.products.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
