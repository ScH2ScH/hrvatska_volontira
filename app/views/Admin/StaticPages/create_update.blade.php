@extends('Layouts.iframe')

@section('iframe-body')
<div class="container ">

@if(!empty($model->id))
{{-- UPDATE --}}
{{ Form::model($model, array('route' => array('Admin.StaticPages.Update', $model->id))) }}
@else
{{-- NEW --}}
{{ Form::model($model, array('route' => array('Admin.StaticPages.Store', $model->id))) }}
@endif

    @include('Form.input', array(
        'label'=>'Naslov članka',
        'type'=>'text',
        'placeholder'=>'Naslov članka',
        'name'=>'title',
    ))

    @include('Form.input', array(
            'label'=>'Putanja',
            'type'=>'text',
            'placeholder'=>'link putanje do članka (sve skupa malim slovima)',
            'name'=>'slug',
        ))

    @include('Form.input', array(
        'label' => 'Članak',
        'type' => 'textarea',
        'class' => 'full-width wysihtml5',
        'rows' => 6,
        'placeholder' => 'Body',
        'name' => 'body',
    ))

    @include('Form.input', array(
        'label' => 'Sažetak članka',
        'type' => 'textarea',
        'class' => 'full-width wysihtml5',
        'rows' => 6,
        'placeholder' => 'Sažetak',
        'name' => 'menu_caption',
    ))

    @include('Form.input', array(
            'label'=>'Aktivan',
            'type'=>'select',
            'name'=>'active',
            'options' => array("Ne", "Da"),
            'selectedValue' => Input::old('active', isset($model) ? $model->active : 0)
        ))

    <hr>

    <button type="submit" class="btn btn-success">
    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
    </button>

    <input type="hidden" name="iframe" value="1"/>
{{ Form::close() }}
</div>

<script src="//cdn.ckeditor.com/4.4.5/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body' );
</script>
@stop
