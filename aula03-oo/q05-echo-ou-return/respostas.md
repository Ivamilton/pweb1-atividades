# Quest?o 05: echo ou return?

## 1. An?lise
`area()` e `perimetro()` agora retornam `float`; `ehQuadrado()` retorna `bool` comparando largura e altura. No `foreach`, cada ?rea ? somada a `$areaTotal`.

## 2. Sa?das
Original: `?rea: 48` e `Per?metro: 28`. Ao fazer `var_dump($sala->area())` na vers?o original: `?rea: 48` e `NULL`, pois o m?todo era `void`.

Vers?o final:
```text
Sala de aula: 48 m? (ret?ngulo)
Laborat?rio: 49 m? (quadrado)
Biblioteca: 108 m? (ret?ngulo)
?rea total: 205 m?
Rodap? necess?rio na biblioteca: 42 m
```

## 3. Perguntas
Um m?todo `void` n?o devolve valor. Por isso a vers?o original n?o permitia somar ?reas: imprimia, mas retornava `NULL`. `echo` faz sentido em m?todo cuja responsabilidade ? apresentar uma mensagem diretamente.
