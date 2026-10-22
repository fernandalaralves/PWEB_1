<?php
declare(strict_types=1);

class Aluno
{
    public string $nome;
    public int $semestre;
    public string $curso;

    public function apresentar(): void
    {
        echo "Sou {$this->nome}, do {$this->semestre}º semestre.\n";
    }
}

$aluno = new Aluno();
$aluno->nome = 'Carla';
$aluno->semestre = 3;
$aluno->curso = 'ADS';

echo "Curso: {$aluno->curso}\n";
$aluno->apresentar();
