@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

    @if(!empty($model->id))
    {{-- UPDATE --}}
    {{ Form::model($model, array('route' => array('Admin.Counties.Update', $model->id))) }}
    @else
    {{-- NEW --}}
    {{ Form::model($model, array('route' => array('Admin.Counties.Store', $model->id))) }}
    @endif

    @include('Form.input', array(
    'label'=>'Naziv županije',
    'type'=>'text',
    'placeholder'=>'Naziv županije',
    'name'=>'name',
    ))

    @include('Form.input', array(
    'label'=>'Region',
    'type'=>'select',
    'name'=>'region_id',
    'options' => $regions,
    'class' => 'select2',
    'selectedValue' => Input::old('region_id', isset($model) ? $model->region_id : 0)
    ))

    <hr>

    <button type="submit" class="btn btn-success">
        <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
    {{ Form::close() }}
</div>
@stop
