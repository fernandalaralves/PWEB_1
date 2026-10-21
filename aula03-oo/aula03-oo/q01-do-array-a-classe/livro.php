<?php
declare(strict_types=1);

class Livro
{
    public string $nome;
    public string $autor;
    public int $ano;
    public float $preco;
    public bool $disponivel;
}

$livro1 = new Livro();
$livro1->nome = 'Vidas Secas';
$livro1->autor = 'Graciliano Ramos';
$livro1->ano = 1938;
$livro1->preco = 39.90;
$livro1->disponivel = true;

$livro2 = new Livro();
$livro2->nome = 'Dracula';
$livro2->autor = 'Bram Stocker';
$livro2->ano = 1897;
$livro2->preco = 40.90;
$livro2->disponivel = true;

echo "Livro 1: {$livro1->nome}, {$livro1->autor}, {$livro1->ano}, {$livro->preco}, {$livro->disponivel}"