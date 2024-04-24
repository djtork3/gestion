<?php
include 'conexion.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$licencia = $_POST['licencia'];

// Meses
$octubre = $_POST['octubre'];
$noviembre = $_POST['noviembre'];
$diciembre = $_POST['diciembre'];
$enero = $_POST['enero'];
$febrero = $_POST['febrero'];
$marzo = $_POST['marzo'];
$abril = $_POST['abril'];
$mayo = $_POST['mayo'];
$junio = $_POST['junio'];

// Temporada
$año = $_POST['año'];

// Forma de pago
$pago = $_POST['pago'];

// Contacto
$telefono = $_POST['telefono'];

// Tipo de persona
$persona = $_POST['persona'];

// Insertar datos en la base de datos
$sql = "INSERT INTO tbl_alumnos (`Nombre y Apellidos`, `Matricula`, `Licencia_Federativa`, `Octubre`, `Noviembre`, `Diciembre`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Año_Escolar`, `Pago`, `Telefono`, `Tipo_Persona`) 
VALUES ('$nombre', '$matricula', '$licencia', '$octubre', '$noviembre', '$diciembre', '$enero', '$febrero', '$marzo', '$abril', '$mayo', '$junio', '$año', '$pago', '$telefono', '$persona')";

if ($conn->query($sql) === TRUE) {
  echo "Datos añadidos correctamente";
} else {
  echo "Error al añadir datos: " . $conn->error;
}

$conn->close();
?>

