<?php

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'votaciones_sistema');

// Función para obtener la conexión a la base de datos
function getDBConnection()
{
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
    return $mysqli;
}

// Función para ejecutar consultas
function dbQuery($sql)
{
    $mysqli = getDBConnection();
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    return $result;
}

// Función para insertar datos y obtener el ID insertado
function dbQuery_insert($sql)
{
    $mysqli = getDBConnection();
    mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    $lastInsertId = mysqli_insert_id($mysqli);
    mysqli_close($mysqli);
    return $lastInsertId;
}

// Función para obtener datos asociativos de un resultado
function dbFetchAssoc($result)
{
    return mysqli_fetch_assoc($result);
}

// Función para obtener el número de filas de un resultado
function dbNumRows($result)
{
    return mysqli_num_rows($result);
}

// Función para obtener el número de filas afectadas
function dbAffectedRows()
{
    $mysqli = getDBConnection();
    $affectedRows = mysqli_affected_rows($mysqli);
    mysqli_close($mysqli);
    return $affectedRows;
}

// Función para ejecutar consultas preparadas
function dbQueryPreparada($sql, $params = [])
{
    $mysqli = getDBConnection();
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error);
    }

    if ($params) {
        $tipos = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $tipos .= 'i';
            } elseif (is_float($param)) {
                $tipos .= 'd';
            } elseif (is_string($param)) {
                $tipos .= 's';
            } else {
                $tipos .= 'b';
            }
        }

        $stmt->bind_param($tipos, ...$params);
    }

    // Ejecutamos la consulta
    $stmt->execute();

    // Obtenemos el resultado
    $result = $stmt->get_result();

    // Cerramos la consulta y la conexión
    $stmt->close();
    $mysqli->close();

    return $result;
}