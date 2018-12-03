<?php
//leer base de datos
require('conectarse.php');
$datas=array();
//para capturar los envios de html

if($_POST['ciudad'] != "null"){
  $ciudad=$_POST['ciudad'];
}else{
  $ciudad=null;
}

if ($_POST['tipo'] != "null"){
  $tipo = $_POST['tipo'];
}else {
  $tipo = null;
}
  $p = $_POST['precio'];
/*
$ciudad="New York";
$tipo = null;
$sp="200;80000";
*/
  $precio = explode(";",$p);
  $precio_i = intval($precio[0]);
  $precio_f = intval($precio[1]);

  if($ciudad != null && $tipo != null){
    foreach ($data as $key => $value) {
      $arreglar = array("$",",");
      $valor = str_replace($arreglar,"",$value['Precio']);
      $valor = intval($valor);
      if ($precio_i <= $valor && $valor <= $precio_f){
        if ($ciudad == $value['Ciudad'] && $tipo == $value['Tipo']){
          $datas[$key]='<div class="itemMostrado card">
              <img src="img/home.jpg">
              <div class="card-stacked">
                  <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                  <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                  <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                  <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                  <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                  <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                  <div class="divider"></div>
                  <div class="card-action">VER MAS</div>
              </div>
            </div>';
        }
      }
    }   

  }else if($ciudad != null xor $tipo != null ) {
    foreach ($data as $key => $value) {
      $arreglar = array("$",",");
      $valor = str_replace($arreglar,"",$value['Precio']);
      $valor = intval($valor);
      //se filtra por el precio
      if ($precio_i <= $valor && $valor <= $precio_f){
        if ($ciudad == null){
          if ($tipo == $value['Tipo']){
            $datas[$key] = '<div class="itemMostrado card">
                        <img src="img/home.jpg">
                          <div class="card-stacked">
                            <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                          <div class="divider"></div>
                          <div class="card-action">VER MAS</div>
                          </div>
                        </div>';
          }
        } else if ($tipo == null){
          if($ciudad == $value['Ciudad']){
            $datas[$key] = '<div class="itemMostrado card">
                        <img src="img/home.jpg">
                          <div class="card-stacked">
                            <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                          <div class="divider"></div>
                          <div class="card-action">VER MAS</div>
                          </div>
                        </div>';
          }
        }
      }
    }
  }else {
    // y si no existe
    foreach ($data as $key => $value) {
      $arreglar = array("$",",");
      $valor = str_replace($arreglar,"",$value['Precio']);
      $valor = intval($valor);
      if($precio_i <= $valor && $valor <= $precio_f){
        $datas[$key] = '<div class="itemMostrado card">
                   <img src="img/home.jpg">
                     <div class="card-stacked">
                       <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                       <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                       <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                       <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                       <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                       <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                     <div class="divider"></div>
                     <div class="card-action">VER MAS</div>
                     </div>
                   </div>';
      }
    }
  }
  $res = array_unique($datas);
  $r = array_values($res);
  echo json_encode($r);
?>
