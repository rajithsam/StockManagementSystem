@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.product-orders.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.product-orders.fields.product')</th>
                            <td field-key='product'>{{ $product_order->product->product_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.product-orders.fields.quantity')</th>
                            <td field-key='quantity'>{{ $product_order->quantity }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.product-orders.fields.order-date')</th>
                            <td field-key='order_date'>{{ $product_order->order_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.product_orders.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
