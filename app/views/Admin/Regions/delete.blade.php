@extends('Layouts.iframe')

@section('iframe-body')
<div class="container text-center">

{{-- Obriši --}}
<div class="well">
<p>
<b>Jeste li sigurni ?</b><br/>
Ova akcija se ne može poništiti !
</p>
</div>
{{ Form::model($model, array('route' => array('Admin.Regions.Destroy', $model->id))) }}
       <button type="submit" class="btn btn-primary">Obriši</button>
       <a onclick="parent.modal.modal('hide');" class="btn btn-default">Otkaži</a>
{{ Form::close() }}
</div>
@stop
