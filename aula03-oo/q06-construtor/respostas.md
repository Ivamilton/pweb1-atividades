# Questão 06: Construtor

## 1. Análise
```php
public function __construct(string $nome, float $preco, int $quantidade = 1)
{
    $this->nome = $nome;
    $this->preco = $preco;
    $this->quantidade = $quantidade;
}
```
O construtor inicializa o objeto. `= 1` torna a quantidade opcional e usa uma unidade quando omitida.

## 2. Saídas
```text
Produto: Notebook
Preço unitário: R$ 3.500,00
Quantidade: 3
Total: R$ 10.500,00
Produto: Mouse
Preço unitário: R$ 59,90
Quantidade: 10
Total: R$ 599,00
Produto: Monitor
Preço unitário: R$ 899,00
Quantidade: 1
Total: R$ 899,00
Total do pedido: R$ 11.998,00
```

`new Produto('Teclado')` dá `ArgumentCountError` por faltar preço; `'cem reais'` dá `TypeError` no parâmetro float; `new Produto()` dá `ArgumentCountError` por faltar nome e preço. A mensagem diz "at least 2" porque quantidade tem padrão. `new` devolve o objeto e `__construct` apenas o inicializa. A versão anterior permitia objeto sem dados obrigatórios.
