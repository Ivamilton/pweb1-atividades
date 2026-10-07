# Questão 03: Variáveis, aspas e concatenação

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aspas.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 Antes de executar, preencha a coluna "Minha previsão" com o que cada linha vai mostrar.**

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"Aluna: " . $nome` | `Aluna: Maria` | `Aluna: Maria` |
| `"Aluna: $nome"` | `Aluna: Maria` | `Aluna: Maria` |
| `'Aluna: $nome'` | `Aluna: $nome` | `Aluna: $nome` |
| `"Cursa o {$semestre}º semestre de $curso"` | `Cursa o 2º semestre de ADS` | `Cursa o 2º semestre de ADS` |
| `$nome . $curso` | `MariaADS` | `MariaADS` |
| `<?= $nome ?>` | `Maria` | `Maria` |

**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

As chaves delimitam a expressão da variável dentro de uma string interpolada. Elas servem para deixar explícito que o conteúdo da variável é o valor de `$semestre`, evitando ambiguidade em textos como `{$semestre}º semestre`.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

```text
<p>Aluna: Maria</p>
<p>Aluna: Maria</p>
<p>Aluna: $nome</p>
<p>Cursa o 2º semestre de ADS</p>
<p>MariaADS</p>
<p>Atalho: Maria</p>
```

**Explicação linha por linha:**

- `Aluna: Maria`: concatenação com ponto e também interpolação com aspas duplas resultam na mesma saída.
- `Aluna: $nome`: em aspas simples, `$nome` é tratado como texto literal e não como variável.
- `Cursa o 2º semestre de ADS`: a variável `$semestre` foi interpolada e a string recebeu o grau do semestre.
- `MariaADS`: como não houve espaço, a concatenação juntou diretamente os valores.
- `Atalho: Maria`: o atalho `<?= $nome ?>` imprime a variável da mesma maneira que `<?php echo $nome; ?>`.

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

A previsão só erra na linha com aspas simples, porque em PHP as strings entre aspas simples não interpolam variáveis. Isso significa que o valor literal `$nome` aparece em vez do conteúdo da variável.

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Porque o operador `.` apenas concatena textos, sem inserir espaço algum. Então `Maria` e `ADS` ficam juntados como `MariaADS`.

Para corrigir, basta incluir um espaço manualmente:

```php
<?php echo $nome . " " . $curso; ?>
```

ou

```php
<?php echo "$nome $curso"; ?>
```
