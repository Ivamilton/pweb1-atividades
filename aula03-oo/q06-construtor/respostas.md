# Quest?o 06: Construtor

## 1. An?lise
```php
public function __construct(string $nome, float $preco, int $quantidade = 1)
{
    $this->nome = $nome;
    $this->preco = $preco;
    $this->quantidade = $quantidade;
}
```
O construtor inicializa o objeto. `= 1` torna a quantidade opcional e usa uma unidade quando omitida.

## 2. Sa?das
```text
Produto: Notebook
Pre?o unit?rio: R$ 3.500,00
Quantidade: 3
Total: R$ 10.500,00
Produto: Mouse
Pre?o unit?rio: R$ 59,90
Quantidade: 10
Total: R$ 599,00
Produto: Monitor
Pre?o unit?rio: R$ 899,00
Quantidade: 1
Total: R$ 899,00
Total do pedido: R$ 11.998,00
```

`new Produto('Teclado')` d? `ArgumentCountError` por faltar pre?o; `'cem reais'` d? `TypeError` no par?metro float; `new Produto()` d? `ArgumentCountError` por faltar nome e pre?o. A mensagem diz ?at least 2? porque quantidade tem padr?o. `new` devolve o objeto e `__construct` apenas o inicializa. A vers?o anterior permitia objeto sem dados obrigat?rios.
