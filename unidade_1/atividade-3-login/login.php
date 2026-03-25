<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>

<h2>Login do Sistema</h2>

<form method="POST">

Usuário:<br>
<input type="text" name="usuario"><br><br>

Senha:<br>
<input type="password" name="senha"><br><br>

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
    }

    else {

        echo "<p>Usuário ou senha incorretos!</p>";

    }

}

?>

</body>
</html>