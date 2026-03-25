<?php

if (isset($_POST["nome"])) {

    $nome = $_POST["nome"];

    setcookie("usuario", $nome, time() + (7 * 24 * 60 * 60));

    header("Location: cookies.php");

    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Controle com Cookies</title>
</head>

<body>

<h2>Sistema com Cookies</h2>

<?php

if (isset($_COOKIE["usuario"])) {

    $nome = $_COOKIE["usuario"];

    echo "<h3>Bem-vindo novamente, $nome!</h3>";

    echo "<p>Seu nome foi salvo por 7 dias.</p>";

}

else {

?>

<form method="POST">

Digite seu nome:<br>
<input type="text" name="nome"><br><br>

<input type="submit" value="Salvar Nome">

</form>

<?php

}

?>

</body>
</html>