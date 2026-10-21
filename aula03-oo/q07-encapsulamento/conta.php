<?php

declare(strict_types=1);

// Questão 07 - a conta da aula (exemplo 05). Encapsule.
class ContaBancaria
{
    private string $titular;
    private string $numero;
    private float $saldo = 0.0;
    private array $extrato = [];

    public function __construct(string $titular, string $numero)
    {
        $this->titular = $titular;
        $this->numero = $numero;
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

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getExtrato(): array
    {
        return $this->extrato;
    }

    public function apresentarDados(): void
    {
        echo "Titular: {$this->getTitular()}\n";
        echo "Conta: {$this->numero}\n";
        echo 'Saldo: R$ ' . number_format($this->getSaldo(), 2, ',', '.') . "\n";
    }
}

$conta = new ContaBancaria('João', '12345');
$conta->depositar(1000);
$conta->sacar(250);

try {
    $conta->sacar(5000);
} catch (Exception $e) {
    echo "Recusado: {$e->getMessage()}\n";
}
try {
    $conta->depositar(-10);
} catch (Exception $e) {
    echo "Recusado: {$e->getMessage()}\n";
}
echo "Extrato de {$conta->getTitular()}:\n";
foreach ($conta->getExtrato() as $item) {
    echo '- ' . $item['operacao'] . ': R$ ' .
        number_format($item['valor'], 2, ',', '.') . "\n";
}
echo 'Saldo final: R$ ' . number_format($conta->getSaldo(), 2, ',', '.') . "\n";
