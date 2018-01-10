@extends ('compartir.referidos.header')
<?php 
      $base_url = 'http://localhost/millonarios_backend/';
      $codigo_referido=$codigo; 
      $nombre_referido=$nombre;
 ?>

@section ('content')

<section class="row justify-content-center  ">
	<div class="col-12 col-lg-7 col-xl-4">

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

        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Windows Phone must come first because its UA also contains "Android"
        if (/windows phone/i.test(userAgent)) {
            window.location.href = 'compartir/descargar.php';
            return "Windows Phone";
        } else if (/android/i.test(userAgent)) {
            window.location.href = 'https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC';
            return "Android";
        } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            window.location.href = 'https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8';
            return "iOS";
        } else {
            window.location.href = ira;
            return "unknown";
        }
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
                FB.api('/me', {locale: 'es_ES', fields: 'name, email'}, function (response) {

                    var fullName = response.name;
                    fullName = fullName.split(' '),
                        firstName = fullName[0];
                    lastName = fullName[1] + " " + fullName[2];
                    var data_referido = new Object();
                    data_referido.nombre = firstName;
                    data_referido.apellido = lastName;
                    data_referido.email = response.email;
                    data_referido.userID_facebook = response.id;
                    data_referido.referido = $('#codigo').val();
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
                        data_referido.nombre = user_info.displayName;
                        data_referido.apellido = user_info.emails[0].value;
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
                alert('Error : Login Failed');
            }
        );

    }
       

</script>

@endpush
@stop