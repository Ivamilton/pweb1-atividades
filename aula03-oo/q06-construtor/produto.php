<?php

declare(strict_types=1);

// Questão 06 - o Produto da aula (exemplo 04). Acrescente um construtor.
class Produto
{
    public string $nome;
    public float $preco;
    public int $quantidade;

    public function __construct(string $nome, float $preco, int $quantidade = 1)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

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

$produtos = [
    new Produto('Notebook', 3500.00, 3),
    new Produto('Mouse', 59.90, 10),
    new Produto('Monitor', 899.00),
];

$totalPedido = 0;
foreach ($produtos as $produto) {
    $produto->apresentar();
    $total = $produto->calcularTotal();
    $totalPedido += $total;
    echo 'Total: R$ ' . number_format($total, 2, ',', '.') . "\n\n";
}

echo 'Total do pedido: R$ ' . number_format($totalPedido, 2, ',', '.') . "\n";
