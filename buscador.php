<?php
  //Se obtiene la referencia requerida
  require('./library.php');

  //Se obtiene la información enviada para realizar los friltros de búsqueda
  $filtroPorCiudad = $_GET['filtro']['Ciudad'];
  $filtroPorTipo = $_GET['filtro']['Tipo'];
  $filtroPorPrecio =  $_GET['filtro']['Precio'];
  $getData = readData();

  aplicarFiltros($filtroPorCiudad, $filtroPorTipo, $filtroPorPrecio, $getData);
 ?>
