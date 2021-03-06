@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Configuracion Dorada</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route('configuracion') }}"><i class="fa fa-fw fa-user"></i> Configuracion</a></li>
            <li>Configuracion Dorada</li>
        </ol>
    </div>
</div>
<input type="hidden" id="secreto" value="" >
<input type="hidden" id="imagen_secret" value="" >
<div class="row">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Suscripciones</a></li>
    <li><a data-toggle="tab" href="#menu1">Beneficios Dorados</a></li>
    <li><a data-toggle="tab" href="#menu2">Cancelar</a></li>
  </ul>
<br>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <section class="content container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-xs-4">
                            <label >Costo Menor</label>
                            <div class="input-group">
                                <input type="text" class="form-control dinero" id="costo_menor" placeholder="Costo Menor" value=""><span class="input-group-addon"><i class="fa fa-dollar"></i></span>                      
                            </div>
                     </div>
                     <div class="col-xs-4">
                            <label >Costo Mayor </label>
                            <div class="input-group">
                                <input type="text" class="form-control dinero" id="costo_mayor" placeholder="Costo Mayor" value=""><span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            </div>
                     </div>
                     <div class="col-xs-4">
                            <label >Duracion </label>
                            <div class="input-group">
                                <input type="text" class="form-control numeros" id="duracion" placeholder="Duracion" value=""><span class="input-group-addon">Dias</span>
                            </div>
                     </div>
                </div><br>
                <div class="row">
                    <div class="col-xs-12">
                          <label >Descripcion</label>
                          <textarea name="descripcion" rows="3" id="descripcion" class="form-control"></textarea>
                    </div>
                </div>
            </div>
           <br>
           <div class="form-group"> 
                
                  <button id="add_suscrip" class="btn btn-primary pull-right add_suscrip" >Agregar</button>
               
            </div>
            <br><br>
            <section  class="content">
                <div class="col-md-12">
                  <div class="box-body table-responsive table-bordered no-padding">
                    <table id="suscriptab" class="table table-hover table-bordered" align="center">
                    <thead>
                      <tr align="center">
                        <th align="center" >Costo Menor</th>
                        <th align="center" >Costo Mayor</th>
                        <th align="center" >Duracion</th>
                        <th align="center" >Descripcion</th>
                        <th align="center" >Acción</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if(count($suscripciones)> 0)
                            @foreach($suscripciones as $s)
                            <tr  data-costo_menor="{{$s->costo_menor}}" data-costo_mayor="{{$s->costo_mayor}}" data-descripcion="{{$s->descripcion}}" data-id="{{$s->id}}" data-duracion="{{$s->duracion}}">
                                <td>{{$s->costo_menor}}</td>
                                <td>{{$s->costo_mayor}}</td>
                                <td>{{$s->duracion}} Dias</td>
                                <td>{{$s->descripcion}}</td>
                                <td>
                                    <a id="edit_suscrip" type="submit" class="btn btn-success btn-xs edit_suscrip" >Editar</a>
                                    <a id="delete" type="submit" class="btn btn-danger btn-xs delete" >eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>

                    </table>
                  </div>
                </div>
            </section>
        </section>
    </div>
    <div id="menu1" class="tab-pane fade">
        <section class="content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                        <label>Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo') }}" maxlength="100" required autofocus>
                        @if ($errors->has('titulo'))
                            <p class="help-block">{{ $errors->first('titulo') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}" maxlength="300">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                        <label>Fecha</label>
                        <input type="text" class="form-control datetimepicker" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                        @if ($errors->has('fecha'))
                            <p class="help-block">{{ $errors->first('fecha') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="Normal"@if(old('tipo')=='Normal') selected @endif>Normal</option>
                            <option value="Video"@if(old('tipo')=='Video') selected @endif>Video</option>
                            <option value="Infografia"@if(old('tipo')=='Infografia') selected @endif>Infografía</option>
                            <option value="Galeria"@if(old('tipo')=='Galeria') selected @endif>Galería</option>
                            <option value="Stat"@if(old('tipo')=='Stat') selected @endif>Stat</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Activa</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1"@if(old('active')=='1') selected @endif>Si</option>
                            <option value="0"@if(old('active')=='0') selected @endif>No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-12">
                      <label >Descripcion</label>
                      <textarea name="descripcion_bene" rows="3" id="descripcion_bene" class="form-control"></textarea>
                </div>

                  <div class="col-lg-12">
                     <form method="POST" id="formulario" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Imagen Beneficios</label>
                            <div class="slim">
                                <input id="imagen_bene" name="fileNameImgBene" type="file" accept="image/jpeg, image/png, image/gif" />
                            </div>
                            <label><span> JPG y PNG</span></label>
                            <h5>Imagen actual</h5>
                            <p><a id="imagen_actual" href="" target="_blank"><img id="img_actual" src="" style="max-width: 100%"></a></p>
                        </div>
                      </form>
                  </div>

            </div>
           <br>
           <div class="form-group">
                  <button id="add_bene" class="btn btn-primary pull-right add_bene" >Agregar</button>
            </div>
            <br><br>
            <section  class="content">
                <div class="col-md-12">
                  <div class="box-body table-responsive table-bordered no-padding">
                    <table id="benetab" class="table table-hover table-bordered" align="center">
                    <thead>
                      <tr align="center">
                          <th align="center" >Descripcion</th>
                          <th align="center" >Url</th>
                          <th align="center" >Fecha</th>
                          <th align="center" >Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(count($beneficios)> 0)
                            @foreach($beneficios as $b)
                            <tr   data-descripcion="{{$b->descripcion}}" data-id="{{$b->id}}"  data-url="{{$b->url}}">
                                <td>{{$b->descripcion}}</td>
                                <td><a target="_blank" href="{{$b->url}}" title="imagen">{{$b->url}}</a></td>
                                <td>{{ date('d/m/Y H:n',strtotime($b->fecha)) }}</td>
                                <td>
                                    <a id="edit_bene" type="submit" class="btn btn-success btn-xs edit_bene" >Editar</a>
                                    <a id="delete_bene" type="submit" class="btn btn-danger btn-xs delete_bene" >eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>

                    </table>
                  </div>
                </div>
            </section>
        </section>
    </div>
    <div id="menu2" class="tab-pane fade">
        <section class="content container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                          <label >Descripcion</label>
                          <textarea name="descripcion_cancel" rows="3" id="descripcion_cancel" class="form-control"></textarea>
                    </div>
                </div>
            </div>
           <br>
           <div class="form-group"> 
                
                  <button id="add_cancel" class="btn btn-primary pull-right add_cancel" >Agregar</button>
               
            </div>
            <br><br>
            <section  class="content">
                <div class="col-md-12">
                  <div class="box-body table-responsive table-bordered no-padding">
                    <table id="canceltab" class="table table-hover table-bordered" align="center">
                    <thead>
                      <tr align="center">
                        <th align="center" >Descripcion</th>
                        <th align="center" >Acción</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if(count($cancelar)> 0)
                            @foreach($cancelar as $b)
                            <tr   data-descripcion="{{$b->descripcion}}" data-id="{{$b->id}}">
                                <td>{{$b->descripcion}}</td>
                                <td>
                                    <a id="edit_cancel" type="submit" class="btn btn-success btn-xs edit_cancel" >Editar</a>
                                    <a id="delete_cancel" type="submit" class="btn btn-danger btn-xs delete_cancel" >eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>

                    </table>
                  </div>
                </div>
            </section>
        </section>
    </div>

  </div>
</div>

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

<br><br><br><br><br><br>
@endsection
@section('javascript')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var token = $( "input[name='_token']" ).val();
    var imagen ;
$(".dinero").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});
$('.numeros').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g,'');
});
////////////////////////////////////////SUSCRIPCIONES ///////////////////////////////////////
      $("#add_suscrip").on('click',function()
      {
        if ( $("#costo_menor").val() && $("#costo_mayor").val() && $("#descripcion").val()){
        if( parseInt($("#costo_menor").val()) < parseInt($("#costo_mayor").val()) ){
          $.ajax({
            url: '{{ route("add_suscrip") }}',
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            datatype: 'json',
            data:{
                id :$("#secreto").val(),
                costo_menor:$( "#costo_menor" ).val(),
                costo_mayor:$( "#costo_mayor" ).val(),
                descripcion:$( "#descripcion" ).val(),
                duracion:$( "#duracion" ).val()
            },
            success:function( respuesta )
            {
              if(respuesta != null){
                $("#suscriptab tbody tr").each(function (index){
                    if ($(this).data('id') == respuesta.id) {
                        $(this).remove();
                    }
                });
                var boton = '<tr  data-costo_menor="'+respuesta.costo_menor+'" data-costo_mayor="' + respuesta.costo_mayor +'" data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id +'" data-duracion="' + respuesta.duracion +'"><td>'+respuesta.costo_menor+'</td><td>'+respuesta.costo_mayor+'</td><td>'+respuesta.duracion+' Dias</td><td>'+respuesta.descripcion+'</td><td><a id="edit_suscrip" type="submit" class="btn btn-success btn-xs edit_suscrip" >Editar</a><a id="delete" type="submit" class="btn btn-danger btn-xs delete" >eliminar</a></td></tr>';
                  $('#suscriptab tbody').append( boton );
                $( "#costo_menor" ).val("");
                $( "#costo_mayor" ).val("");
                $( "#descripcion" ).val("");
                $( "#duracion" ).val("");
                $("#secreto").val("");
              }else{
                alert("Error al guardar");
              }
            }
          });
        }else alert("[Costo Menor] debe ser menor a [Costo Mayor]");
          $("#add_suscrip").text('Agregar');
        }else alert("Llenar campos.");
      });
      $("#suscriptab").on('click','a.edit_suscrip', function()
      {
        row2 = $(this).parents('tr');
        var id = row2.data('id');
        var costo_menor = row2.data('costo_menor');
        var costo_mayor = row2.data('costo_mayor');
        var descripcion = row2.data('descripcion');
        var duracion = row2.data('duracion');
        $("#secreto").val(id);
        $( "#costo_menor" ).val(costo_menor);
        $( "#costo_mayor" ).val(costo_mayor);
        $( "#descripcion" ).val(descripcion);
        $( "#duracion" ).val(duracion);
        $("#add_suscrip").val( id ).text( 'Actualizar' );
      });
      $("#suscriptab").on('click','a.delete', function()
      {
        var row2 = $(this).parents('tr');row2.remove();
          $.ajax({
            url: '{{ route("delete_suscrip") }}',
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            datatype: 'json',
            data:{
              id: row2.attr('data-id')
            },
            success:function( respuesta )
            {
                $( "#costo_menor" ).val("");$( "#costo_mayor" ).val("");
                $( "#descripcion" ).val("");$("#secreto").val("");
                $( "#duracion" ).val("");$("#add_suscrip").text('Agregar');
            }
          });
      });
