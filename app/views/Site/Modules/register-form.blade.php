<div class="container">

    {{App::setLocale('hr');}}

    <div class="form-notification alert alert-danger"></div>

    @include('Site.Modules.login-form')

    <div class="col-md-6">
        <div class="card register-card">
            <div class="text-center row animated fadeIn">
                <h1>Registracija
                    <div class="small-expanation">novih organizatora volontiranja</div>
                </h1>

                <form method="POST" action="{{ URL::route('Api.Register') }}" id="registerForm" class="">

                    <fieldset class="col-md-12">
                        <h3 class="page-title" style="color:#E74C3C;">Korisnički podaci</h3>

                        <div class="form-group">
                            <label class="control-label"> Korisničko ime </label>
                            <input id="username" name="username" type="text" class="form-control"
                                   placeholder="Korisničko ime"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Email </label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="email"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Lozinka </label>
                            <input id="password" name="password" type="password" class="form-control"
                                   placeholder="Lozinka"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Potvrda lozinke</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="form-control"
                                   placeholder="Potvrda loznke" required>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12">
                        <h3 class="page-title" style="color:#E74C3C;">Podaci o organizaciji</h3>

                        <div class="form-group">
                            <label class="control-label"> Naziv</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Naziv" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"> Adresa</label>

                            <div class="small-expanation">
                                Moguć unos više različitih adresa
                            </div>
                            <input id="address" name="address" type="text" class="form-control" placeholder="Adresa"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"> Kontakt osoba</label>
                            <input id="contact_person" name="contact_person" type="text" class="form-control"
                                   placeholder="Kontakt osoba" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"> Telefon</label>
                            <input id="phone" name="phone" type="text" class="form-control"
                                   placeholder="Telefon" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"> Web stranica</label>
                            <input id="web" name="web" type="text" class="form-control"
                                   placeholder="Web stranica" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label"> Tip organizacije</label>
                            <select id="organization_type_id" name="organization_type_id" type="text"
                                    class="form-control  select2  select2-offscreen" required>
                                @foreach($types as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <div class="col-centered">
                        <button class="btn btn-light-form">Registriraj se</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@section('scripts')
    @parent
    <script type="text/javascript" language="javascript"
            src="{{asset('assets/js/site/registration-controller.js')}}"></script>
    <script>
        var Registrationctl = RegistrationController;
        $(function () {
            $('#registerForm').bootstrapValidator(Registrationctl.validator).on('success.form.bv', function (e) {
                Registrationctl.submitHandler(e);
            });
        })
    </script>
@endsection
