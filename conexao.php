<?php
// Definir as credenciais de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sonodahelp"; // Nome do banco de dados

// Criar a conexão com o banco de dados
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
} else {
    echo "";
}
?>
