<?php
function Converter($codigo)
{
	if ($codigo == '') {
		return "";
	} else {
		$frase = $codigo;
		$caracteres = str_split($frase);
		$final = array();
		$unocode = array();
		for ($i = 0; $i <= 1000; $i++) {
			$hexadecimal = dechex($i);
			$unocode[] = $hexadecimal;
		}
		foreach ($caracteres as $letras) {

			foreach ($unocode  as $char) {
				// echo bin2hex($letras).' '.$char.'<br>';
				if ($letras == ' ') {
					$final[] = '\u0020';
					break;
				} else if (bin2hex($letras) == $char) {
					if (strlen($char) == 2)
						$final[] = '\u00' . $char;
					if (strlen($char) == 3)
						$final[] = '\u0' . $char;
				}
			}
		}

		$finals = "'";
		foreach ($final as $bilo) {
			$finals .= $bilo;
		}
		$finals .= "'";
		return $finals;
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BresoDEV HTML Cripto</title>
</head>
<style>
	textarea,
	.button {
		width: 70%;
		border-radius: 5px;
		resize: none;
		padding: 5px;
		background-color: #666;
		color: aliceblue;
		border: none;
		margin-top: 10px;
	}

	html {
		background-color: #222;
		color: aliceblue;
	}

	hr {
		background-color: #666;
	}
</style>

<body>
	<center>

		<?php
		if (!isset($_POST['codigo'])) {
			echo '<p>Digite abaixo, seu codigo HTML para JavaScript:</p>
	<form action="criptoHTML.php" method="post">
		<textarea rows="10" id="codigo" name="codigo"></textarea><br>
		<button class="button" type="submit">Processar codigo</button><br>
	</form>
	<a href="chat.php">
			<button class="button">Voltar para o Chat</button>
			</a><br>
	';
		} else {
			echo "
	<hr>
<p>Criptografado:</p>";

			if (isset($_POST['codigo']))
				echo '<textarea rows="10"><script>document.write(' . Converter($_POST['codigo']) . ');</script></textarea>';
			else
				echo '';

			echo '<br><a href="criptoHTML.php">
			<button class="button">Processar um novo codigo</button>
			</a><br>
			<a href="chat.php">
			<button class="button">Voltar para o Chat</button>
			</a><br>';


			echo "
<hr>
<p>Original:</p>
";

			if (isset($_POST['codigo'])) {
				echo $_POST['codigo'];
			} else {
				echo '';
			}
			echo "
<hr>
<p>Criptografado:</p>
<script>
document.write(" . Converter($_POST['codigo']) . ");
</script>
";
		}
		?>







	</center>
</body>

</html>