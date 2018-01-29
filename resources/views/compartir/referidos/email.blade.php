@extends ('compartir.referidos.header')
<?php $codigo_referido=$codigo;
$nombre=$nombre;
?>

@section ('content')

<!--contenido-->
<section class="row justify-content-center mt-3 no-gutters"><!-- clase no-gutter-->
  
 <div class="col-12 col-lg-5 pl-5 pr-4">
    <!--formulario-->

    <form name="form1" id="form1" role="form" action="" method="POST" class="mt-3 ">
       <div class="form-group">
          <input name="codigo" type="hidden" id="codigo" value="<?php echo $codigo_referido;?>">
          <input type="text" name="nombre" class="form-control form-control-lg" id="nombre"  placeholder="Nombre" maxlength="60" required>

      </div>
      <div class="form-group">

          <input type="text" name="apellido" class="form-control form-control-lg" id="apellido" placeholder="Apellido" maxlength="60" required>

      </div>
      <div class="form-row">
          <div class="form-group col-3">

             <input type="text" class="form-control form-control-lg" id="pais" name="pais" placeholder="+57" onchange="validarpais( this.value );"
             maxlength="2" required>

         </div>
         <div class="form-group col-9">

             <input type="text" class="form-control form-control-lg" id="celular" name="celular" placeholder="Celular" required maxlength="11" >

         </div>
     </div>
     <div class="form-group">

      <input type="email" name="email" class="form-control form-control-lg" id="email"  placeholder="Correo" maxlength="100" required>

  </div>
  <div class="form-group">

      <input type="password" class="form-control form-control-lg" id="clave" name="clave"  placeholder="Contraseña" maxlength="60" required>

  </div>
  <div class="form-group ">
      <input id="" type="submit" class="btn btn-submit btn-lg btn-block" value="Regístrate">
      <div class="respuesta"></div>
  </div>
  <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
  

</form>
<!--fin formulario-->
</div>
</section>


</div>
<!-- fin contenido-->

</div>
<!-- FIN CONTENEDOR-->
@push('scripts')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript" language="javascript">
    function validarpais(pais) {
        var patt = new RegExp("^[+][1-9][0-9]?[0-9]?$");
        
        var res="+"+pais;
        var res2 = patt.test(res);
        if (!res2) {
           alert('Código de país no es válido. Por favor, asegúrese de colocar un "+" antes del Código');
            
            return false;
        }else{ document.form1.pais.value = res; }
        // return true;
    }
    $ = jQuery;
    jQuery(document).ready(function () {
        $("input#email").bind('change', function () {
            var email = $(this).val();
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(email)) {
                alert("Error: La dirección de correo " + email + " es incorrecta.");
                //document.form1.email.value = "";
            }
            ;
        });

        $("input#pais").bind('keydown', function (event) {
          
         if(event.shiftKey)
         {
          event.preventDefault();
        }
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {

        }
        else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
              event.preventDefault();
            }
          } 
          else {
            if (event.keyCode < 96 || event.keyCode > 105) {
              event.preventDefault();
            }
          }
        }        
        ;
      });



        $("input#celular").bind('keydown', function (event) {
         if(event.shiftKey)
         {
          event.preventDefault();
        }
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9)    {

        }
        else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
              event.preventDefault();
            }
          } 
          else {
            if (event.keyCode < 96 || event.keyCode > 105) {
              event.preventDefault();
            }
          }
        }        
        ;
      });

        $("input#celular").bind('change', function () {
            var celular = $(this).val();
            expr = new RegExp("^[0-9]{10}$");
            if (!expr.test(celular)) {
                alert("Error: Número de celular no Válido " + celular + " es incorrecto.");
                document.form1.celular.value = "";
                document.form1.pais.focus();
            }
            ;
        });

      
               

        function getMobileOperatingSystem() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            // Windows Phone must come first because its UA also contains "Android"
            if (/windows phone/i.test(userAgent)) {
                return "Windows Phone";
            }
            if (/android/i.test(userAgent)) {
                return "Android";
            }
            // iOS detection from: http://stackoverflow.com/a/9039885/177710
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "iOS";
            }
            return "unknown";
        }
        var dispositivo = getMobileOperatingSystem();
        $("#form1").submit(function (event) {
            event.preventDefault();
            var telefono = $('#pais').val() +" "+ $('#celular').val();
            var data_referido = new Object();
            data_referido.nombre = $('#nombre').val();
            data_referido.apellido = $('#apellido').val();
            data_referido.email = $('#email').val();
            data_referido.clave = $('#clave').val();
            data_referido.referido = $('#codigo').val();
            data_referido.celular = telefono;
            data_referido._token   = $('_token').val();
            var cambio = JSON.stringify(data_referido);
            var ira    = "{{ url('descargar')}}";      
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('[name="_token"]').val()
             }
         });
            $.ajax({
                url: "{{ url('/registro')}}",
                dataType: 'json',
                type: "POST",
                data: cambio,
                success: function (data) {
                    //console.log(data);
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
        });
    });
</script>
@endpush

@stop