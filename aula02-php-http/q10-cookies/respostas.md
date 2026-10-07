# Questão 10: Cookies e a ordem da resposta HTTP

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `contador.php` | Parte A: criado por você |
| `login.php` | Parte B: código fornecido com erro (corrija no item 1.2) |
| `dashboard.php` | Parte B: criado por você |
| `prints/cookies-application.png` | DevTools, aba Application > Cookies, mostrando o cookie do contador |

> O arquivo `cookies.txt` criado pelo curl **não** deve ser enviado ao GitHub (ele já está no `.gitignore`).

## 1. Análise do código

**1.1 Parte A: cole o código do `contador.php` e explique como ele lê e grava o cookie.**

Código:

```php
<?php
$visitas = (int) ($_COOKIE['visitas'] ?? 0) + 1;
setcookie('visitas', (string) $visitas, time() + 3600);
echo "Você visitou esta página $visitas vez(es)";
```

Explicação:

- `$_COOKIE['visitas']` lê o cookie `visitas` enviado pelo navegador.
- `?? 0` garante que, se o cookie não existir, o valor inicial seja 0.
- `+ 1` incrementa o contador.
- `setcookie` grava esse valor de volta no navegador com validade de 1 hora.
- `echo` mostra a mensagem final ao usuário.

**1.2 Parte B: cole o `login.php` corrigido e o `dashboard.php`, e explique a correção.**

Código corrigido de `login.php`:

```php
<?php
setcookie('usuario_logado', 'true', time() + 3600);
header('Location: dashboard.php');
exit;
```

Código de `dashboard.php`:

```php
<?php
$usuario = $_COOKIE['usuario_logado'] ?? 'não';
echo "Usuário logado: $usuario";
```

Explicação:

- Antes, o código fazia `echo` antes de `setcookie` e `header`, e isso gerava erro porque os cabeçalhos HTTP já haviam sido enviados.
- Agora, os cabeçalhos são definidos primeiro e o script termina com `exit`.
- `dashboard.php` lê o cookie e mostra se o usuário está logado.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Parte A: saída de `curl.exe -i http://localhost:8000/q10-cookies/contador.php`**

```text
HTTP/1.1 200 OK
Set-Cookie: visitas=1; expires=Wed, 07 Oct 2026 16:00:00 GMT; path=/
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es)
```

**Explicação linha por linha:**

- `Set-Cookie: visitas=1...`: cabeçalho que grava o cookie no navegador.
- `Content-type: text/html; charset=UTF-8`: informa que o corpo é HTML.
- `Você visitou esta página 1 vez(es)`: saída da página.

**2.2 Parte A: saída de `curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php`, executado três vezes (cole a terceira)**

```text
HTTP/1.1 200 OK
Set-Cookie: visitas=3; expires=Wed, 07 Oct 2026 16:00:00 GMT; path=/
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es)
```

**Explicação linha por linha:**

- `-c cookies.txt`: salva os cookies recebidos em um arquivo.
- `-b cookies.txt`: envia novamente os cookies do arquivo na próxima requisição.
- Isso prova que o navegador/cliente “lembra” do estado por meio do cookie.
- O contador sobe de 1 para 2 para 3 conforme o cookie é reaproveitado.

**2.3 Parte B, antes da correção: saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```text
HTTP/1.1 200 OK
Content-type: text/html; charset=UTF-8

Carregando a página...
```

**Explicação linha por linha:**

- O script executou, mas o resultado foi inconsistente.
- O navegador recebeu a página antes de qualquer redirecionamento.
- O `setcookie` e `header` não foram efetivos porque o fluxo da resposta já havia começado.

**2.4 Parte B, depois da correção: saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```text
HTTP/1.1 302 Found
Location: dashboard.php
Set-Cookie: usuario_logado=true; expires=Wed, 07 Oct 2026 16:00:00 GMT; path=/
Content-type: text/html; charset=UTF-8
```

**Explicação linha por linha:**

- `302 Found`: o servidor indica redirecionamento temporário.
- `Location: dashboard.php`: o navegador deve abrir a página `dashboard.php`.
- `Set-Cookie: usuario_logado=true`: o cookie foi gravado corretamente.
- Esse é o comportamento esperado para login com redirecionamento.

## 3. Perguntas

**3.1 No item 2.1, qual cabeçalho da resposta grava o cookie? E por que o contador não passa de 1 se você repetir o comando sem `-c` e `-b`?**

O cabeçalho que grava o cookie é:

```text
Set-Cookie: visitas=1; expires=...; path=/
```

Sem `-c` e `-b`, o `curl` não salva nem reaproveita os cookies entre requisições. Cada chamada vem como se fosse uma nova navegação, então o contador reinicia em 1.

**3.2 No item 2.2, o que fazem as opções `-c` e `-b`? O que isso prova sobre quem "lembra" do usuário no HTTP?**

- `-c cookies.txt`: grava os cookies no arquivo.
- `-b cookies.txt`: envia os cookies armazenados para a próxima requisição.

Isso prova que o estado do cliente é lembrado pelo navegador/cliente por meio do cookie, e não pelo servidor de forma automática. O HTTP em si é sem estado, e os cookies são o mecanismo para relembrar o usuário.

**3.3 No item 2.3, qual aviso apareceu e por que o redirecionamento não aconteceu?**

O aviso foi o famoso:

```text
headers already sent
```

Isso aconteceu porque antes do `header('Location: ...')` e `setcookie(...)`, o código já havia enviado texto com `echo`. Quando a resposta começa, os cabeçalhos já foram enviados e não podem mais ser modificados.

**3.4 No item 2.4, explique o status, o cabeçalho `Location` e o cabeçalho `Set-Cookie`. Por que `setcookie()` e `header()` precisam vir antes de qualquer `echo`?**

- `302 Found`: código de redirecionamento temporário.
- `Location: dashboard.php`: indica para onde o navegador deve ser enviado.
- `Set-Cookie: usuario_logado=true`: grava o cookie do login.

`setcookie()` e `header()` modificam cabeçalhos HTTP. Os cabeçalhos precisam ser enviados antes do corpo da resposta. Se houver `echo` antes, o PHP já começou a montar a resposta; nesse ponto, os cabeçalhos já não podem ser alterados, e o servidor dispara `headers already sent`.
