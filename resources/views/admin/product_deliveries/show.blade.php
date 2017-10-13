@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.product-deliveries.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.product-deliveries.fields.beleiver')</th>
                            <td field-key='beleiver'>{{ $product_delivery->beleiver->first_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.product-deliveries.fields.product')</th>
                            <td field-key='product'>{{ $product_delivery->product->product_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.product-deliveries.fields.date')</th>
                            <td field-key='date'>{{ $product_delivery->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.product-deliveries.fields.quantity')</th>
                            <td field-key='quantity'>{{ $product_delivery->quantity }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.product_deliveries.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
