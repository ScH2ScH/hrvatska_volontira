@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Kontakt"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>

@endsection
@extends('Layouts.site')

@section('content')
    <div class="material-body">
        <div class="container animated fadeIn">
            <div class="row">
                <h1><a href="http://www.volontiram.info" target="new">HRVATSKA MREŽA VOLONTERSKIH CENTARA</a>
                    <small>*</small>
                </h1>
                <div class="contact-text">
                    * za sva pitanja molimo Vas da se obratite najbližem regionalnom centru
                </div>

                <div class="col-md-6">
                    <div class="card event-card">
                        <h3>Volonterski centar Zagreb</h3>

                        <p><i class="fa fa-map-marker"></i>&nbsp;Ilica 29, 10 000 Zagreb</p>

                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:zvs_info@vcz.hr">&nbsp;zvs_info@vcz.hr</a>
                        </p>

                        <p><i class="fa fa-phone"></i> <a href="tel:+385098373615">&nbsp;098 / 373 615</a></p>

                        <p><i class="fa fa-desktop"></i> <a href="http://www.vcz.hr" target="new">&nbsp;www.vcz.hr </a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card event-card">
                        <h3>Volonterski centar Osijek</h3>

                        <p><i class="fa fa-map-marker"></i> Lorenza Jagera 12, 31 000 Osijek</p>

                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:info@vcos.hr">info@vcos.hr</a></p>

                        <p><i class="fa fa-phone"></i> <a href="tel:+385031211306">031/211-306</a></p>

                        <p><i class="fa fa-desktop"></i> <a href="http://www.vcos.hr" target="new">&nbsp;www.vcos.hr </a></p>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card event-card">
                        <h3>Volonterski centar Rijeka, Udruga SMART</h3>

                        <p><i class="fa fa-map-marker"></i> Blaža Polića 2/IV, 51 000 Rijeka</p>

                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:marta@smart.hr">marta@smart.hr</a></p>

                        <p><i class="fa fa-phone"></i> <a href="tel:+385051586551">051/586-551</a></p>
                        <p><i class="fa fa-desktop"></i> <a href="http://www.volonterski-centar-ri.org" target="new">&nbsp;www.volonterski-centar-ri.org  </a></p>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card event-card">
                        <h3>Volonterski centar Split, Udruga Mi</h3>

                        <p><i class="fa fa-map-marker"></i> Sinjska 7, 21 000 Split</p>


                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:kontakt@vcst.info ">kontakt@vcst.info </a>
                        </p>

                        <p><i class="fa fa-phone"></i> <a href="tel:+385021329139">021/329-139</a></p>
                        <p><i class="fa fa-desktop"></i> <a href="http://www.vcst.info" target="new">&nbsp; www.vcst.info  </a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
