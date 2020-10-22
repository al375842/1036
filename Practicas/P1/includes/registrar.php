<?php
include("./gestionBD.php");

function handler($pdo,$table)
{
    $datos = $_REQUEST;
    if (count($_REQUEST) < 3) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    // en la siguiente linea, añadir los nuevos atributos
    $query = "INSERT INTO     $table (name, surname, address, city, zip_code, foto_file)
                        VALUES (?,?,?,?,?,?)";
                       
    echo $query;
    try { 
        // metemos el if que está en pdopostgres0.php
        // para crear la variable global pdo
        if (!isset($pdo)) $pdo = new PDO("pgsql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
        $a=array($_REQUEST['name'], $_REQUEST['surname'],$_REQUEST['address'], $_REQUEST['city'], $_REQUEST['zip_code'], $_REQUEST['foto_file'] );
        print_r ($a);
        $consult = $pdo->prepare($query);
        // en la siguiente linea, añadimos los nuevos atributos
        $a=$consult->execute(array($_REQUEST['name'], $_REQUEST['surname'],$_REQUEST['address'],$_REQUEST['city'], $_REQUEST['zip_code'], $_REQUEST['foto_file']  ));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "a_cliente";
var_dump($_POST);
handler( $pdo,$table);
?>