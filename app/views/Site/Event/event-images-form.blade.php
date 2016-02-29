@extends('Layouts.minimal-site')

@section('content')
    @if ($callback = Session::get('callback'))
        {{ $callback }}
    @else
        {{ Form::open(array('url'=> URL::route('Site.MyEvent.Images', array('id' => $model->id)),'files'=>true)) }}

        <div class="form-group">
            {{ Form::label('files[]','Upload fotografije aktivnosti') }}
            {{ Form::file('files[]', array('class'=>'', 'required', 'multiple')) }}
            <p class="help-block">Odaberite fotografiju</p>
        </div>


        {{ Form::submit('Sačuvaj', array('class'=>'btn btn-light-small')) }}

        <!-- reset buttons -->
        {{ Form::reset('Resetiraj',array('class'=>'btn btn-light-small')) }}

        {{ Form::close() }}
    @endif
@endsection