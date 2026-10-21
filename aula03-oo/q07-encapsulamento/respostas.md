# Questão 07: Encapsulamento

## 1. Análise
Todos os atributos são `private`; getters, construtor, depósito e saque são `public`; `registrar()` é `private` porque é regra interna. O extrato é atualizado apenas após operações válidas.

## 2. Saídas
A atribuição direta de saldo negativo na versão pública permitia saldo inválido. Na versão final:
```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.
Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00
```
As tentativas externas produzem `Cannot access private property` para `saldo` e `Call to private method` para `registrar()`.

## 3. Perguntas
Não existe `setSaldo()` porque ele permitiria alterar o saldo sem regras. `throw` interrompe a operação e permite tratamento com `try/catch`, ao contrário de apenas imprimir e retornar. O saque recusado não altera o saldo, que termina em R$ 750,00.
