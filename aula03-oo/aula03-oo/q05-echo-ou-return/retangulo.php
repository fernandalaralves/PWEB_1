<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public string $nome = '';
    public float $largura = 0.0;
    public float $altura = 0.0;

    public function area(): float
    {
        return $this->largura * $this->altura;
    }

    public function perimetro(): float
    {
        return 2 * ($this->largura + $this->altura);
    }
    public function ehQuadrado(): bool
    {
        return $this->largura === $this->altura;
    }
}

$sala = new Retangulo();
$sala->largura = 8;
$sala->altura = 6;
echo "Área: " . $sala->area() . "\n";
echo "Perímetro: " . $sala->perimetro() . "\n";

$lab = new Retangulo();
$lab->nome = 'Laboratório';
$lab->largura = 7;
$lab->altura = 7;

$bib = new Retangulo();
$bib->nome = 'Biblioteca';
$bib->largura = 12;
$bib->altura = 9;

$ambientes = [$sala, $lab, $bib];

$areaTotal = 0.0;
foreach ($ambientes as $ambiente) {
    $tipo = $ambiente->ehQuadrado() ? 'quadrado' : 'retângulo';
    $area = $ambiente->area();
    $areaTotal += $area;
    echo "{$ambiente->nome}: {$area} m2 ({$tipo})\n";
}

echo "Área total: {$areaTotal} m2\n";
echo "Rodapé necessário na biblioteca: {$bib->perimetro()} m\n";
