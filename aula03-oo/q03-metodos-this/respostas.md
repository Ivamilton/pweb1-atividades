# Questão 03: Métodos e `$this`

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aluno.php` | Classe `Aluno` com os três métodos implementados |

## 1. Análise do código

**1.1 Cole o código dos três métodos que você escreveu e explique cada um.**

```php
public function calcularMedia(): float
{
    return ($this->nota1 + $this->nota2) / 2;
}

public function situacao(): string
{
    $media = $this->calcularMedia();

    if ($media >= 7) {
        return 'Aprovado';
    }

    if ($media >= 4) {
        return 'Recuperação';
    }

    return 'Reprovado';
}

public function apresentar(): void
{
    echo $this->nome . ': média ' .
        number_format($this->calcularMedia(), 1, ',', '.') .
        ' (' . $this->situacao() . ')' . PHP_EOL;
}
```

`calcularMedia()` soma as duas notas do objeto atual, usando `$this`, e divide o resultado por dois. O tipo `float` informa que o método devolve um número decimal.

`situacao()` reutiliza `calcularMedia()` e compara a média com os limites definidos no enunciado: média maior ou igual a 7 resulta em `Aprovado`; média maior ou igual a 4 resulta em `Recuperação`; os demais casos resultam em `Reprovado`.

`apresentar()` usa os dados do próprio aluno para montar e imprimir uma frase. `number_format()` exibe a média com uma casa decimal e vírgula como separador decimal.

**1.2 Classifique os três métodos: de ação, com retorno, com parâmetros, modificador ou de consulta? Justifique.**

`calcularMedia()` e `situacao()` são métodos de consulta, porque apenas consultam os dados do aluno e devolvem informações, sem alterá-los. Eles têm retorno (`float` e `string`) e não recebem parâmetros.

`apresentar()` é um método de ação, porque realiza a ação de imprimir os dados na saída. Ele não recebe parâmetros e tem retorno `void`, pois não devolve um valor.

Nenhum dos três é modificador: eles não alteram `nome`, `nota1` ou `nota2`.

## 2. Saídas do terminal

**2.1 Saída de**: `php q03-metodos-this/aluno.php`

```text
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
```

**Explicação:**

Ana tem média `(8,0 + 9,5) / 2 = 8,75`, exibida como `8,8`, e foi aprovada. Bruno tem média `5,5`, por isso está em recuperação. Caio tem média `2,75`, exibida como `2,8`, e foi reprovado.

**2.2 Saída com o quarto aluno (notas 6,5 e 7,5)**

Considerando um quarto objeto chamado `Diana`:

```php
$diana = new Aluno();
$diana->nome = 'Diana';
$diana->nota1 = 6.5;
$diana->nota2 = 7.5;
$diana->apresentar();
```

```text
Diana: média 7,0 (Aprovado)
```

**Explicação:**

Diana tem média `(6,5 + 7,5) / 2 = 7,0`. Como a regra usa `>= 7`, uma média exatamente igual a 7 também é suficiente para aprovação.

## 3. Perguntas

**a) Por que `situacao()` chama `$this->calcularMedia()` em vez de repetir a conta?**

Para centralizar o cálculo em um único método. Assim, a média é calculada de forma consistente e, se a fórmula precisar mudar, ela será alterada apenas em `calcularMedia()`. Isso também evita duplicação de código.

**b) Com média exatamente 7,0, qual é a situação? Qual linha do código decide isso?**

A situação é `Aprovado`. A decisão é feita pela condição `if ($media >= 7)`, porque o operador `>=` inclui o valor 7,0.

**c) O método `apresentar()` foi escrito uma vez. Como ele sabe se deve mostrar a Ana ou o Bruno?**

O método é chamado sobre um objeto específico, por exemplo `$ana->apresentar()` ou `$bruno->apresentar()`. Dentro do método, `$this` representa o objeto que fez a chamada; por isso `$this->nome`, `$this->nota1` e `$this->nota2` usam os dados corretos de cada aluno.
