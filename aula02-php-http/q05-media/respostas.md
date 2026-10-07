# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, que você vai modificar no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

- `const MEDIA_APROVACAO = 7;` define uma constante que representa a nota mínima de aprovação.
- `($n1 + $n2) / 2` usa parênteses para garantir que a soma seja calculada antes da divisão.
- `$media >= MEDIA_APROVACAO ? "Aprovado" : "Em recuperação"` é o operador ternário. Se a condição for verdadeira, escolhe `Aprovado`; caso contrário, escolhe `Em recuperação`.

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

Trecho alterado:

```php
<?php
$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
$media = ($n1 + $n2) / 2;
```

Explicação:

- `$_GET['n1']` pega o valor enviado na URL.
- `?? 0` garante que, se a nota não vier, o PHP usará 0.
- `(float)` converte o valor para número decimal.
- Em seguida, calcula a média com a regra de negócio da disciplina.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

```text
Notas: 5 e 6
Média: 5.5
Situação: Em recuperação
```

**Explicação linha por linha:**

- `Notas: 5 e 6`: as notas foram recebidas pela URL.
- `Média: 5.5`: o cálculo da média foi feito corretamente.
- `Situação: Em recuperação`: como 5.5 é menor que 7, a situação foi `Em recuperação`.

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

```text
Notas: 9 e 0
Média: 4.5
Situação: Em recuperação
```

**Explicação linha por linha:**

- `Notas: 9 e 0`: a segunda nota não foi enviada, então foi assumido 0.
- `Média: 4.5`: o cálculo usou 9 e 0.
- `Situação: Em recuperação`: a média ficou abaixo da aprovação.

**2.3 Log do servidor das duas requisições acima**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q05-media/media.php?n1=5&n2=6
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q05-media/media.php?n1=9
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- `Accepted`: a conexão foi aceita.
- `[200]: GET ...`: o servidor respondeu com sucesso para cada requisição.
- `?n1=5&n2=6` e `?n1=9`: a query string aparece no log e mostra os valores enviados pela URL.
- `Closing`: cada uma das conexões foi fechada.

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

Os valores aparecem na parte da URL depois do `?`, chamada de query string. Nesse caso, os parâmetros são `n1` e `n2`.

Exemplo:

```text
/q05-media/media.php?n1=5&n2=6
```

A parte `?n1=5&n2=6` é a query string.

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

O código usou `0` como valor padrão para a nota que não veio.

O operador responsável foi `??`, que significa “se o valor não existir, use este valor padrão”.

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

O PHP tenta converter `abc` para número. Como isso não é possível, o valor vira `0` na conversão. Então a média será calculada com `0` e `10`.

O `(float)` força a conversão para número decimal, garantindo que a operação matemária seja feita corretamente. Se a conversão não for possível, o valor se torna 0.
