<?php
    $hostname = "localhost";
    $bd = "verde_agro_negocio";
    $usuario = "verde_agro_negocio";
    $senha = "qwe123";

    $conn = new mysqli($hostname, $usuario, $senha, $bd);
    
    if ($conn->connect_errno){
        echo "Falha ao conectar: " . $conn->connect_errno . ") " . $conn->connect_error;
    }
?>