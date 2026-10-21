<?php

declare(strict_types=1);

// Questão 03 - complete os três métodos
class Aluno
{
    public string $nome;
    public float $nota1;
    public float $nota2;

    // 1. calcularMedia(): float
    //    devolve a média das duas notas
    public function calcularMedia(): float
    {
        $this {$aluno->nota1} + {$aluno->nota2} /2;
    }

    // 2. situacao(): string
    //    usa $this->calcularMedia() e devolve:
    //    'Aprovado' (média >= 7), 'Recuperação' (média >= 4) ou 'Reprovado'
    public function situacao(): string
    {
        $this->calcularMedia(){
            if(calcularMedia >= 7){
                echo "Recuperação";
            }else if(
                calcularMedia >= 4{
                    echo "Reprovado"
                }
            )
        }
    }

    // 3. apresentar(): void
    //    imprime, por exemplo:  Ana: média 8,8 (Aprovado)
    //    dica: number_format($valor, 1, ',', '.')
}

$ana = new Aluno();
$ana->nome = 'Ana';
$ana->nota1 = 8.0;
$ana->nota2 = 9.5;

$bruno = new Aluno();
$bruno->nome = 'Bruno';
$bruno->nota1 = 5.0;
$bruno->nota2 = 6.0;

$caio = new Aluno();
$caio->nome = 'Caio';
$caio->nota1 = 2.5;
$caio->nota2 = 3.0;

$ana->apresentar();
$bruno->apresentar();
$caio->apresentar();
