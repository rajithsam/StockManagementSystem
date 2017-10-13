@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.product-deliveries.title')</h3>
    @can('product_delivery_create')
    <p>
        <a href="{{ route('admin.product_deliveries.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('product_delivery_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.product_deliveries.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.product_deliveries.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan

    @if (session('status'))
    <div id="message" class="alert alert-danger">
        {{ session('status') }}
    </div>
    @endif 

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($product_deliveries) > 0 ? 'datatable' : '' }} @can('product_delivery_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('product_delivery_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('product_delivery_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('product_delivery_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.product_deliveries.mass_destroy') }}'; @endif
        @endcan

         $(document).ready(function()
         {
            setTimeout(function() 
            {
                $('#message').fadeOut('slow');
            }, 3000); // <-- time in milliseconds
        });

    </script>
@endsection