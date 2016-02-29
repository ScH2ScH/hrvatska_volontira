@extends('Layouts.site')

@section('content')

    <div class="material-body">
        <div class="container">
            <div class="col-md-8 col-centered">
                <div class="card">
                    <h1>Reset lozinke</h1>

                    <form method="POST" action="{{ URL::route('User.ForgottenPassword.Post') }}" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                        <div class="form-group">
                            <label for="email">{{{ Lang::get('confide.e_mail') }}}</label>

                            <div class="input-append input-group">
                                <input class="form-control" placeholder="{{{ Lang::get('confide.e_mail') }}}" type="text" name="email" id="email"
                                       value="{{{ Input::old('email') }}}">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="{{{ Lang::get('confide.forgot.submit') }}}">
                </span>
                            </div>
                        </div>

                        @if (Session::get('error'))
                            <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                        @endif

                        @if (Session::get('notice'))
                            <div class="alert">{{{ Session::get('notice') }}}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection