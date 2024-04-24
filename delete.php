<?php
include 'conexion.php';

if(isset($_GET['ID'])) {
    $alumnoID = $_GET['ID'];
    
    // Eliminar el alumno de la base de datos
    $sql = "DELETE FROM tbl_alumnos WHERE ID = '$alumnoID'";
    if ($conn->query($sql) === TRUE) {
        echo "Alumno eliminado exitosamente";
    } else {
        echo "Error al eliminar el alumno: " . $conn->error;
    }
} else {
    echo "ID de alumno no proporcionado";
}

$conn->close();
?>
