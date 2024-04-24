<?php
include 'conexion.php';

if(isset($_POST['editNombre'])) {
    $id = $_POST['editID'];
    $nombre = $_POST['editNombre'];
    $matricula = $_POST['editMatricula'];
    $licencia = $_POST['editLicencia'];
    $octubre = $_POST['editOctubre'];
    $noviembre = $_POST['editNoviembre'];
    $diciembre = $_POST['editDiciembre'];
    $enero = $_POST['editEnero'];
    $febrero = $_POST['editFebrero'];
    $marzo = $_POST['editMarzo'];
    $abril = $_POST['editAbril'];
    $mayo = $_POST['editMayo'];
    $junio = $_POST['editJunio'];
    $año = $_POST['editAño'];
    $pago = $_POST['editPago'];
    $telefono = $_POST['editTelefono'];
    $persona = $_POST['editPersona'];
    
    $sql = "UPDATE tbl_alumnos SET 
                `Nombre y Apellidos` = '$nombre', 
                Matricula = '$matricula', 
                Licencia_Federativa = '$licencia', 
                Octubre = '$octubre', 
                Noviembre = '$noviembre', 
                Diciembre = '$diciembre',
                Enero = '$enero',
                Febrero = '$febrero',
                Marzo = '$marzo',
                Abril = '$abril',
                Mayo = '$mayo',
                Junio = '$junio',
                Año_Escolar = '$año',
                Pago = '$pago',
                Telefono = '$telefono',
                Tipo_Persona = '$persona'
            WHERE ID = '$id'";

    if ($conn->query($sql) === TRUE) {
        // La operación de edición fue exitosa
        echo json_encode(array('success' => true));
    } else {
        // Hubo un error al editar los datos
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }

    $conn->close();
}
?>
