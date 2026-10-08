# Aula 02: PHP e HTTP na pratica

## Como executar

Abra um terminal dentro desta pasta e execute:

```powershell
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

Se a porta 8000 estiver ocupada, use outra porta, por exemplo:

```powershell
php -S localhost:8001 -d display_errors=1 -d output_buffering=0
```

Mantenha o terminal aberto para acompanhar o log do servidor. Use outro terminal para os comandos `curl.exe`.

## Questoes

| Numero | Pasta | Tema |
|---|---|---|
| 01 | `q01-primeiro-script` | O primeiro script e o log do servidor |
| 02 | `q02-erros` | Leitura de mensagens de erro |
| 03 | `q03-variaveis-aspas` | Variaveis, aspas e concatenacao |
| 04 | `q04-tipos` | Tipos e conversoes |
| 05 | `q05-media` | Media com dados da URL |
| 06 | `q06-strings` | Strings e acentuacao |
| 07 | `q07-tratamento` | Entrada ausente e dados perigosos |
| 08 | `q08-content-type` | Interpretacao do Content-Type |
| 09 | `q09-somente-post` | Metodo HTTP e codigo de status |
| 10 | `q10-cookies` | Cookies e ordem da resposta HTTP |

Cada pasta contem o script da questao e seu `respostas.md`. As evidencias visuais ficam dentro da pasta `prints` da questao correspondente.
