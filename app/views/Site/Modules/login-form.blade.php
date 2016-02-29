<div class="col-md-6 animated fadeIn">
    <div class="card register-card">
        <form method="POST" action="{{ URL::route('Api.Login') }}" id="loginForm"
              class="col-md-10 col-centered">

            <h1 class="login-title">Prijava
                <div class="small-expanation">postojećih organizatora volontiranja</div>
            </h1>

            <div class="form-group">
                <input id="username" name="username" type="text" class="form-control"
                       placeholder="Korisničko ime"
                       required>
            </div>
            <div class="form-group">
                <input id="password" name="password" type="password" class="form-control" placeholder="Lozinka"
                       required>
            </div>
            <button class="btn btn-light-form">Prijava</button>
            <div>
                <i class="fa fa-exclamation"></i>
                <a href="{{ URL::route('User.ForgottenPassword.Get') }}" class="text-center">Zaboravio sam
                    lozinku</a>
                &nbsp;&nbsp;
            </div>
        </form>
    </div>
</div>
@section('scripts')
    @parent
    <script type="text/javascript" language="javascript" src="{{asset('assets/js/site/login-controller.js')}}"></script>

    <script>
        var ctl = LoginController;
        $(function () {
            $('#loginForm').bootstrapValidator(ctl.validator).on('success.form.bv', function (e) {
                ctl.submitHandler(e);
            });
        })
    </script>
@endsection
