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
                    <div class="col-xs-6">
                            <label >Costo Menor</label>
                            <div class="input-group">
                                <input type="text" class="form-control dinero" id="costo_menor" placeholder="Costo Menor" value=""><span class="input-group-addon"><i class="fa fa-dollar"></i></span>                      
                            </div>
                     </div>
                     <div class="col-xs-6">
                            <label >Costo Mayor </label>
                            <div class="input-group">
                                <input type="text" class="form-control dinero" id="costo_mayor" placeholder="Costo Mayor" value=""><span class="input-group-addon"><i class="fa fa-dollar"></i></span>
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
                        <th align="center" >Descripcion</th>
                        <th align="center" >Acción</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if(count($suscripciones)> 0)
                            @foreach($suscripciones as $s)
                            <tr  data-costo_menor="{{$s->costo_menor}}" data-costo_mayor="{{$s->costo_mayor}}" data-descripcion="{{$s->descripcion}}" data-id="{{$s->id}}">
                                <td>{{$s->costo_menor}}</td>
                                <td>{{$s->costo_mayor}}</td>
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
                <div class="row">
                    <div class="col-xs-12">
                          <label >Descripcion</label>
                          <textarea name="descripcion_bene" rows="3" id="descripcion_bene" class="form-control"></textarea>
                    </div>
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
                        <th align="center" >Acción</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if(count($beneficios)> 0)
                            @foreach($beneficios as $b)
                            <tr   data-descripcion="{{$b->descripcion}}" data-id="{{$b->id}}">
                                <td>{{$b->descripcion}}</td>
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
<br><br><br><br><br><br>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var token = $( "input[name='_token']" ).val();
$(".dinero").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
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
            },
            success:function( respuesta )
            {
              if(respuesta != null){
                $("#suscriptab tbody tr").each(function (index){
                    if ($(this).data('id') == respuesta.id) {
                        $(this).remove();
                    }
                });
                var boton = '<tr  data-costo_menor="'+respuesta.costo_menor+'" data-costo_mayor="' + respuesta.costo_mayor +'" data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id +'"><td>'+respuesta.costo_menor+'</td><td>'+respuesta.costo_mayor+'</td><td>'+respuesta.descripcion+'</td><td><a id="edit_suscrip" type="submit" class="btn btn-success btn-xs edit_suscrip" >Editar</a><a id="delete" type="submit" class="btn btn-danger btn-xs delete" >eliminar</a></td></tr>';
                  $('#suscriptab tbody').append( boton );
                $( "#costo_menor" ).val("");
                $( "#costo_mayor" ).val("");
                $( "#descripcion" ).val("");
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
        $("#secreto").val(id);
        $( "#costo_menor" ).val(costo_menor);
        $( "#costo_mayor" ).val(costo_mayor);
        $( "#descripcion" ).val(descripcion);
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
            }
          });

      });

////////////////////////////////////////SUSCRIPCIONES ///////////////////////////////////////

////////////////////////////////////////BENEFICIOS ///////////////////////////////////////

      $("#add_bene").on('click',function()
      {


        if ( $("#descripcion_bene").val()){
          $.ajax({
            url: '{{ route("add_bene") }}',
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            datatype: 'json',
            data:{
                id :$("#secreto").val(),
                descripcion:$( "#descripcion_bene" ).val(),
            },
            success:function( respuesta )
            {
              if(respuesta != null){
                $("#benetab tbody tr").each(function (index){
                    if ($(this).data('id') == respuesta.id) {
                        $(this).remove();
                    }
                });
                var boton = '<tr  data-descripcion="' + respuesta.descripcion +'" data-id="' + respuesta.id +'"><td>'+respuesta.descripcion+'</td><td><a id="edit_bene" type="submit" class="btn btn-success btn-xs edit_bene" >Editar</a><a id="delete_bene" type="submit" class="btn btn-danger btn-xs delete_bene" >eliminar</a></td></tr>';
                  $('#benetab tbody').append( boton );
                $( "#descripcion_bene" ).val("");
                $("#secreto").val("");
              }else{
                alert("Error al guardar");
              }
            }
          });
          $("#add_bene").text('Agregar');
        }else alert("Llenar campos.");
      });

      $("#benetab").on('click','a.edit_bene', function()
      {
        row2 = $(this).parents('tr');
        var id = row2.data('id');
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

});
</script>
