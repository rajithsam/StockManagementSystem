@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.product-orders.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.product_orders.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_id', trans('quickadmin.product-orders.fields.product').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('product_id', $products, old('product_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_id'))
                        <p class="help-block">
                            {{ $errors->first('product_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('quantity', trans('quickadmin.product-orders.fields.quantity').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('quantity', old('quantity'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('quantity'))
                        <p class="help-block">
                            {{ $errors->first('quantity') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order_date', trans('quickadmin.product-orders.fields.order-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('order_date', old('order_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('order_date'))
                        <p class="help-block">
                            {{ $errors->first('order_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
    </script>

@stop