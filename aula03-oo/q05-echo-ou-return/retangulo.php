<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public string $nome;
    public float $largura;
    public float $altura;

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

$ambientes = [];

$sala = new Retangulo();
$sala->nome = 'Sala de aula';
$sala->largura = 8;
$sala->altura = 6;
$ambientes[] = $sala;

$laboratorio = new Retangulo();
$laboratorio->nome = 'Laboratório';
$laboratorio->largura = 7;
$laboratorio->altura = 7;
$ambientes[] = $laboratorio;

$biblioteca = new Retangulo();
$biblioteca->nome = 'Biblioteca';
$biblioteca->largura = 12;
$biblioteca->altura = 9;
$ambientes[] = $biblioteca;

$areaTotal = 0;
foreach ($ambientes as $ambiente) {
    $area = $ambiente->area();
    $areaTotal += $area;
    $tipo = $ambiente->ehQuadrado() ? 'quadrado' : 'retângulo';
    echo "{$ambiente->nome}: {$area} m² ({$tipo})\n";
}

echo "Área total: {$areaTotal} m²\n";
echo "Rodapé necessário na biblioteca: {$biblioteca->perimetro()} m\n";
