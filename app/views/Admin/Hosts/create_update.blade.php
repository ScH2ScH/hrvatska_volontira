@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

    @if(!empty($model->id))
    {{-- UPDATE --}}
    {{ Form::model($model, array('route' => array('Admin.Hosts.Update', $model->id))) }}
    @else
    {{-- NEW --}}
    {{ Form::model($model, array('route' => array('Admin.Hosts.Store', $model->id))) }}
    @endif

    @include('Form.input', array(
    'label'=>'Naziv organizatora',
    'type'=>'text',
    'placeholder'=>'Naziv organizatora',
    'name'=>'name',
    ))

    @include('Form.input', array(
    'label'=>'Adresa',
    'type'=>'text',
    'placeholder'=>'Adresa',
    'name'=>'address',
    ))

    @include('Form.input', array(
    'label'=>'Kontakt osoba',
    'type'=>'text',
    'placeholder'=>'Kontakt osoba',
    'name'=>'contact_person',
    ))

    @include('Form.input', array(
    'label'=>'Telefon',
    'type'=>'text',
    'placeholder'=>'Telefon',
    'name'=>'phone',
    ))

    @include('Form.input', array(
    'label'=>'Web',
    'type'=>'text',
    'placeholder'=>'Web',
    'name'=>'web',
    ))

    @include('Form.input', array(
    'label'=>'Email',
    'type'=>'text',
    'placeholder'=>'email',
    'name'=>'host_email',
    ))

    @include('Form.input', array(
    'label'=>'Vrsta organizacije',
    'type'=>'select',
    'name'=>'organization_type_id',
    'options' => $types,
    'selectedValue' => Input::old('organization_type_id', isset($model) ? $model->organization_type_id : null),
    'class' => 'select2',
    ))

    @include('Form.input', array(
    'label' => 'Dodatna napomena',
    'type' => 'textarea',
    'class' => 'full-width',
    'rows' => 6,
    'placeholder' => 'Napomena',
    'name' => 'additional_note',
    ))

    @include('Form.input', array(
    'label'=>'Korisnik koji pripada organizaciji',
    'type'=>'select',
    'name'=>'user_id',
    'options' => $users,
    'selectedValue' => Input::old('user_id', isset($model) ? $model->user_id : null),
    'class' => 'select2',
    ))

    <hr>

    <button type="submit" class="btn btn-success">
        <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
    {{ Form::close() }}
</div>
@stop
