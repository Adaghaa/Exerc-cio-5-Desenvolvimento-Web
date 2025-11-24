<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Editar Contato</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
 	<body>
		<h1>Editar Dados de Contato</h1>

		<form method="post" action="">
			<label for = "email" > Digite o email do contato:</label>
			<input type="email" name="email" id="email" required>
			<button type="submit" name="buscar">Buscar</button>
		</form>

		<?php
		require "conexao.php";
			if (isset($_POST['buscar'])) {
				$email = $_POST['email'];
				$sql = "SELECT * FROM contatos WHERE email='$email'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();

					echo "
					<div class='item'>
					<h3>Contato:</h3>
					<p>Nome: {$row['nome']}</p>
					<p>Email: {$row['email']}</p>
					<p>Telefone: {$row['telefone']}</p>

					<form method= 'post' action=''>
						<input type='hidden' name='email' value='{$row['email']}'>
						<button type='submit' name='acao' value='editar_nome'>Editar Nome</button>
						<button type='submit' name='acao' value='editar_telefone'>Editar Telefone</button	>
						<button type='submit' name='acao' value='deletar'>Deletar Contato</button>
					</form>
					</div>";
				} else {
					echo "<p> Nenhum contato encontrado :(</p>";
				}}
		?>
		<a href="index.php">
			<button class = "index">Voltar</button>
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

			
			?>
		</ul>
		</div>

		<?php
			if(isset($_POST['acao'])) {
				$acao = $_POST['acao'];
				$email = $_POST['email'];
				if ($acao == 'editar_nome') {
					echo "<form method='post' action=''>
					<input type='hidden' name='email' value='$email'>
					<label>Digite o novo nome:</label>
					<input type='text' name='novo_nome' required>
					<button type='submit' name='salvar_nome'>Salvar</button>
					</form>";
				}
				if ($acao == 'editar_telefone') {
					echo "<form method='post' action=''>
					<input type='hidden' name='email' value='$email'>
					<label>Digite o novo telefone:</label>
					<input type='text' name='novo_telefone' required>
					<button type='submit' name='salvar_telefone'>Salvar</button>
					</form>";
				}
				if ($acao == 'deletar') {
					$sql = "DELETE FROM contatos WHERE email='$email'";
					if ($conn->query($sql) === TRUE) {
						echo "O contato foi deletado :)";
					} else {
						echo "Erro ao tentar deletar contato :(";
					}
			}}
			if (isset($_POST['salvar_nome'])) {
				$novo_nome = $_POST['novo_nome'];
				$email=$_POST['email'];
				$sql = "UPDATE contatos SET nome='$novo_nome' WHERE email='$email'";
				if ($conn->query($sql) === TRUE) {
					echo "Nome atualizado :)";
				} else {
					echo "Nome não atualizado :( " . $conn->error;
				}
			}
			if (isset($_POST['salvar_telefone'])) {
				$novo_tel = $_POST['novo_telefone'];
				$email = $_POST['email'];
				$sql = "UPDATE contatos SET telefone = '$novo_tel' WHERE email='$email'";
				if ($conn->query($sql) === TRUE) {
					echo "Telefone atualizado :)";
				} else {
					echo"Telefone não atualizado :( " . $conn->error;
				}
			}
		$conn->close(); 

		?>

		
</body>
</html>

