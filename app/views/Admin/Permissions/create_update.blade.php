@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

@if(!empty($model->id))
{{-- UPDATE --}}
{{ Form::model($model, array('route' => array('Admin.Permissions.Update', $model->id))) }}
@else
{{-- NEW --}}
{{ Form::model($model, array('route' => array('Admin.Permissions.Store', $model->id))) }}
@endif

    @include('Form.input', array(
        'label'=>'Name',
        'type'=>'text',
        'placeholder'=>'Name',
        'name'=>'name',
    ))

    @include('Form.input', array(
        'label' => 'Display name',
        'type' => 'text',
        'placeholder' => 'Display name',
        'name' => 'display_name',
    ))

    <hr>

    <button type="submit" class="btn btn-success">
    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}
</div>
@stop
