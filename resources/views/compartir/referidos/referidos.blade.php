@extends ('compartir.referidos.header')
<?php
      $codigo_referido=$codigo;
      $nombre_referido=$nombre;
 ?>
@section ('content')
<section class="row justify-content-center  no-gutters">
<div class="col-12 col-lg-7 col-xl-3 no-gutters"><!-- clase no-gutter-->

     <img src="{{ asset ('compartir/images/separador.svg') }}" alt="" class="separador  m-3">

		<a href="javascript:void(0);" name="facebook"><img src="{{ asset ('compartir/images/btn_face.svg') }}" alt="" class="col-11 mt-3 mb-3 facebook"></a>

		<a href="javascript:void(0);"><img src="{{ asset ('compartir/images/btn_google.svg') }}" alt="" class="col-11 mt-3 mb-3 google"></a>
		<div class="m-3">
			<b>O</b>
		</div>

		<a href="{{ route('compartir.email',$codigo_referido) }}"><img src="{{ asset ('compartir/images/btn_email.svg') }}" alt="" class="col-11 mt-3 mb-3"></a>

        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
	</div>
</section>



<!-- fin contenido-->

</div>
<!-- FIN CONTENEDOR-->
@push('scripts')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<!-- Código para google-->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};HandleGoogleApiLibrary()"
onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>

<script type="text/javascript">
    var ira    = "{{ url('descargar')}}";
    function getMobileOperatingSystem() {

        window.location.href = ira;

    }

    $(document).ready(function () {

        $('.google').bind('touchstart click', function (e) {
            e.preventDefault;
            activar_google();
        });
        $('.facebook').bind('touchstart click', function (e) {
            e.preventDefault;
            ingresar();
        });
    });
     //login facebook
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1859980400683639',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v2.11'
        });
        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/es_ES/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function ingresar() {
        FB.login(function (response) {
            validarUsuario();
        }, {scope: 'public_profile, email'});
    }

    function validarUsuario() {
        console.log('Validando Usuario');

        FB.getLoginStatus(function (response) {
            console.log('APP FB');
            if (response.status == 'connected') {
                FB.api('/me', {locale: 'es_ES', fields: 'name,email,link,first_name,middle_name,last_name,gender,birthday,hometown'}, function (response) {



                    var data_referido = new Object();
                    data_referido.nombre = response.first_name;
                    data_referido.apellido = response.last_name;
                    data_referido.email = response.email;
                    data_referido.userID_facebook = response.id;
                    data_referido.codigo = $('#codigo').val();
                    registrar_usuario(data_referido);

                });
            } else if (response.status == 'not_authorized') {
                alert('Debes autorizar la app!');
            } else {
                alert('Debes ingresar a tu cuenta de Facebook!');
            }
        });
    }


    function registrar_usuario(data_referido) {
        //verificar dirección de registro de redes
        var cambio = JSON.stringify(data_referido);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
            });

           $.ajax({
            url: "{{ url('/auth_redes')}}",
            dataType: 'json',
            type: "POST",
            data: cambio,
            success: function (data) {
                    if (data.status == 'exito') {
                        document.location = ira;
                    } else {
                        alert(data.error[0]);
                    }
                },

                error: function (xhr, status) {
                    alert('Disculpe, existió un problema');
                },
            });
       }

    ////////////////////////////////////////////////////////////////////////////////////////////
    //activando google
    ////////////////////////////////////////////////////////////////////////////////////////////
    function HandleGoogleApiLibrary() {
        // Load "client" & "auth2" libraries
        gapi.load('client:auth2', {
            callback: function () {
                // Initialize client library
                // clientId & scope is provided => automatically initializes auth2 library
                gapi.client.init({
                    apiKey: 'AIzaSyAm5R0eFkhGsYTV12Cuz7VHGGEWYtkVNqU',
                    clientId: '532872190545-h87jgs562eijh6pfqkrahk53snqbla0s.apps.googleusercontent.com',
                    scope: 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me'
                }).then(
                    // On success
                    function (success) {
                        // After library is successfully loaded then enable the login button
                        $("#login-button").removeAttr('disabled');
                    },
                    // On error
                    function (error) {
                        alert('Error : Failed to Load Library');
                    }
                );
            },
            onerror: function () {
                // Failed to load libraries
            }
        });
    }
    function activar_google() {
        // API call for Google login
        gapi.auth2.getAuthInstance().signIn().then(
            // On success
            function (success) {
                // API call to get user information
                gapi.client.request({path: 'https://www.googleapis.com/plus/v1/people/me'}).then(
                    // On success
                    function (success) {
                        console.log(success);
                        var user_info = JSON.parse(success.body);
                        console.log(user_info);
                        var data_referido = new Object();
                        data_referido.nombre = success.result.name.givenName;
                        data_referido.apellido = success.result.name.familyName;
                        data_referido.email = user_info.emails[0].value;
                        data_referido.userID_google = user_info.id;
                        data_referido.referido = $('#codigo').val();
                        registrar_usuario(data_referido);

                    },
                    // On error
                    function (error) {
                        $("#login-button").removeAttr('disabled');
                        alert('Error : Failed to get user user information');
                    }
                );
            },
            // On error
            function (error) {
                $("#login-button").removeAttr('disabled');
                //alert('Error : Login Failed');
                alert("Tu navegador está bloqueando las ventanas emergentes, Por favor, permite este sitio en tu configuración para poder acceder.");
            }
        );

    }


</script>

@endpush
@stop