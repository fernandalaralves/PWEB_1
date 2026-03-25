<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Login</h2>

<form method="POST">

Usuário:
<input type="text" name="usuario">

Senha:
<input type="password" name="senha">

<input type="submit" value="Entrar">

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if ($usuario == "admin" && $senha == "1234") {

        $_SESSION["usuario"] = $usuario;

        header("Location: painel.php");

        exit();

    } else {

        echo "<p>Usuário ou senha incorretos!</p>";

    }

}

?>

</div>

</body>
</html>