////////////////////////////////////////SUSCRIPCIONES ///////////////////////////////////////
////////////////////////////////////////BENEFICIOS ///////////////////////////////////////
  $("#add_bene").on('click',function(){

    if ( $("#descripcion_bene").val()){
        var input = document.getElementById ("imagen_bene");
        if (input.files.length != 0) {

          var formData = new FormData($("#formulario")[0]);
          $.ajax({
              url: '{{ route("add_beneImg") }}',
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
                $("#imagen_secret").val(datos);
                $("#imagen_bene").val("");
                $('.slim').slim('destroy');
                slimPrint();
                  $.ajax({
                    url: '{{ route("add_bene") }}',
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': token},
                    datatype: 'json',
                    data:{
                        id :$("#secreto").val(),
                        descripcion:$( "#descripcion_bene" ).val(),
                        tipo:$("#tipo").val(),
                        fecha:$("#fecha").val(),
                        titulo:$("#titulo").val(),
                        link:$("#link").val(),
                        active:$("#active").val(),
                        url:$("#imagen_secret").val()

                    },
                    success:function(respuesta)
                    {
                      if(respuesta != null){
                        $("#benetab tbody tr").each(function (index){
                            if ($(this).data('id') == respuesta.id) {
                                $(this).remove();
                            }
                        });
                        var boton = '<tr  data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id + '" data-url="'+respuesta.url+'" ><td>'+respuesta.descripcion+'</td><td><a a target="_blank" href="'+respuesta.url+'" title="imagen">'+respuesta.url+'</a></td><td>'+respuesta.fecha+'</td><td><a id="edit_bene" type="submit" class="btn btn-success btn-xs edit_bene" >Editar</a><a id="delete_bene" type="submit" class="btn btn-danger btn-xs delete_bene" >eliminar</a></td></tr>';
                        $('#benetab tbody').append( boton );
                        $( "#descripcion_bene" ).val("");
                        $("#imagen_secret").val("");
                        $("#secreto").val("");
                        $("#fecha").val("");
                        $("#titulo").val("");
                        $("#link").val("");
                        $('#modalCargando').modal('hide');
                      }else{
                        alert("Error al guardar");
                      }
                    }
                  });
                  $("#add_bene").text('Agregar');
              }
          });
        }else alert("La Imagen Beneficios requerida.");
    }else alert("Llenar campos.");
  });

  $("#benetab").on('click','a.edit_bene', function()
  {
    row2 = $(this).parents('tr');
    var id = row2.data('id');

      $.ajax({
          url: '{{ route("buscar_bene") }}',
          type: "get",
          headers: {'X-CSRF-TOKEN': token},
          datatype: 'json',
          data:{
              id: row2.attr('data-id')
          },
          success:function( respuesta )
          {

              $( "#titulo" ).val(respuesta.titulo);
              $( "#link" ).val(respuesta.link);
              $( "#fecha" ).val(respuesta.fecha);
              $("#tipo").val(respuesta.tipo);
              $("#active").val(respuesta.active);
              $("#img_actual").attr('src', respuesta.url);
              $("#imagen_actual").attr('href', respuesta.url);
              
          }

      });

    var descripcion = row2.data('descripcion');
    $("#secreto").val(id);
    $( "#descripcion_bene" ).val(descripcion);
    $("#add_bene").val( id ).text( 'Actualizar' );
  });
  $("#benetab").on('click','a.delete_bene', function()
  {
    var row2 = $(this).parents('tr');row2.hide();
      $.ajax({
        url: '{{ route("delete_bene") }}',
        type: "POST",
        headers: {'X-CSRF-TOKEN': token},
        datatype: 'json',
        data:{
          id: row2.attr('data-id')
        },
        success:function( respuesta )
        {
            $( "#descripcion_bene" ).val("");$("#secreto").val("");
        }
      });
  });
