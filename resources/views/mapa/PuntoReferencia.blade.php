@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">
@endsection

@section('content')


<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Puntos de Referencia</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("puntoreferencia.index") }}"><i class="fa fa-fw fa-pencil"></i> Punto de referencia</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>


</div>
<br>
<input type="hidden" id="secreto" value="" >

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Informacion basica</a></li>
        <li><a id="imagenes_tab" data-toggle="tab" href="#menu1">Imagenes</a></li>
      </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <section class="content container-fluid">
            <div class="row">
                <div class="row">
                     <div class="col-lg-12">
                        <div id="map" style="width:100%;height:300px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button href="" class="btn btn-success btn-lg btn-block coor">Obtener coordenadas</button>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-xs-4">
                            <label >Nombre</label>
                            <div class="input-group">
                                <input type="text" class="form-control " id="nombre" placeholder="nombre" value="@if($id){{$pr->nombre}}@endif"><span class="input-group-addon">N</span>                      
                            </div>
                     </div>
                    <div class="col-xs-4">
                            <label >Latitud</label>
                            <div class="input-group">
                                <input type="text" class="form-control " id="latitud" placeholder="Latitud" value="@if($id){{$pr->cordx}}@endif"><span class="input-group-addon">LAT</span>                      
                            </div>
                     </div>
                     <div class="col-xs-4">
                            <label >Longitud</label>
                            <div class="input-group">
                                <input type="text" class="form-control " id="longitud" placeholder="Longitud" value="@if($id){{$pr->cordy}}@endif"><span class="input-group-addon">LON</span>
                            </div>
                     </div>
                </div><br>
                <div class="row">
                    <div class="col-xs-6">
                            <label >País</label>
                            <div class="input-group">
                                <input type="text" class="form-control " id="pais" placeholder="pais" value="@if($id){{$pr->pais}}@endif"><span class="input-group-addon">País</span>                      
                            </div>
                     </div>
                    <div class="col-xs-6">
                            <label >Ciudad</label>
                            <div class="input-group">
                                <input type="text" class="form-control " id="ciudad" placeholder="ciudad" value="@if($id){{$pr->ciudad}}@endif"><span class="input-group-addon">Ciudad</span>                      
                            </div>
                     </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-4">
                            <label >Fecha/Hora del evento</label>
                             <input  class="form-control datetimepicker" id="hora_evento" type="text" name="hora_evento"  placeholder="Hora del evento" value="@if($id){{Carbon\Carbon::parse($pr->hora_evento)->format('Y-m-d\TH:i')}}@endif">
                     </div>
                    <div class="col-xs-8">
                            <label >Dirección</label>
                            <textarea id="direccion" name="direccion" rows="3" class="form-control" placeholder="Dirección" >@if($id){{$pr->direccion}}@endif</textarea>                    
                     </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label>Icono</label>
                        <input type="hidden" name="icono" id="icono" value="@if($id){{$pr->icono}}@endif">
                        <table class="tabla_puntos">
                          <tr>
                            <td><img class="bar-rest" src="{{ asset('img/puntos/bar-rest.png') }}"></td>
                            <td><img class="cc" src="{{ asset('img/puntos/cc.png') }}"></td>
                            <td><img class="estadio" src="{{ asset('img/puntos/estadio.png') }}"></td>
                            <td><img class="hotel" src="{{ asset('img/puntos/hotel.png') }}"></td>
                            <td><img class="tienda" src="{{ asset('img/puntos/tienda.png') }}"></td>
                          </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <br>
     <div class="col-lg-12">
        <button href="" class="btn btn-primary btn-lg btn-block save">Guardar</button>
    </div>
    </div>
