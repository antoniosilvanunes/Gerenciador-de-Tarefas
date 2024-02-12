<?php
    $HOST = "localhost";
    $USER = "root";
    $PASS = "";
    $BASE = "sislogin";

    $conn = new MySQLi($HOST, $USER, $PASS, $BASE);

    // Isso serve para mostrar a mensagem caso a conexão não esteja funcionando no caso para saber neste código eu preciso digitar o seguinte caminho http://localhost/loginteste/config.php se a tela ficar branca a conexão está funcionando de maneira correta

    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }