<!DOCTYPE html>
<html>
<head>

<title>test</title>
<script src="jquery.min.js"></script>

<script>
function padronafip() {
  var nro = $('#cuit_dest').val();
  location.href="http://robertofocke-test.comxa.com/padron.php?id="+nro;
  return false;
}
</script>
</head>
<body>
<?php
$id=isset($_GET['id']) ? $_GET['id'] : '0';
if (strlen($id) > "8") {
$buscar = 'https://soa.afip.gob.ar/sr-padron/v2/persona/'.$id;
$respuesta = file_get_contents($buscar);

$respuesta = json_decode($respuesta);
echo("<center> nombre : ".$respuesta->data->nombre);echo("</center><br>");
echo("<center> documento : ".$respuesta->data->numeroDocumento);echo("</center><br>");
if (isset($respuesta->data->domicilioFiscal->direccion)){
echo("<center> direccion : ".$respuesta->data->domicilioFiscal->direccion);echo("</center><br>");
}
echo("<center><a href='http://robertofocke-test.comxa.com/padron.php'>Buscar Otra persona</a></center>");
}


elseif ($id=="0") {
echo ("<center><h1>Solo para ciudadanos registrados en AFIP</h1></center><br>");
echo ("
<center>
<input id='cuit_dest' name='cuit_dest' type='text' class='form-control' placeholder='Ingerse CUIT o DNI'></center><br>");
echo ("<center><button onClick='padronafip()'>Buscar</button></center>");
 }else{
$buscar = 'https://soa.afip.gob.ar/sr-padron/v1/personas/'.$id;
$respuesta = file_get_contents($buscar);
$respuesta = json_decode($respuesta,true);
echo("<center> nombre : ".$respuesta['data'][0]['nombre']);echo("</center><br>");
if (isset($respuesta['data'][0]['numeroDocumento'])){
echo("<center> documento : ".$respuesta['data'][0]['numeroDocumento']);echo("</center><br>");
}
if (isset($respuesta['data'][0]['idPersona'])){
echo("<center> cuil : ".$respuesta['data'][0]['idPersona']);echo("</center><br>");
}
if (isset($respuesta['data'][0]['domicilioFiscal']['direccion'])){
echo("<center> direccion : ".$respuesta['data'][0]['domicilioFiscal']['direccion']);echo("</center><br>");
}
echo("<center><a href='http://robertofocke-test.comxa.com/padron.php'>Buscar Otra persona</a></center>");
}
?>
