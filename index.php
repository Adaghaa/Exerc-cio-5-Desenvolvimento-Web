<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Página Inicial</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
 	<body>
		<h1>Agenda de Contatos</h1>

		<br>

		<?php
		require "conexao.php";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$telefone = $_POST["telefone"];

		//só uma verificaçãozinha pra não quebrar tudo...
			$sql = "SELECT * FROM contatos WHERE email = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				echo "Email já cadastrado :)";
			} else {
				$sql = "INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("sss", $nome, $email, $telefone);
				$stmt->execute();
				$stmt->close();
			}
		}
		?>

		<h2> Cadastrar Contato:</h2>
		<br>
		<form method="POST" action="index.php">
			<div>
				<label>Nome:</label>
				<input type="text" name="nome" required>
			</div>
			<div>
				<label>Email:</label>
				<input type="email" name="email" required>
			</div>
			<div>
				<label>Telefone:</label>
				<input type="text" name="telefone">
			</div>
			<button type="submit">Salvar</button>
		</form>
		<a href="editar.php">
			<button class = "editar">Editar Dados</button>
		</a>

		<div class = "lista">
		<h2> Contatos Adicionados: </h2>
		
		<ul>
			<?php
			$sql = "SELECT * FROM contatos ORDER BY id DESC";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "Nome: " . $row["nome"] . "<br>";
					echo "Email: " . $row["email"] . "<br>";
					echo "Telefone: " . $row["telefone"] . "<br><br>";
				}
			} else {
				echo "<li>Nenhum contato encontrado.</li>";
			}

			$conn->close();
			?>
		</ul>
		</div>
		</div>
	</body>
</html>