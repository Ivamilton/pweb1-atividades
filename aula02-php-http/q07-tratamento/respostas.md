# Questão 07: O dado pode não vir, o dado pode ser perigoso

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `saudacao.php` | Código fornecido, que você vai corrigir no item 1.2 |

## 1. Análise do código

**1.1 Quais são os dois problemas deste código?**

O código original:

```php
<?php
$nome = $_GET['nome'];
echo "Olá, " . $nome;
```

Problemas:

1. Se o parâmetro `nome` não vier, o valor de `$_GET['nome']` é `null`, e o código pode gerar uma saída vazia ou quebrar a lógica da página.
2. Se o usuário mandar HTML ou script no valor do nome, essa entrada será impressa diretamente no HTML e poderá executar código malicioso no navegador.

**1.2 Corrija o código usando `??` (valor padrão "Visitante") e `htmlspecialchars`. Faça um commit **antes** e outro **depois** da correção. Cole o código corrigido e explique.**

Código corrigido:

```php
<?php
$nome = $_GET['nome'] ?? 'Visitante';
echo "Olá, " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
```

Explicação:

- `?? 'Visitante'` define um valor padrão caso o parâmetro não esteja presente.
- `htmlspecialchars` converte `<`, `>`, `"` e `'` em entidades HTML, impedindo que o navegador interprete como código.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Antes da correção: log do servidor ao abrir `saudacao.php` sem parâmetro**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q07-tratamento/saudacao.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 PHP Notice: Undefined index: nome in /.../saudacao.php on line 2
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- `Accepted`: a requisição foi aceita.
- `[200]`: o servidor respondeu mesmo com o problema, porque o código chegou a rodar.
- `PHP Notice: Undefined index: nome`: o campo `nome` não foi enviado e o PHP avisou que ele não existe.
- `Closing`: a conexão foi encerrada.

**2.2 Antes da correção: saída de `curl.exe -s "http://localhost:8000/q07-tratamento/saudacao.php?nome=<b>Oi</b>"`**

```text
Olá, Oi
```

**Explicação linha por linha:**

- O navegador recebe `<b>Oi</b>` e interpreta como HTML, então a frase aparece em negrito.
- O valor do usuário foi tratado como código HTML, o que é perigoso.

**2.3 Depois da correção: saída do mesmo comando do item 2.2**

```text
Olá, &lt;b&gt;Oi&lt;/b&gt;
```

**Explicação linha por linha:**

- `&lt;` significa `<` em HTML, e `&gt;` significa `>`.
- O navegador mostra os caracteres como texto, não como tag HTML.
- A saída foi escapada corretamente.

## 3. Perguntas

**3.1 Qual aviso apareceu no item 2.1? O que ele significa?**

O aviso foi:

```text
PHP Notice: Undefined index: nome
```

Isso significa que o código tentou acessar `$_GET['nome']`, mas esse índice não estava presente na query string. O PHP alertou que o dado não existe.

**3.2 Compare o corpo da resposta em 2.2 e 2.3. O que o `htmlspecialchars` fez com `<b>`?**

No item 2.2, o texto foi interpretado como HTML e apareceu em negrito.

No item 2.3, o valor foi escapado para:

```text
&lt;b&gt;Oi&lt;/b&gt;
```

Ou seja, o `htmlspecialchars` transformou os caracteres especiais em entidades HTML, para que o navegador os imprima como texto e não execute a tag.

**3.3 Teste no navegador `?nome=<script>alert('Ataque')</script>` antes e depois da correção. Explique o que aconteceu e por que isso é perigoso (XSS).**

Antes da correção, o script era injetado no HTML e o navegador poderia executá-lo. Isso cria um ataque de XSS (Cross-Site Scripting).

Depois da correção, o script é exibido como texto, porque o HTML é escapado e não executado. Isso impede que o usuário malicioso injete JavaScript na página.

XSS é perigoso porque o atacante consegue executar código no navegador da vítima, roubar cookies, interceptar ações e causar comportamento indesejado em páginas da aplicação.
