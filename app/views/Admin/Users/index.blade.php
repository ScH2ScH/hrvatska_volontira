@extends('Layouts.crud-index')

@section('content')
    @parent
    @include('Navigation.menu')


    <div class="container">
        <div class="notifications"></div>

        <div class="text-right">
            <a href="{{URL::route('Admin.Excel.Users')}}" class="btn btn-info">
                Izvezi korisnike
            </a>
        </div>
        <hr>

        <div class="text-right">
            <button class="btn btn-success" data-toggle="iframe-modal"
                    data-iframe-src="{{ URL::route('Admin.Users.Create') }}">
                <i class="fa fa-plus"></i> {{{ Lang::get('button.create') }}}
            </button>
        </div>
        <hr>
        <table class="datatables table">
            <thead>
            <tr>
                <th>{{{ Lang::get('Admin/Users/table.username') }}}</th>
                <th>{{{ Lang::get('Admin/Users/table.email') }}}</th>
                <th>{{{ Lang::get('Admin/Users/table.roles') }}}</th>
                <th>{{{ Lang::get('Admin/Users/table.activated') }}}</th>
                <th>{{{ Lang::get('Admin/Users/table.created_at') }}}</th>
                <th class="actions-column">{{{ Lang::get('table.actions') }}}</th>
            </tr>
            </thead>
        </table>
    </div>

@stop

@section('scripts')
    @parent
    <script>
        var oTable = initDatatables($('.datatables'), "{{ URL::to('admin/users/data') }}");
    </script>
@stop
