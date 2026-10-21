# Questão 01: Do array à classe

## 1. Análise do código

**1.1** Em `public float $preco`, `public` é a visibilidade, `float` é o tipo e `$preco` é o nome da propriedade. A propriedade é pública e aceita números decimais.

**1.2** O array usa `$livro['titulo']`; o objeto usa `$livro1->titulo`. A classe permite declarar tipos e o PHP verifica se os valores são compatíveis.

## 2. Saídas do terminal

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

**a)** Há uma classe (`Livro`) e dois objetos (`$livro1` e `$livro2`).

**b)** `object(Livro)#2` identifica o tipo e o identificador interno do objeto; `(5)` indica suas cinco propriedades.

**c)** `strict_types` mantém a verificação rigorosa e impede a conversão silenciosa da string para inteiro.
