<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agenda_contatos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Erro na conexão: " . $conn->connect_error);
}
?>
