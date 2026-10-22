<?php

declare(strict_types=1);

// Questão 07 - a conta da aula (exemplo 05). Encapsule.
// O saldo é público apenas para fins didáticos nesta aula.
class ContaBancaria
{
    private array $extrato = [];
    private float $saldo = 0.0;

    public function __construct(
        private string $titular,
        private string $numero
    ) {}

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('Depósito inválido.');
        }
        $this->saldo += $valor;
        $this->registrar('Depósito', $valor);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('Saque inválido.');
        }
        if ($valor > $this->saldo) {
            throw new Exception('Saldo insuficiente.');
        }
        $this->saldo -= $valor;
        $this->registrar('Saque', $valor);
    }

    private function registrar(string $operacao, float $valor): void
    {
        $this->extrato[] = ['operacao' => $operacao, 'valor' => $valor];
    }

    public function getExtrato(): array
    {
        return $this->extrato;
    }
}

$conta = new ContaBancaria('João', '12345');
$conta->depositar(1000);
$conta->sacar(250);