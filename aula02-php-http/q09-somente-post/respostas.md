# Questão 09: Método HTTP e código de status

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `api.php` | Criado por você, conforme o enunciado |

## 1. Análise do código

**1.1 Cole o código do `api.php` e explique cada parte: a verificação do método, o status, os cabeçalhos e o JSON.**

Código:

```php
<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(200);
echo json_encode(['sucesso' => 'Dados recebidos'], JSON_UNESCAPED_UNICODE);
```

Explicação:

- `header('Content-Type: application/json; charset=utf-8');`: informa ao cliente que o conteúdo é JSON.
- `$_SERVER['REQUEST_METHOD']`: guarda o método HTTP da requisição (`GET`, `POST`, `PUT` etc).
- `if (...)`: se o método não for `POST`, a API responde com erro.
- `http_response_code(405)`: define o status HTTP 405.
- `header('Allow: POST')`: informa quais métodos são permitidos.
- `json_encode(...)`: gera o JSON da resposta.
- `exit;`: interrompe a execução para não seguir para o bloco de sucesso.
- Para `POST`, o servidor responde com 200 e mensagem de sucesso.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 405 Method Not Allowed
Allow: POST
Content-Type: application/json; charset=utf-8

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

- `HTTP/1.1 405 Method Not Allowed`: o navegador ou o cliente usou `GET` e o servidor respondeu que o método não é permitido.
- `Allow: POST`: indica que o único método aceito é `POST`.
- `Content-Type: application/json; charset=utf-8`: informa que o corpo é JSON.
- `{"erro":"Método não permitido"}`: corpo da resposta em JSON.

**2.2 Saída de `curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 200 OK
Content-Type: application/json; charset=utf-8

{"sucesso":"Dados recebidos"}
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: o método solicitado foi aceito.
- `Content-Type`: informa que a resposta é JSON.
- `{"sucesso":"Dados recebidos"}`: payload de sucesso.

**2.3 Saída de `curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 405 Method Not Allowed
Allow: POST
Content-Type: application/json; charset=utf-8

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

- `PUT` não é permitido.
- O servidor responde 405 e informa que `POST` é o único método aceito.

**2.4 Log do servidor das três requisições**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [405]: GET /q09-somente-post/api.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: POST /q09-somente-post/api.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [405]: PUT /q09-somente-post/api.php
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- Cada requisição aparece no log com o método usado e o status gerado.
- O status 405 aparece para os métodos que não são permitidos.
- O status 200 aparece para o POST aceito.

## 3. Perguntas

**3.1 Que método o navegador usa ao abrir o endereço? Qual status ele recebe?**

Ao abrir no navegador, o navegador usa `GET`. Como o endpoint aceita apenas `POST`, ele recebe `405 Method Not Allowed`.

**3.2 Para que serve o cabeçalho `Allow`?**

`Allow: POST` informa ao cliente que os métodos permitidos para aquele recurso são apenas `POST`.

Ele é usado em respostas 405 para indicar o que pode ser feito em seguida.

**3.3 No log, onde aparecem o método e o status de cada requisição?**

Aparecem na linha:

```text
[200]: POST /q09-somente-post/api.php
```

ou

```text
[405]: PUT /q09-somente-post/api.php
```

Assim, a parte `[405]` ou `[200]` indica o código de status, e o nome do método vem logo antes do caminho solicitado.
