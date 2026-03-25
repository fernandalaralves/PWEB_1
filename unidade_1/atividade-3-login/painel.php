<?php
session_start();


if (!isset($_SESSION["usuario"])) {

    header("Location: login.php");
    exit();

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Painel</title>
</head>

<body>

<h2>Painel Restrito</h2>

<p>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</p>

<br>

<a href="logout.php">Logout</a>

</body>
</html>