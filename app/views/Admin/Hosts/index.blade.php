@extends('Layouts.crud-index')

@section('content')
@parent
@include('Navigation.menu')

<div class="container">
    <div class="notifications"></div>
    <div class="text-right">
        <a href="{{URL::route('Admin.Excel.Hosts')}}" class="btn btn-info">
            Izvezi organizatore
        </a>
    </div>
    <hr>

    <div class="text-right">
        <button class="btn btn-success" data-toggle="iframe-modal"
                data-iframe-src="{{ URL::route('Admin.Hosts.Create') }}">
            <i class="fa fa-plus"></i> {{{ Lang::get('button.create') }}}
        </button>
    </div>
    <hr>

    <table class="datatables table">
        <thead>
        <tr>
            <th>{{{ Lang::get('Admin/table.id') }}}</th>
            <th>Name</th>
            <th>{{{ Lang::get('Admin/table.created_at') }}}</th>
            <th class="actions-column">{{{ Lang::get('table.actions') }}}</th>
        </tr>
        </thead>
    </table>
</div>

@stop

@section('scripts')
@parent
<script>
    var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/hosts/data') }}");
</script>
@stop
