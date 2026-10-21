# Quest?o 01: Do array ? classe

## 1. An?lise do c?digo

**1.1** Em `public float $preco`, `public` ? a visibilidade, `float` ? o tipo e `$preco` ? o nome da propriedade. A propriedade ? p?blica e aceita n?meros decimais.

**1.2** O array usa `$livro['titulo']`; o objeto usa `$livro1->titulo`. A classe permite declarar tipos e o PHP verifica se os valores s?o compat?veis.

## 2. Sa?das do terminal

**2.1**
```text
Vidas Secas, de Graciliano Ramos (1938)
O Quinze, de Rachel de Queiroz (1930)
object(Livro)#2 (5) {
  ["titulo"]=> string(8) "O Quinze"
  ["autor"]=> string(17) "Rachel de Queiroz"
  ["ano"]=> int(1930)
  ["preco"]=> float(34.9)
  ["disponivel"]=> bool(true)
}
```

**2.2** Atribuir `'1938'` a `int $ano` causa `TypeError: Cannot assign string to property Livro::$ano of type int`.

## 3. Perguntas

**a)** H? uma classe (`Livro`) e dois objetos (`$livro1` e `$livro2`).

**b)** `object(Livro)#2` identifica o tipo e o identificador interno do objeto; `(5)` indica suas cinco propriedades.

**c)** `strict_types` mant?m a verifica??o rigorosa e impede a convers?o silenciosa da string para inteiro.
