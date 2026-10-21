<?php

declare(strict_types=1);

// Questão 02 - este arquivo tem QUATRO erros. Corrija um de cada vez.
class Aluno
{
    public string $nome;
    public int $semestre;
    public string $curso;

    public function apresentar(): void
    {
      //  echo "Sou $nome, do {$this->semestre}º semestre.\n";
          echo "Sou {$aluno->nome}, do º {$aluno->semestre}, do curso{$aluno->curso} \n";
    }
}

$aluno = new Aluno();
$aluno->$nome = 'Carla';
$aluno->semestre = '3';
//echo "Curso: {$aluno->curso}\n";
$aluno->apresentar();
