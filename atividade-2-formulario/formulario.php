<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aluno</title>
</head>

<body>

<h2>Cadastro para Evento Acadêmico</h2>

<form method="POST">

    Nome:<br>
    <input type="text" name="nome"><br><br>

    E-mail:<br>
    <input type="text" name="email"><br><br>

    Curso:<br>
    <input type="text" name="curso"><br><br>

    Turno:<br>
    <input type="text" name="turno"><br><br>

    <input type="submit" value="Cadastrar">

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $curso = $_POST["curso"];
    $turno = $_POST["turno"];

    if (empty($nome) || empty($email) || empty($curso) || empty($turno)) {

        echo "<h3 style='color:red;'>Erro: Preencha todos os campos!</h3>";

    }

    else {

        echo "<h3>Cadastro realizado com sucesso!</h3>";

        echo "<h4>Dados informados:</h4>";

        echo "Nome: $nome <br>";
        echo "E-mail: $email <br>";
        echo "Curso: $curso <br>";
        echo "Turno: $turno <br>";

    }

}

?>

</body>
</html>