<br>
    <div id="menu1" class="tab-pane fade">
        <section class="content container-fluid">
            <div class="row">
                <div class="row">
                  <div class="col-lg-12">
                     <form method="POST" id="formulario" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Imagen</label>
                            <div class="slim">
                                <input id="coor_img" name="fileNameImgCoor" type="file" accept="image/jpeg, image/png, image/gif" />
                            </div>
                            <label><span> JPG y PNG</span></label>
                        </div>
                      </form>
                  </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                          <label >Descripcion</label>
                          <textarea name="descripcion" rows="3" id="descripcion" class="form-control"></textarea>
                    </div>
                </div>
                <br>
            </div>
            <div class="form-group"> 
                
                  <button id="add_img" class="btn btn-primary pull-right add_img" >Agregar</button>
               
            </div>
            <br>
            <div class="row">
                
                    <div class="col-md-12">
                      <div class="box-body table-responsive table-bordered no-padding">
                        <table id="coortab" class="table table-hover table-bordered" align="center">
                        <thead>
                          <tr align="center">
                            <th align="center" >Imagen</th>
                            <th align="center" >Acción</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                            @if($id)
                                @foreach($pr->imagenes as $imag)
                                    <tr  data-descripcion="{{$imag->descripcion}}" data-id="{{$imag->id}}" data-url="{{$imag->url}}" >
                                        <td><a a target="_blank" href="{{$imag->url}}" title="imagen">{{$imag->imagen}}</a></td>
                                        <td><a id="delete_coor" type="submit" class="btn btn-danger btn-xs delete_coor" >eliminar</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                        </table>
                      </div>
                    </div>
           
            </div>
        </section>

    </div>
  </div>


<br><br>
<div  class="modal modal-success fade" id="modalCargando">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center">Procesando Datos</h4>
      </div>
    </div>
  </div>
</div>

<div  class="modal modal-success fade" id="modalEliminado">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center">Eliminado Datos</h4>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 


<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9KdpmPR1HKREweEn2U0fqb_NmmE5tl4s&callback=initMap" async defer>
    </script>
