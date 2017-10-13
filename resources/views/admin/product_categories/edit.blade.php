@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.product-categories.title')</h3>
    
    {!! Form::model($product_category, ['method' => 'PUT', 'route' => ['admin.product_categories.update', $product_category->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category', trans('quickadmin.product-categories.fields.category').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('category', old('category'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category'))
                        <p class="help-block">
                            {{ $errors->first('category') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

