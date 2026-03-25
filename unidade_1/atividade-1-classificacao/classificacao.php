<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Classificação Acadêmica</title>
</head>

<body>

<h2>Classificação Acadêmica</h2>

<form method="POST">

    Digite a nota:

    <input type="text" name="nota" required>

    <br><br>

    <input type="submit" value="Verificar">

</form>

<?php

function classificar($nota) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nota = $_POST["nota"];

    if (is_numeric($nota)) {

        $situacao = classificar($nota);

        echo "<h3>Resultado:</h3>";

        echo "Nota: $nota <br>";

        echo "Situação: $situacao <br><br>";

        echo "Notas de 0 até $nota:<br>";

        for ($i = 0; $i <= $nota; $i++) {

            echo $i . " ";

        }

    } 
    else {

        echo "Digite um número válido.";

    }

  }
}
?>

</body>
</html>