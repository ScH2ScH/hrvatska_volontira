@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif
    <div class="container">
        <!-- Tab panes -->
        <div class="row">
            <div class="col-md-12">

                {{ Form:: open(array('action' => 'AdminMailController@postUpdate')) }}

                <h1>Email notifikacija svim organizatorima</h1>

                <div class="notifications"></div>

                <div class="col-md-12">
                    {{ Form::label('title', 'Naslov email poruke') }}
                    {{ Form::text('title', 'Hrvatska volontira :: Novosti', array('class' => 'form-control')) }}
                </div>

                <div class="col-md-12">
                    {{ Form::label('body', 'Text email poruke') }}
                    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> {{{ Lang::get('button.submit') }}}
                </button>
            </div>
            {{ Form:: close() }}
        </div>
    </div>
    <hr>
@stop