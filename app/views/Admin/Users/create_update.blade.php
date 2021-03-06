@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

@if(!empty($model->id))
{{-- UPDATE --}}
{{ Form::model($model, array('route' => array('Admin.Users.Update', $model->id))) }}
@else
{{-- NEW --}}
{{ Form::model($model, array('route' => array('Admin.Users.Store', $model->id))) }}
@endif

    @include('Form.input', array(
        'label'=>'Korisničko ime',
        'type'=>'text',
        'placeholder'=>'Korisničko ime',
        'name'=>'username',
    ))

    @include('Form.input', array(
        'label'=>'Lozinka',
        'type'=>'password',
        'placeholder'=>'Password',
        'name'=>'password',
        'skipOldInputs' => true,
    ))

    @include('Form.input', array(
        'label'=>'Potvrda Lozinke',
        'type'=>'password',
        'placeholder'=>'Potvrda lozinke',
        'name'=>'password_confirmation',
        'skipOldInputs' => true,
    ))

    @include('Form.input', array(
        'label'=>'Email',
        'type'=>'email',
        'placeholder'=>'Email',
        'name'=>'email',
    ))

    @include('Form.input', array(
        'label'=>'Uloga',
        'type'=>'select',
        'name'=>'roles[]',
        'options' => $roles,
        'selectedValue' => Input::old('roles', isset($model) ? $model->getRelatedIDs('roles') : null),
        'class' => 'select2',
        'multiple' => 'multiple',
    ))

    @include('Form.input', array(
        'label'=>'Potvrđen',
        'type'=>'select',
        'name'=>'confirmed',
        'options' => array("Ne", "Da"),
        'selectedValue' => Input::old('confirmed', isset($model) ? $model->confirmed : 0)
    ))

    <hr>

    <button type="submit" class="btn btn-success">
    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}
</div>
@stop
