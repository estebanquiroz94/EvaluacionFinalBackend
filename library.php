<?php
/*Se realiza la carga del archivo con la informacion de las casas*/
function readData()
{
  $data_file = fopen('./data-1.json', 'r');
  $data = fread($data_file, filesize('./data-1.json'));
  $data = json_decode($data, true);
  fclose($data_file);
  return ($data);
};

/*Se aplica filtro por ciudades*/
function getCities($getData)
{
  $getCities = Array();
  foreach ($getData as $cities => $city)
  {
    if(in_array($city['Ciudad'], $getCities)){
    }else
    {
      array_push($getCities, $city['Ciudad']);
    }
  }
  echo json_encode($getCities);
}

/*Se aplica filtro por tipo de vivienda*/
function getTipo($getData)
{
  $getTipo = Array();
  foreach ($getData as $tipos => $tipo)
  {
    if(in_array($tipo['Tipo'], $getTipo)){
    }else
    {
      array_push($getTipo, $tipo['Tipo']);
    }
  }
  echo json_encode($getTipo);
}

/*Se aplica filtro por la información personalizada*/
function aplicarFiltros($filtroPorCiudad, $filtroPorTipo, $filtroPorPrecio,$data)
{
  $itemList = Array();
  if($filtroPorCiudad == "" and $filtroPorTipo=="" and $filtroPorPrecio=="")
  {
    foreach ($data as $index => $item)
    {
      array_push($itemList, $item);
    }
  }else
  {
    $menor = $filtroPorPrecio[0];
    $mayor = $filtroPorPrecio[1];

    if($filtroPorCiudad == "" and $filtroPorTipo == "")
    {
      foreach ($data as $items => $item)
      {
        $precio = precioNumero($item['Precio']);
        if ( $precio >= $menor and $precio <= $mayor)
        {
          array_push($itemList,$item );
        }
      }
    }

    if($filtroPorCiudad != "" and $filtroPorTipo == "")
    {
      foreach ($data as $index => $item)
      {
        $precio = precioNumero($item['Precio']);
        if ($filtroPorCiudad == $item['Ciudad'] and $precio > $menor and $precio < $mayor)
        {
          array_push($itemList,$item );
        }
      }
    }

    if($filtroPorCiudad == "" and $filtroPorTipo != "")
    {
      foreach ($data as $index => $item)
      {
        $precio = precioNumero($item['Precio']);
        if ($filtroPorTipo == $item['Tipo'] and $precio > $menor and $precio < $mayor)
        {
          array_push($itemList,$item );
        }
      }
    }

    if($filtroPorCiudad != "" and $filtroPorTipo != "")
    {
      foreach ($data as $index => $item)
      {
        $precio = precioNumero($item['Precio']);
        if ($filtroPorTipo == $item['Tipo'] and $filtroPorCiudad == $item['Ciudad'] and $precio > $menor and $precio < $mayor)
        {
          array_push($itemList,$item );
        }
      }
    }
  }
  echo json_encode($itemList);
};

/*Aplica filtro por propiedadraiz*/
function precioNumero($itemPrecio)
{
  $precio = str_replace('$','',$itemPrecio);
  $precio = str_replace(',','',$precio);
  return $precio;
}
?>
