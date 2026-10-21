# Questão 04: Tipos de métodos

## 1. Análise

| Método | Retorno | Parâmetro | Altera | Tipo |
|---|---|---|---|---|
| getTemperatura | float | não | não | consulta |
| definirAlvo | void | float | sim | modificador |
| resfriar | void | float | sim | ação/modificador |
| precisaResfriar | bool | não | não | consulta |
| mostrarStatus | void | não | não | ação |

Previsão: as cinco linhas originais são exatamente as saídas abaixo. Métodos novos:
```php
public function aquecer(float $graus): void { $this->temperatura += $graus; }
public function diferencaParaAlvo(): float { return $this->temperatura - $this->alvo; }
```

## 2. Saídas
```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
Laboratório 1: 28 °C (alvo 24 °C) - resfriando
Diferença para o alvo: 4 °C
```

## 3. Perguntas
`getTemperatura()` pode ser somado porque retorna número; `mostrarStatus()` é `void`. O método que chama outro método é `mostrarStatus()`, que chama `precisaResfriar()`. A previsão original acertou; as duas últimas linhas são do aquecimento e da diferença.
