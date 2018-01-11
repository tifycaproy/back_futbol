<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Millonarios FC</title>

	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap-grid.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/main.css') }}" />
	<script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
</head>

<body>
	<!--CONTENEDOR-->
	<div class="container-fluid ">

		<!--contenido-->

		<section class="row justify-content-center mt-5 no-gutters"><!-- clase no-gutter-->

			<div class="col-12 col-lg-7 col-xl-3">

				<!-- aqui iban los textos, los remplace por una imagen-->

				<img src="{{ asset('compartir/images/text2.png') }}" alt="" class="img-fluid p-4">

				<img src="{{ asset('compartir/images/text3.png') }}" alt="" class="img-fluid p-4">

				<img src="{{ asset('compartir/images/text4.png') }}" alt="" class="img-fluid p-4">
			</div>
		</section>
		<section class="row justify-content-center mt-3 no-gutters"><!-- clase no-gutter-->
			<!-- este logo paso a estar abajo -->
			<div class="col-12  col-lg-5 col-xl-3">
				<img src="{{ asset('compartir/images/logo_millos.png') }}" class="col-8" alt="">

			</div>
		</section>
		<section class="row justify-content-around  mb-5 no-gutters">
			<div class="col-6 col-xl-4 col-lg-4">

				<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="{{ asset ('compartir/images/btn_appstore.svg') }}" class="tiendas" alt="">

				</div>
				<div class="col-6 col-xl-4 col-lg-4">
					<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="{{ asset ('compartir/images/btn_googleplay.svg') }}" class="tiendas" alt="">

					</div>

				</div>
			</section>



			<!-- fin contenido-->

		</div>
		<!-- FIN CONTENEDOR-->

	<script type="text/javascript">


        function getMobileOperatingSystem() {
            console.log("executing redirect to the stores...");

            var userAgent = navigator.userAgent || navigator.vendor || window.opera;

            if (/android/i.test(userAgent)) {
                window.location.href = 'https://play.google.com/store/apps/details?id=com.Wise.SeleccionColombiaOficial&hl=es';
                return "Android";
            } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                window.location.href = 'https://itunes.apple.com/co/app/seleccion-colombia-oficial/id1210353281?mt=8';
                return "iOS";
            } else {

                return false;
            }
        }


        setTimeout(function () {

            getMobileOperatingSystem()
        }, 10000);

	</script>
	</body>

	</html>