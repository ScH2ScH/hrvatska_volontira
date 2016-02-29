@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

    @if(!empty($model->id))
    {{-- UPDATE --}}
    {{ Form::model($model, array('route' => array('Admin.Cities.Update', $model->id))) }}
    @else
    {{-- NEW --}}
    {{ Form::model($model, array('route' => array('Admin.Cities.Store', $model->id))) }}
    @endif

    @include('Form.input', array(
    'label'=>'Ime grada',
    'type'=>'text',
    'placeholder'=>'Ime grada',
    'name'=>'name',
    ))

    @include('Form.input', array(
    'label'=>'Poštanski broj',
    'type'=>'text',
    'placeholder'=>'Poštanski broj',
    'name'=>'zip_code',
    ))

    @include('Form.input', array(
    'label'=>'Županija',
    'type'=>'select',
    'name'=>'county_id',
    'options' => $counties,
    'class' => 'select2',
    'selectedValue' => Input::old('county_id', isset($model) ? $model->county_id : 0)
    ))


    <hr>

    <button type="submit" class="btn btn-success">
        <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
    {{ Form::close() }}
</div>
@stop
