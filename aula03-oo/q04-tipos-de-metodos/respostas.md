# Quest?o 04: Tipos de m?todos

## 1. An?lise

| M?todo | Retorno | Par?metro | Altera | Tipo |
|---|---|---|---|---|
| getTemperatura | float | n?o | n?o | consulta |
| definirAlvo | void | float | sim | modificador |
| resfriar | void | float | sim | a??o/modificador |
| precisaResfriar | bool | n?o | n?o | consulta |
| mostrarStatus | void | n?o | n?o | a??o |

Previs?o: as cinco linhas originais s?o exatamente as sa?das abaixo. M?todos novos:
```php
public function aquecer(float $graus): void { $this->temperatura += $graus; }
public function diferencaParaAlvo(): float { return $this->temperatura - $this->alvo; }
```

## 2. Sa?das
```text
Laborat?rio 1: 25 ?C (alvo 22 ?C) - resfriando
Laborat?rio 1: 23 ?C (alvo 22 ?C) - resfriando
Laborat?rio 1: 23 ?C (alvo 24 ?C) - ok
33
bool(false)
Laborat?rio 1: 28 ?C (alvo 24 ?C) - resfriando
Diferen?a para o alvo: 4 ?C
```

## 3. Perguntas
`getTemperatura()` pode ser somado porque retorna n?mero; `mostrarStatus()` ? `void`. O m?todo que chama outro m?todo ? `mostrarStatus()`, que chama `precisaResfriar()`. A previs?o original acertou; as duas ?ltimas linhas s?o do aquecimento e da diferen?a.