<script type="text/javascript">
    var markers = [];
    var clickLat;
    var clickLon
    var pais
    var ciudad
    function initMap() {
      @if($id)
        var latx = "{{$pr->cordx}}";
        var lngy = "{{$pr->cordy}}";
        clickLat = latx;
        clickLon = lngy;
      @endif
        var map = new google.maps.Map(document.getElementById('map'), {
          @if($id)
            center: {lat: parseInt(latx), lng: parseInt(lngy)},
            zoom: 7
          @else
            center: {lat: 4.687986, lng: -74.075813},
            zoom: 7
          @endif
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
        map.addListener('click', function(e) {
            placeMarkerAndPanTo(e.latLng, map);
            if(markers.length>1){
                markers[markers.length-2].setMap(null);
            }
        });
                // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        google.maps.event.addListener(map, "click", function(event) {
            // get lat/lon of click
            clickLat = event.latLng.lat();
            clickLon = event.latLng.lng();
            var latxx = clickLat ;
            var longyy = clickLon ;
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="
               +latxx+","+longyy+"&sensor=false";
          $.get(url).success(function(data) {
             var loc1 = data.results[0];
               $.each(loc1, function(k1,v1) {
                  if (k1 == "address_components") {
                     for (var i = 0; i < v1.length; i++) {
                        for (k2 in v1[i]) {
                           if (k2 == "types") {
                              var types = v1[i][k2];
                              if (types[0] =="country") {
                                  pais = v1[i].long_name;
                              } 
                              if (types[0] == "locality") {
                                 ciudad = v1[i].long_name;
                             } 
                           }
                        }          
                     }
                  }
               });
          }); 
        });
      }
      function placeMarkerAndPanTo(latLng, map) {
        var marker = new google.maps.Marker({
          position: latLng,
          map: map
        });
        markers.push(marker);
        map.panTo(latLng);
      }
   
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    $(document).ready(function(){
        $(function () {
            $('#hora_evento').datetimepicker();
        });
                   
        var token = $( "input[name='_token']" ).val();
        slimPrint();
        $(".coor").on('click',function(){
            $("#latitud").val(clickLat);
            $("#longitud").val(clickLon);
            $("#pais").val(pais);
            $("#ciudad").val(ciudad);
        });
        function slimPrint() {
            $('.slim').slim({
              label: 'Arrastra tu imagen ó haz click aquí',
              ratio: 'free',
              minSize: {
                  width: 30,
                  height: 30
              },
              download: false,
              labelLoading: 'Cargando imagen...',
              statusImageTooSmall: 'La imagen es muy pequeña. El tamaño mínimo es $0 píxeles.',
              statusUnknownResponse: 'Ha ocurrido un error inesperado.',
              statusUploadSuccess: 'Imagen guardada',
              statusFileType: 'El formato de imagen no es permitido. Solamente: $0.',
              statusFileSize: 'El tamaño máximo de imagen es 2MB.',
              buttonConfirmLabel: 'Aceptar',
              buttonConfirmTitle: 'Aceptar',
              buttonCancelLabel: 'Cancelar',
              buttonCancelLabel: "Cancelar",
              buttonCancelTitle: "Cancelar",
              buttonEditTitle: "Editar",
              buttonRemoveTitle: "Eliminar",
              buttonRotateTitle: "Rotar",
              buttonUploadTitle: "Guardar"
          });
        }
        @if($id)
            id = "{{$id}}";
            $("#secreto").val(id);
            $("#imagenes_tab").show();
        @else
            $("#imagenes_tab").hide();
        @endif
        $(".save").on('click',function(){
            if ( $("#nombre").val() && $("#latitud").val() && $("#longitud").val()){
                var urlx = '{{ route("puntoreferencia.store") }}';
         
                  $.ajax({
                    url: urlx,
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': token},
                    datatype: 'json',
                    data:{
                        nombre:$( "#nombre" ).val(),
                        latitud:$( "#latitud" ).val(),
                        longitud:$( "#longitud" ).val(),
                        id:$( "#secreto" ).val(),
                        hora_evento:$( "#hora_evento" ).val(),
                        direccion:$( "#direccion" ).val(),
                        pais:$( "#pais" ).val(),
                        ciudad:$( "#ciudad" ).val(),
                        icono:$( "#icono" ).val()
                    },
                    success:function( respuesta )
                    {
                        alert("Se ha guardado");
                        $("#imagenes_tab").show();
                        $("#secreto").val(respuesta);
                    }
                  });
              }else alert("Llenar campos.");
        });
        ////////////////////////////////////////IMAGENES COORDENADAS ///////////////////////////////////////
          $(".add_img").on('click',function(){
            if ( $("#descripcion").val()){
              var formData = new FormData($("#formulario")[0]);
              $.ajax({    
                  url: '{{ route("add_coorImg") }}',
                  type: "POST",
                  headers: {'X-CSRF-TOKEN': token},
                  data: formData,
                  contentType: false,
                  processData: false,
                  beforeSend: function(){
                    $('#modalCargando').modal('show');
                  },
                  success: function(datos)
                  {
                    $('.slim').slim('destroy');
                    var url = datos;
                    slimPrint();
                      $.ajax({
                        url: '{{ route("add_coor") }}',
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': token},
                        datatype: 'json',
                        data:{
                            descripcion:$( "#descripcion" ).val(),
                            url:url,
                            id:$( "#secreto" ).val(),
                        },
                        success:function( respuesta )
                        {
                          if(respuesta != null){
                            $("#coortab tbody tr").each(function (index){
                                if ($(this).data('id') == respuesta.id) {
                                    $(this).remove();
                                }
                            });
                            var boton = '<tr  data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id + '" data-url="'+respuesta.url+'" ><td><a a target="_blank" href="'+respuesta.url+'" title="imagen">'+respuesta.imagen+'</a></td><td><a id="delete_coor" type="submit" class="btn btn-danger btn-xs delete_coor" >eliminar</a></td></tr>';
                            $('#coortab tbody').append( boton );
                            $( "#descripcion" ).val("");
                            $('#modalCargando').modal('hide');
                          }else{
                            alert("Error al guardar");
                          }
                        }
                      });
                      $("#add_img").text('Agregar');
                  }
              });
            }else alert("Llenar campos.");
          });
          $("#coortab").on('click','a.delete_coor', function()
          {
            var row2 = $(this).parents('tr');row2.hide();
              $.ajax({
                url: '{{ route("delete_coor") }}',
                type: "POST",
                headers: {'X-CSRF-TOKEN': token},
                datatype: 'json',
                data:{
                  id: row2.attr('data-id')
                },
                beforeSend: function(){
                    $('#modalEliminado').modal('show');
                  },
                success:function( respuesta )
                {
                    $('#modalEliminado').modal('hide');
                }
              });
          });
        ////////////////////////////////////////IMAGENES COORDENADAS ///////////////////////////////////////
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery('.datetimepicker').datetimepicker({
            dateFormat: 'dd/mm/yy'
        });
        if($('#icono').val()!=''){
          $('.' + $('#icono').val()).addClass('active');
        }
        $('.tabla_puntos td img').click(function(){
          $('.tabla_puntos td img').removeClass('active');
          $('#icono').val($(this).attr("class"));
          $(this).addClass('active');
        })
    })
</script>

@endsection