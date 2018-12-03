var mostrarAll=[], ciudad_f, tipos_f;
/*itemmostrado
itemParaMostrar = itemmostrado
mostrarAll = mostrarTodos
lib.php = data.php
datas = datas
FiltroInicial = filtroInit
*/
function mostrarTodos(event){
  event.preventDefault();
  $(".colContenido").html(mostrarAll);
}

function datos(){
    $.ajax({
      data: "",
      url:  "./php/datajson.php",
      type: "post",
      dataType: "json",
      success: function (datas) {
        tituloContenido=datas.tituloContenido;
        ciudad_f=datas.ciudades;
        tipos_f=datas.tipos;
        //carga filtros
        filtroInicial(ciudad_f,tipos_f)
        //para mostrar contenido si se spresioa antes de hacer consulta
        mostrarAll[0]=tituloContenido;
        for (var i = 1; i <= 100; i++) {
          mostrarAll[i]=datas[i];
        }

      }
    })
}

function filtroInicial(ciu,tip){
  //para cargar filtros

  var filtro1 = JSON.stringify(ciu);
  var filtro2 = JSON.stringify(tip);
  var largo1 = filtro1.length - 2;
  var largo2 = filtro2.length - 2;
  filtro1 = filtro1.substr(1,largo1);
  filtro2 = filtro2.substr(1,largo2);
  filtro1 = filtro1.replace(/['"]+/g,'');
  filtro2 = filtro2.replace(/['"]+/g,'');
  //convertiendo string a array
  filtro1 = filtro1.split(',');
  filtro2 = filtro2.split(',');
  //preparando JQuery para cargar la pagina
  $("#selectCiudad").append('<option value="'+filtro1[0]+'">'+filtro1[0]+'</option>',
    '<option value="'+filtro1[1]+'">'+filtro1[1]+'</option>',
    '<option value="'+filtro1[2]+'">'+filtro1[2]+'</option>',
    '<option value="'+filtro1[3]+'">'+filtro1[3]+'</option>',
    '<option value="'+filtro1[4]+'">'+filtro1[4]+'</option>'
  );
  $("#selectTipo").append('<option value="'+filtro2[0]+'">'+filtro2[0]+'</option>',
    '<option value="'+filtro2[1]+'">'+filtro2[1]+'</option>',
    '<option value="'+filtro2[2]+'">'+filtro2[2]+'</option>',
    );
  $("select").material_select('update');

}

function buscar_envio(event){
  event.preventDefault();
  var ciudad = $('#selectCiudad').val();
  var tipo = $('#selectTipo').val();
  var rango = $('#rangoPrecio').val();
  var filtro= 'ciudad='+ciudad +'&tipo='+tipo+'&precio='+rango;
  var titulo = '<div class="tituloContenido card"><h5>Resultados de la búsqueda:</h5><div class="divider"></div><button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button></div>';
  $.ajax({
          type:  "post",
          url: "./php/buscador.php",
          data: filtro,
          dataType: "json",
          success:  function (datas){
      if (datas !=""){
        $(".colContenido").html(titulo + datas);
      }else {
        $(".colContenido").html('<div class="tituloContenido card"><h5>No se encuentran resultados de la búsqueda!</h5><div class="divider"></div><button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button></div>');
      }
    }
  });
  return false;
}


$(function(){
  datos();
  $("#mostrarTodos").click(mostrarTodos);
  $(".buscador").submit(buscar_envio);
})
