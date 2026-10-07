# Questão 08: O que o navegador entende? (Content-Type)

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `dados.php` | Código fornecido. No item 2.2 você vai descomentar a linha do header |
| `prints/devtools-html.png` | DevTools com o Content-Type antes de descomentar |
| `prints/devtools-json.png` | DevTools com o Content-Type depois de descomentar |

## 1. Análise do código

**1.1 Explique o que fazem `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`.**

- `json_encode($dados)` converte um array PHP em JSON.
- `JSON_PRETTY_PRINT` formata a saída em várias linhas, deixando a leitura mais fácil.
- `JSON_UNESCAPED_UNICODE` mantém os caracteres acentuados como `ç`, `ã`, `á` sem convertê-los para escapes de Unicode como `\u00e7`.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q08-content-type/dados.php` com o header comentado**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 14:59:08 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programa\u00e7\u00e3o Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: resposta bem-sucedida.
- `Content-type: text/html; charset=UTF-8`: o navegador entende que o conteúdo é HTML, mesmo sendo JSON.
- O corpo da resposta é um JSON, mas como o cabeçalho não informa isso, o navegador o trata como texto/HTML.

**2.2 Saída do mesmo comando com o header descomentado**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 14:59:08 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Content-type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

- `Content-type: application/json; charset=utf-8`: agora o servidor informa corretamente que o conteúdo é JSON.
- O navegador passa a interpretar a resposta como JSON e não como HTML.
- O corpo continua sendo o mesmo objeto, mas a forma de interpretação do cliente muda.

## 3. Perguntas

**3.1 Compare o cabeçalho `Content-Type` nas duas saídas. O que mudou?**

Antes:

```text
Content-type: text/html; charset=UTF-8
```

Depois:

```text
Content-type: application/json; charset=utf-8
```

A mudança é fundamental: o servidor passou a dizer ao cliente que a resposta é JSON.

**3.2 O corpo da resposta mudou? O que isso mostra sobre quem decide como o conteúdo é interpretado?**

O corpo da resposta não mudou em termos de dados. O que mudou foi o cabeçalho que informa ao navegador como interpretar esse corpo.

Isso mostra que a interpretação do conteúdo é feita principalmente pelo cliente, com base no `Content-Type` sentindo pelo servidor. O navegador não “adivinha” sozinho; ele obedece ao cabeçalho HTTP.

**3.3 Retire o `JSON_UNESCAPED_UNICODE`, rode o curl de novo e explique o que aconteceu com "Programação".**

Sem `JSON_UNESCAPED_UNICODE`, o PHP retorna a acentuação em forma escapada:

```json
{"disciplina":"Programa\u00e7\u00e3o Web I"}
```

Ou seja, o caractere `ç` e `ã` passam a ser representados como sequência Unicode. Isso funciona, mas deixa a leitura mais difícil. `JSON_UNESCAPED_UNICODE` mantém o texto legível para humanos.
