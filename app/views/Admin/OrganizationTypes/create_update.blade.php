@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

@if(!empty($model->id))
{{-- UPDATE --}}
{{ Form::model($model, array('route' => array('Admin.OrganizationTypes.Update', $model->id))) }}
@else
{{-- NEW --}}
{{ Form::model($model, array('route' => array('Admin.OrganizationTypes.Store', $model->id))) }}
@endif

    @include('Form.input', array(
        'label'=>'Naziv vrste organizacije',
        'type'=>'text',
        'placeholder'=>'Naziv',
        'name'=>'name',
    ))

    <hr>

    <button type="submit" class="btn btn-success">
    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}
</div>
@stop
