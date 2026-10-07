# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrija no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

O erro está na linha:

```php
$curso = "ADS"
```

Falta um ponto e vírgula no final da linha. O PHP entende que a instrução não terminou corretamente e acusa erro de sintaxe.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [500]: GET /q02-erros/erro.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 PHP Parse error: syntax error, unexpected end of file, expecting ";" in /caminho/erro.php on line 3
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- `Accepted`: a conexão foi aceita.
- `[500]: GET /q02-erros/erro.php`: a requisição foi atendida, mas o servidor encontrou um erro grave ao processar o script.
- `PHP Parse error: ... on line 3`: o PHP informa que houve um erro de sintaxe e aponta a linha em que o parser concluiu que o código estava incompleto.
- `Closing`: a conexão foi finalizada.

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [500]: GET /q02-erros/erro.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- O erro continua existindo, mas ele não é exibido na página do navegador.
- O servidor registra a requisição, mas as mensagens detalhadas do PHP ficam ocultas para o cliente.
- O status continua sendo 500 porque a execução falhou.

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

A mensagem aponta uma linha de fechamento do bloco ou da instrução, geralmente a próxima linha após o ponto em que o parser percebeu que a instrução não foi concluída. Isso acontece porque o PHP só consegue descobrir que o comando estava incompleto quando tenta interpretar o que vem depois.

Em outras palavras, o erro não é “na linha do ponto e vírgula faltando” literalmente, mas na linha em que o parser reconhece a sequência inválida do código.

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

- `[200]` significa sucesso na requisição.
- `[500]` significa erro interno do servidor.

Quando o PHP encontra um erro de parse, a página não consegue ser renderizada corretamente; então o servidor responde com 500 Internal Server Error. Esse é o correto do ponto de vista do HTTP para um erro interno do servidor.

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

Código corrigido:

```php
<?php
$curso = "ADS";
echo "Bem-vindo ao curso de $curso";
```

Log após a correção:

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q02-erros/erro.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

Agora a página é processada corretamente e o status volta a ser 200, indicando sucesso.
