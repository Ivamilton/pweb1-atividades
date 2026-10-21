# Quest?o 07: Encapsulamento

## 1. An?lise
Todos os atributos s?o `private`; getters, construtor, dep?sito e saque s?o `public`; `registrar()` ? `private` porque ? regra interna. O extrato ? atualizado apenas ap?s opera??es v?lidas.

## 2. Sa?das
A atribui??o direta de saldo negativo na vers?o p?blica permitia saldo inv?lido. Na vers?o final:
```text
Recusado: Saldo insuficiente.
Recusado: Dep?sito inv?lido.
Extrato de Jo?o:
- Dep?sito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00
```
As tentativas externas produzem `Cannot access private property` para `saldo` e `Call to private method` para `registrar()`.

## 3. Perguntas
N?o existe `setSaldo()` porque ele permitiria alterar o saldo sem regras. `throw` interrompe a opera??o e permite tratamento com `try/catch`, ao contr?rio de apenas imprimir e retornar. O saque recusado n?o altera o saldo, que termina em R$ 750,00.
