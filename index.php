<!DOCTYPE html>
<html lang="es">
<?php include 'conexion.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="table-responsive table-responsive-md">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Listado <b>de Alumnos</b></h2>
                        </div>
                        <div class="col-md-6">
                            <div style="float: right;">
                                <button id="exportExcelBtn" class="btn btn-primary"><i class="material-icons">&#xE24D;</i> <span>Exportar a Excel</span></button>
                                <a href="#añadirAlumnoModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir alumno</span></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-warning rounded">
                <thead>
                    <tr>
                        <th class="wide-column">Nombre y Apellidos</th>
                        <th>Matricula</th>
                        <th>Licencia</th>
                        <th>Octubre</th>
                        <th>Noviembre</th>
                        <th>Diciembre</th>
                        <th>Enero</th>
                        <th>Febrero</th>
                        <th>Marzo</th>
                        <th>Abril</th>
                        <th>Mayo</th>
                        <th>Junio</th>
                        <th>Temporada</th>
                        <th>Forma de Pago</th>
                        <th>Contacto</th>
                        <th style="display: none;">Tipo de Persona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consultar y mostrar los datos de los alumnos
                    $sql = "SELECT tbl_alumnos.*,
                    CONCAT_WS(', ',
                    CASE WHEN Octubre = 0 THEN 'Octubre' END,
                    CASE WHEN Noviembre = 0 THEN 'Noviembre' END,
                    CASE WHEN Diciembre = 0 THEN 'Diciembre' END,
                    CASE WHEN Enero = 0 THEN 'Enero' END,
                    CASE WHEN Febrero = 0 THEN 'Febrero' END,
                    CASE WHEN Marzo = 0 THEN 'Marzo' END,
                    CASE WHEN Abril = 0 THEN 'Abril' END,
                    CASE WHEN Mayo = 0 THEN 'Mayo' END,
                    CASE WHEN Junio = 0 THEN 'Junio' END
                    ) AS MesesPendientes,
                    SUM(
                        CASE WHEN Octubre = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Noviembre = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Diciembre = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Enero = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Febrero = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Marzo = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Abril = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Mayo = 0 THEN 1 ELSE 0 END +
                        CASE WHEN Junio = 0 THEN 1 ELSE 0 END
                        ) * CASE WHEN tbl_alumnos.Tipo_Persona = 'NIÑO' THEN 40 ELSE 50 END AS TotalPagar
                        FROM
                        tbl_alumnos
                        GROUP BY
                        tbl_alumnos.ID";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                             while($row = $result->fetch_assoc()) {
                                
                                // Mostrar la fila de la tabla con el botón de enviar mensaje
                                echo "<tr class='table-info' data-section='" . strtolower($row["Tipo_Persona"]) . "'>";
                                echo "<td class='nombre'>" . $row["Nombre y Apellidos"] . "</td>";
                                echo "<td>" . $row["Matricula"] . "</td>";
                                echo "<td>" . $row["Licencia_Federativa"] . "</td>";
                                echo "<td>" . $row["Octubre"] . "</td>";
                                echo "<td>" . $row["Noviembre"] . "</td>";
                                echo "<td>" . $row["Diciembre"] . "</td>";
                                echo "<td>" . $row["Enero"] . "</td>";
                                echo "<td>" . $row["Febrero"] . "</td>";
                                echo "<td>" . $row["Marzo"] . "</td>";
                                echo "<td>" . $row["Abril"] . "</td>";
                                echo "<td>" . $row["Mayo"] . "</td>";
                                echo "<td>" . $row["Junio"] . "</td>";
                                echo "<td>" . $row["Año_Escolar"] . "</td>";
                                echo "<td>" . $row["Pago"] . "</td>";
                                echo "<td>" . $row["Telefono"] . "</td>";
                                echo "<td style='display: none;'>" . $row["Tipo_Persona"] . "</td>";
                                echo "<td>";
                                echo "<a href='#editarAlumnoModal' class='edit' data-toggle='modal' data-alumno-id='".$row['ID']."'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a>";
                                echo "<a href='#eliminarAlumnoModal' class='delete' data-toggle='modal' data-alumno-id='".$row['ID']."'><i class='material-icons' data-toggle='tooltip' title='Eliminar'>&#xE872;</i></a>";
                                
                                // Agregar la acción de enviar mensaje solo si el alumno tiene meses pendientes
                                if($row["MesesPendientes"] != "") {
                                    echo "<a href='#enviarMensajeModal' class='mensaje-btn' data-toggle='modal' data-telefono='" . $row["Telefono"] . "' data-nombre='" . $row["Nombre y Apellidos"] . "' data-meses='" . $row["MesesPendientes"] . "' data-total='" . $row["TotalPagar"] . "'><i class='material-icons'>&#xe0e1;</i></a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='15'>No hay alumnos registrados.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de añadir alumno -->
    <?php include 'modales/añadirAlumnoModal.php'; ?>
    <!-- Modal de editar alumno -->
    <?php include 'modales/editarAlumnoModal.php'; ?>
    <!-- Modal de eliminar alumno -->
    <?php include 'modales/eliminarAlumnoModal.php'; ?>
    <!-- Modal de enviar mensaje alumno -->
    <?php include 'modales/enviarMensajeModal.php'; ?>

    <!-- Alerta de Bootstrap para mostrar mensajes -->
    <div class="alert alert-success alert-dismissible fade show" id="successAlert" role="alert" style="display: none;">¡Persona añadida exitosamente!
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
    <!-- Script de añadir alumno -->
    <script src="js/añadirAlumnoModalScript.js"></script>
    <!-- Script de editar alumno -->
    <script src="js/editarAlumnoModalScript.js"></script>
    <!-- Script de eliminar alumno -->
    <script src="js/eliminarAlumnoModalScript.js"></script>
    <!-- Script de eliminar alumno -->
    <script src="js/mensajeAlumnoModalScript.js"></script>
    
    <!-- Exportacion a excell -->
    <script>
        $(document).ready(function() {
            $('#exportExcelBtn').click(function() {
                var wb = XLSX.utils.table_to_book(document.querySelector('.table'));
                XLSX.writeFile(wb, 'alumnos.xlsx');
            });
        });
        </script>
</body>
</html>
