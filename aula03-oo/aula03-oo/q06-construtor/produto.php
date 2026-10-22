<?php

declare(strict_types=1);

// Questão 06 - o Produto da aula (exemplo 04). Acrescente um construtor.
class Produto
{
    public string $nome;
    public float $preco;
    public int $quantidade;

    public function calcularTotal(): float
    {
        return $this->preco * $this->quantidade;
    }

    public function aplicarDesconto(float $percentual): void
    {
        if ($percentual < 0 || $percentual > 100) {
            echo "Percentual de desconto inválido.\n";
            return;
        }

        $this->preco -= $this->preco * ($percentual / 100);
    }

    public function apresentar(): void
    {
        echo "Produto: {$this->nome}\n";
        echo 'Preço unitário: R$ ' . number_format($this->preco, 2, ',', '.') . "\n";
        echo "Quantidade: {$this->quantidade}\n";
    }
}

$notebook = new Produto('Notebook', 3500.00, 3);
$mouse    = new Produto('Mouse', 59.90, 10);
$monitor  = new Produto('Monitor', 899.00);

$produtos = [$notebook, $mouse, $monitor];

$totalPedido = 0.0;
foreach ($produtos as $p) {
    $p->apresentar();
    $total = $p->calcularTotal();
    echo 'Total: R$ ' . number_format($total, 2, ',', '.') . "\n\n";
    $totalPedido += $total;
}

echo 'Total do pedido: R$ ' . number_format($totalPedido, 2, ',', '.') . "\n";