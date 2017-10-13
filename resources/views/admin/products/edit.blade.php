@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>
    
    {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.products.update', $product->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_name', trans('quickadmin.products.fields.product-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('product_name', old('product_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_name'))
                        <p class="help-block">
                            {{ $errors->first('product_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_category_id', trans('quickadmin.products.fields.product-category').'', ['class' => 'control-label']) !!}
                    {!! Form::select('product_category_id', $product_categories, old('product_category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_category_id'))
                        <p class="help-block">
                            {{ $errors->first('product_category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_description', trans('quickadmin.products.fields.product-description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('product_description', old('product_description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_description'))
                        <p class="help-block">
                            {{ $errors->first('product_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('in_stock', trans('quickadmin.products.fields.in-stock').'', ['class' => 'control-label']) !!}
                    {!! Form::number('in_stock', old('in_stock'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('in_stock'))
                        <p class="help-block">
                            {{ $errors->first('in_stock') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

