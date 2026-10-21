# Questão 05: echo ou return?

## 1. Análise
`area()` e `perimetro()` agora retornam `float`; `ehQuadrado()` retorna `bool` comparando largura e altura. No `foreach`, cada área é somada a `$areaTotal`.

## 2. Saídas
Original: `Área: 48` e `Perímetro: 28`. Ao fazer `var_dump($sala->area())` na versão original: `Área: 48` e `NULL`, pois o método era `void`.

Versão final:
```text
Sala de aula: 48 m² (retângulo)
Laboratório: 49 m² (quadrado)
Biblioteca: 108 m² (retângulo)
Área total: 205 m²
Rodapé necessário na biblioteca: 42 m
```

## 3. Perguntas
Um método `void` não devolve valor. Por isso a versão original não permitia somar áreas: imprimia, mas retornava `NULL`. `echo` faz sentido em método cuja responsabilidade é apresentar uma mensagem diretamente.
