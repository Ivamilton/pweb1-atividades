# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**

As linhas HTML são as marcações da página como `<!DOCTYPE html>`, `<html>`, `<head>`, `<meta charset="UTF-8">`, `<title>`, `<body>`, `<h1>`, `<p>`, etc. Elas definem a estrutura e o conteúdo visual exibido no navegador.

As linhas PHP são estas:

```php
<?php echo "Este texto foi escrito pelo PHP."; ?>
```

```php
<?= date('H:i:s') ?>
```

Essas partes são processadas no servidor antes da página ser enviada ao navegador.

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**

A diferença é apenas a sintaxe curta.

- `<?php echo "Texto"; ?>` é a forma completa do bloco PHP.
- `<?= "Texto" ?>` é a forma abreviada de `<?php echo "Texto"; ?>`.

Em ambas, o resultado é a mesma coisa: o PHP imprime o valor na página HTML.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor (as linhas que apareceram no terminal do `php -S` ao abrir a página no navegador)**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q01-primeiro-script/ola.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- `Accepted`: a conexão do navegador com o servidor foi aceita.
- `[200]: GET /q01-primeiro-script/ola.php`: o servidor respondeu com status 200 OK para uma requisição GET ao arquivo `ola.php`.
- `Closing`: a conexão foi encerrada depois de responder a requisição.

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 14:59:08 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Questão 01</title>
</head>
<body>
  <h1>Olá, turma!</h1>
  <p>Este texto foi escrito pelo PHP.</p>
  <p>Hora no servidor: 15:00:13</p>
</body>
</html>
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: a resposta do servidor foi bem-sucedida.
- `Host: localhost:8000`: o servidor a que a requisição foi enviada.
- `Date: ...`: data e hora em que a resposta foi gerada.
- `Connection: close`: a conexão foi fechada após a resposta.
- `X-Powered-By: PHP/8.3.6`: indica que a aplicação foi gerada pelo PHP.
- `Content-type: text/html; charset=UTF-8`: informa ao navegador que o corpo é HTML em UTF-8.
- Em seguida vem o corpo da página, com o HTML final gerado.

## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

A página muda apenas o horário, porque o código usa `date('H:i:s')` e a hora do servidor se atualiza a cada recarga.

No log do servidor, a cada F5 aparece uma nova sequência de eventos:

```text
Accepted
[200]: GET /q01-primeiro-script/ola.php
Closing
```

Isso acontece porque cada recarga é uma nova requisição HTTP do navegador para o servidor. O PHP executa o script novamente e gera uma resposta nova.

**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não aparece o código PHP em si. O navegador vê apenas o HTML final já processado pelo servidor.

O PHP foi executado antes do envio da resposta. Por isso, no código-fonte do navegador, o que aparece é apenas o HTML com o texto gerado, e não os blocos `<?php ... ?>`.

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**

- A primeira linha, `HTTP/1.1 200 OK`, indica a versão do protocolo HTTP, o código de status e a descrição do status.
- `Content-type: text/html; charset=UTF-8` indica que o corpo da resposta é HTML e que a codificação é UTF-8.
- `X-Powered-By: PHP/8.3.6` informa que o servidor usa PHP para gerar a resposta.

Esses cabeçalhos ajudam o navegador e o cliente a entender como interpretar a resposta.
