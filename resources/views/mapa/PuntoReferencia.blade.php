@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')


<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Puntos de Referencia</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("puntoreferencia.index") }}"><i class="fa fa-fw fa-pencil"></i> Post</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>

<div class="row">
     <div class="col-lg-12">
        <div id="map" style="width:100%;height:400px;">
    </div>
</div>
@endsection
@section('javascript')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9KdpmPR1HKREweEn2U0fqb_NmmE5tl4s&callback=initMap">
    </script>
<script type="text/javascript">
    var markers = [];
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: -25.363882, lng: 131.044922 }
        });

        map.addListener('click', function(e) {
            placeMarkerAndPanTo(e.latLng, map);
            console.log(markers.length);
            if(markers.length>0){
                markers[markers.length-1].setMap(null);
            }
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



</script>

@endsection
