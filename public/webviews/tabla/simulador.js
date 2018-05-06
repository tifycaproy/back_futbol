
// Scroll

function animaScroll(destino){

  $("html,body").animate({
    scrollTop: destino
  }, 700, "swing");

}

$(document).ready(function() {

// MenÃº

$("div.especiales-header-boton").on("click", function(){ $("body").toggleClass("menu-on"); })

$("#menu-especial").on("click", function(e){ if (e.target.id === "menu-especial") { $("body").toggleClass("menu-on"); } });

// Scroll calendario

$("[data-top='subir']").on("click", function(e){
  
  e.preventDefault();
  animaScroll($("[data-top='top']").offset().top);

});

// Fix tabla

var tabla = $("#posiciones-simulador");

$(window).on("scroll", function(){

  var wndw = $(this);

  if (wndw.scrollTop() > 190) { tabla.addClass("tabla-fixed"); } else { tabla.removeClass("tabla-fixed") }

});

// Slide Tabla

$("a.ver-tabla-sim").on("click", function(e){

e.preventDefault();
tabla.toggleClass("tabla-slide-up");

});

// Ancla

var curr = 0,
    box = $("div.contenedor-simulador-movil-inside");

$("[data-ancla]").on("click", function(e){

e.preventDefault();

  var ancho = $(window).outerWidth(),
      el = $(this),
      n = el.attr("data-ancla");
      curr = n;

      el.parent().parent().attr("data-pos", n);

  if ( ancho>709 ) { var d = $("[data-anclado='"+n+"']").offset().top;  animaScroll(d); }

});

// Nav sim

$("h4.calendario-fecha a").on("click", function(e){

    e.preventDefault();
    var el = $(this),
        dir = el.attr("class");

    if (dir === "") { return }

    curr = parseInt(el.parent().attr("data-anclado"));

    if (dir === "izq") { curr=curr-1; box.attr("data-pos",curr) }
    if (dir === "der") { curr=curr+1; box.attr("data-pos",curr) }

})

$("div.contenedor-simulador-movil").on("scroll", function(){

$("div.contenedor-simulador-movil").scrollLeft("100%");

})

$("input[data-eq]").on("keydown", function(e){

var el = $(this),
    elInd = el.index(),
    ind = el.parent().parent().index(),
    ancho = $(window).outerWidth();


if (e.keyCode == 9 && ind === 4 && elInd === 2 ) {

    e.preventDefault();
    curr = parseInt(curr)+1;
    box.attr("data-pos", curr);

    var del = 0;
    if (ancho>709) { del = 0 }

    setTimeout(function(){ $("h4[data-anclado='"+curr+"']").siblings("ul.sim-calendario-grupo").find("input").eq(0).focus(); }, del);
    return

 }

if (e.keyCode == 9 && e.shiftKey && ind === 0 && elInd === 0 ) {

    e.preventDefault();
    curr = parseInt(curr)-1;
    box.attr("data-pos", curr);

    var del = 0;
    if (ancho>709) { del = 0 }

    setTimeout(function(){ $("h4[data-anclado='"+curr+"']").siblings("ul.sim-calendario-grupo").find("input").eq(0).focus(); }, del);
}
});

// Simulador

var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

// Load

var res = Base64.decode(window.location.hash.replace("#!","")).replace("r=", "");

if (res.length > 40) {

  var partidos = $("ul.sim-calendario-grupo li");

  $.each(res.split("/"), function(i, v){

    var marc = partidos.eq(i).children("div.marc"),
        gL = parseInt(v.split("-")[0]),
        gV = parseInt(v.split("-")[1]);

    if (isNaN(gL) || isNaN(gV)) { return }

    marc.children("input").eq(0).val(gL);
    marc.children("input").eq(1).val(gV);

  });

  ordenaTabla();

  window.location.hash = ""

 }

else {
  ordenaTabla();
}

// Inputs

$("input[data-eq]").on("focus", function(){  curr = parseInt($(this).parent().parent().parent().siblings("h4").attr("data-anclado")); });

$("input[data-eq]").on("change", function(){

  var el = $(this),
      tmp = parseInt(el.val().toString().slice(0,2));

      el.val(tmp);

  var v = el.val();

  if (isNaN(v) || v === null) { el.val("") }
  if (v < 0 ) { el.val(Math.abs(v)) }

  var riv = el.siblings("input").val();

  if (isNaN(riv)) { return false }
  if (isNaN(el) && isNaN(riv)) { ordenaTabla(); }
  else { ordenaTabla(); }

});

function ordenaTabla(){

 var tabla = {
          BAR: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          NAC: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          FLU: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          MIN: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          VAR: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          RAN: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          COR: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0},
          PSV: {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0}
  }

  $("input[data-eq]").each(function(){

    var e = $(this).attr("data-eq"),
        goles = parseInt($(this).val()),
        golesRival = parseInt($(this).siblings("input").eq(0).val());

    if (goles > golesRival) {

      tabla[e].pts = tabla[e].pts + 3;
      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pg = tabla[e].pg + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

    if (goles === golesRival) {
      
      tabla[e].pts = tabla[e].pts + 1;
      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pe = tabla[e].pe + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

    if (goles < golesRival) {

      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pp = tabla[e].pp + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

  var tr = $("tr[data-eq='"+e+"'] td");


  tr.eq(2).empty().text(tabla[e].pts);
  tr.eq(3).empty().text(tabla[e].pj);
  tr.eq(4).empty().text(tabla[e].pg);
  tr.eq(5).empty().text(tabla[e].pe);
  tr.eq(6).empty().text(tabla[e].pp);
  tr.eq(7).empty().text(tabla[e].gf);
  tr.eq(8).empty().text(tabla[e].gc);
  tr.eq(9).empty().text(tabla[e].gf - tabla[e].gc);

  });

  reordenar(7);
  reordenar(9);
  reordenar(2);

  // Posiciones

  $("#tabla-posiciones-simulador tr").each(function(v){ $(this).children("td").eq(0).text((v))})

}

function reordenar(cifra){

    var tbl = document.getElementById("tabla-posiciones-simulador").tBodies[0];
    var store = [];
    for(var i=0, len=tbl.rows.length; i<len; i++){
        var row = tbl.rows[i];
        var sortnr = parseFloat(row.cells[cifra].textContent || row.cells[cifra].innerText);
        if(!isNaN(sortnr)) store.push([sortnr, row]);
    }
    store.sort(function(x,y){
        return y[0] - x[0];
    });
    for(var i=0, len=store.length; i<len; i++){
        tbl.appendChild(store[i][1]);
    }
    store = null;
}

// Genera link para compartir

function generaLink(){

var hash = "r=";

$("ul.sim-calendario-grupo li").each(function(){

var el = $(this).children("div.marc"),
    inp = el.children("input"),
    loc = inp.eq(0).val().toString(),
    vis = inp.eq(1).val().toString();

hash = hash + loc + "-" + vis + "/"

})

return Base64.encode(hash);

}



});