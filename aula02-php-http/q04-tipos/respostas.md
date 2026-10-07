# Questão 04: Tipos e conversões

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `tipos.php` | Código fornecido (no item 3.3 você vai acrescentar linhas) |

## 1. Análise do código

**1.1 Antes de executar, preencha a coluna "Minha previsão" com o tipo e o valor de cada linha.**

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"10" + 5` | `15` | `15` |
| `"10" . 5` | `"105"` | `"105"` |
| `7 / 2` | `3.5` | `3.5` |
| `7 % 2` | `1` | `1` |
| `(int) "3.9 kg"` | `3` | `3` |
| `(bool) "0"` | `false` | `false` |
| `(bool) "false"` | `true` | `true` |
| `0.1 + 0.2 == 0.3` | `false` | `false` |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q04-tipos/tipos.php`**

```text
int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
```

**Explicação linha por linha:**

- `int(15)`: a string `"10"` foi convertida para número e somada com `5`.
- `string(3) "105"`: o operador `.` concatena, então `"10"` e `5` formam texto.
- `float(3.5)`: a divisão entre inteiros em PHP produz float quando o resultado não é exato.
- `int(1)`: resto da divisão de 7 por 2.
- `int(3)`: conversão forçada para inteiro, truncando a parte decimal.
- `bool(false)`: a string `"0"` é considerada falsa.
- `bool(true)`: qualquer string não vazia é verdadeira, inclusive `"false"`.
- `bool(false)`: o resultado da comparação `0.1 + 0.2 == 0.3` é falso por causa da imprecisão de ponto flutuante.

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

- `"10" + 5` usa a operação matemática de soma. PHP converte a string para número e calcula `15`.
- `"10" . 5` usa concatenação de strings. PHP converte `5` para texto e junta, resultando `"105"`.

Em PHP, o operador `+` é aritmético e o operador `.` é de concatenação.

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

Porque em PHP o valor booleano de uma string depende se ela é vazia ou não. A string `"0"` é tratada como falsa, enquanto `"false"` é uma string com conteúdo e, portanto, verdadeira.

**3.3 Acrescente ao arquivo duas linhas `var_dump` criadas por você, com resultados que te surpreenderam ou que você achou interessantes. Explique cada uma.**

Exemplo:

```php
var_dump((int) "9.99");
var_dump("" == false);
```

Resultado:

```text
int(9)
bool(true)
```

- `(int) "9.99"` converte para inteiro truncando o valor decimal, então `9.99` vira `9`.
- `"" == false` é verdadeiro porque uma string vazia e o valor booleano falso são considerados equivalentes em PHP.

Essa parte mostra que o PHP faz coerções automaticamente e que isso pode gerar comportamentos inesperados se não for cuidado.
