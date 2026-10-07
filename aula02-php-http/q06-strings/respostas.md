# Questão 06: Strings e acentuação

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `palavra.php` | Código fornecido, que você vai completar no item 1.2 |

> Se aparecer `Call to undefined function mb_strlen()`, ative a linha `extension=mbstring` no seu `php.ini` e reinicie o servidor. Registre isso na resposta 3.3.

## 1. Análise do código

**1.1 Explique o código original linha por linha.**

Código original:

```php
<?php
$palavra = $_GET['palavra'] ?? "Ceara";

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";
```

Explicação:

- `$palavra = $_GET['palavra'] ?? "Ceara";`: lê o valor vindo da URL; se não vier, usa o valor padrão `Ceara`.
- `echo "<p>Palavra: $palavra</p>";`: imprime a palavra na página HTML.
- `echo "<p>strlen: " . strlen($palavra) . "</p>";`: calcula o tamanho da string com `strlen` e mostra o resultado.

**1.2 Complete o código para mostrar também: `mb_strlen`, `strtoupper`, `mb_strtoupper` e uma classificação com `if`: "palavra curta" (até 5 letras) ou "palavra longa". Use `mb_strlen` na classificação. Cole o código e explique.**

Código final:

```php
<?php
$palavra = $_GET['palavra'] ?? "Ceara";

$len = strlen($palavra);
$mbLen = mb_strlen($palavra);
$maiuscula = strtoupper($palavra);
$maiusculaMb = mb_strtoupper($palavra);

if ($mbLen <= 5) {
    $classe = "palavra curta";
} else {
    $classe = "palavra longa";
}

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: $len</p>";
echo "<p>mb_strlen: $mbLen</p>";
echo "<p>strtoupper: $maiuscula</p>";
echo "<p>mb_strtoupper: $maiusculaMb</p>";
echo "<p>Classificação: $classe</p>";
```

Explicação:

- `strlen` conta bytes e pode dar resultado errado com acentos.
- `mb_strlen` conta caracteres corretamente em textos Unicode.
- `strtoupper` converte para maiúsculas sem tratar Unicode com precisão.
- `mb_strtoupper` faz a conversão correta com acentos.
- A classificação usa `mb_strlen` para decidir se a palavra tem até 5 letras ou mais.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"`**

```text
<p>Palavra: Ceara</p>
<p>strlen: 5</p>
<p>mb_strlen: 5</p>
<p>strtoupper: CEARA</p>
<p>mb_strtoupper: CEARA</p>
<p>Classificação: palavra curta</p>
```

**Explicação linha por linha:**

- `Palavra: Ceara`: a palavra foi recebida por parâmetro e exibida.
- `strlen: 5`: a palavra tem cinco letras.
- `mb_strlen: 5`: também mostra cinco caracteres.
- `strtoupper: CEARA`: todas as letras foram transformadas em maiúsculas.
- `mb_strtoupper: CEARA`: mesma transformação, no caso sem acento, com comportamento equivalente.
- `Classificação: palavra curta`: a palavra tem 5 letras e entra na condição.

**2.2 Abra no navegador `palavra.php?palavra=Ceará` e cole a linha do log do servidor**

```text
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Accepted
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 [200]: GET /q06-strings/palavra.php?palavra=Cear%C3%A1
[Wed Oct 7 15:00:13 2026] 127.0.0.1:44968 Closing
```

**Explicação linha por linha:**

- `Accepted`: a requisição foi aceita.
- `[200]: GET ...Cear%C3%A1`: a URL foi encodada na forma segura para HTTP.
- `Closing`: a conexão foi encerrada.

## 3. Perguntas

**3.1 Compare o `strlen` de "Ceara" e de "Ceará". Por que o acento muda o resultado?**

- `strlen("Ceara")` = 5
- `strlen("Ceará")` = 6 ou 7, dependendo da codificação e do número de bytes

O acento muda o resultado porque `strlen` conta bytes, e o caractere `á` pode ocupar mais de um byte em UTF-8. `mb_strlen` trata corretamente caracteres Unicode, sem depender do byte.

**3.2 No log, a palavra aparece como `Cear%C3%A1`. O que é isso? Por que o navegador transformou o "á"?**

`Cear%C3%A1` é URL encoding, ou codificação de URL. O navegador converte caracteres especiais em uma sequência segura para aparecer na URL.

O `á` virou `%C3%A1` porque o caractere não é permitido em alguns trechos da URL em formato bruto. A codificação transforma o caractere em bytes seguros para transporte HTTP.

**3.3 Qual a diferença entre `strtoupper` e `mb_strtoupper` com a palavra "Ceará"?**

- `strtoupper("Ceará")` pode produzir uma saída incorreta ou incompleta, porque ela não trata Unicode da melhor forma.
- `mb_strtoupper("Ceará")` converte corretamente para maiúsculas com suporte à acentuação.

Ou seja, o `mb_*` é o correto quando lidamos com textos internacionais e acentos.
