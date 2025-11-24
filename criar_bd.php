<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("erro: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS agenda_contatos";
	if ($conn->query($sql) === TRUE) {
		echo "Banco de dados criado";
	} else {
		echo "Erro : " . $conn->error;
	}

$conn->select_db("agenda_contatos");

$sql = "CREATE TABLE IF NOT EXISTS contatos (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(150) NOT NULL UNIQUE,
	telefone VARCHAR(20)
)";

if ($conn->query($sql) === TRUE) {
	echo "Tabela criada";
	} else {
	echo "Erro: " . $conn->error;
	}
$conn->close();
?>