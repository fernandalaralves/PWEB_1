<?php
session_start();

if (!isset($_SESSION["usuario"])) {

    header("Location: login.php");
    exit();

}

if (!isset($_SESSION["cadastros"])) {

    $_SESSION["cadastros"] = array();

}

function validarDados($nome, $email) {

    if (empty($nome) || empty($email)) {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if (validarDados($nome, $email)) {

        $_SESSION["cadastros"][] = array(
            "nome" => $nome,
            "email" => $email
        );

    } else {

        $erro = "Preencha todos os campos!";

    }

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Painel</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Painel de Cadastro</h2>

<p>Bem-vindo, <?php echo $_SESSION["usuario"]; ?></p>

<form method="POST">

Nome:
<input type="text" name="nome">

Email:
<input type="text" name="email">

<input type="submit" value="Cadastrar">

</form>

<?php

if (isset($erro)) {

    echo "<p>$erro</p>";

}


if (!empty($_SESSION["cadastros"])) {

    echo "<table>";

    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Email</th>";
    echo "</tr>";

    foreach ($_SESSION["cadastros"] as $cadastro) {

        echo "<tr>";

        echo "<td>" . $cadastro["nome"] . "</td>";

        echo "<td>" . $cadastro["email"] . "</td>";

        echo "</tr>";

    }

    echo "</table>";

}

?>

<a class="logout" href="logout.php">Logout</a>

</div>

</body>
</html>