////////////////////////////////////////BENEFICIOS ///////////////////////////////////////
////////////////////////////////////////CANCELAR ///////////////////////////////////////
      $("#add_cancel").on('click',function()
      {
        if ( $("#descripcion_cancel").val()){
          $.ajax({
            url: '{{ route("add_cancel") }}',
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            datatype: 'json',
            data:{
                id :$("#secreto").val(),
                descripcion:$( "#descripcion_cancel" ).val(),
            },
            success:function( respuesta )
            {
              if(respuesta != null){
                $("#canceltab tbody tr").each(function (index){
                    if ($(this).data('id') == respuesta.id) {
                        $(this).remove();
                    }
                });
                var boton = '<tr  data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id +'"><td>'+respuesta.descripcion+'</td><td><a id="edit_cancel" type="submit" class="btn btn-success btn-xs edit_cancel" >Editar</a><a id="delete_cancel" type="submit" class="btn btn-danger btn-xs delete_cancel" >eliminar</a></td></tr>';
                  $('#canceltab tbody').append( boton );
                $( "#descripcion_cancel" ).val("");
                $("#secreto").val("");
              }else{
                alert("Error al guardar");
              }
            }
          });
          $("#add_cancel").text('Agregar');
        }else alert("Llenar campos.");
      });
      $("#canceltab").on('click','a.edit_cancel', function()
      {
        row2 = $(this).parents('tr');
        var id = row2.data('id');
        var descripcion = row2.data('descripcion');
        $("#secreto").val(id);
        $( "#descripcion_cancel" ).val(descripcion);
        $("#add_cancel").val( id ).text( 'Actualizar' );
      });
      $("#canceltab").on('click','a.delete_cancel', function()
      {
        var row2 = $(this).parents('tr');row2.hide();
          $.ajax({
            url: '{{ route("delete_cancel") }}',
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            datatype: 'json',
            data:{
              id: row2.attr('data-id')
            },
            success:function( respuesta )
            {
                $( "#descripcion_cancel" ).val("");$("#secreto").val("");
            }
          });
      });
////////////////////////////////////////CANCELAR ///////////////////////////////////////
slimPrint();
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
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery('.datetimepicker').datetimepicker({
            dateFormat: 'dd/mm/yy'
        });
    })
</script>
@endsection
