# Quest?o 02: Lendo erros de objetos

## 1. An?lise do c?digo

| Rodada | Erro | Corre??o |
|---|---|---|
| 1 | `$aluno->$nome`: vari?vel inexistente e propriedade din?mica vazia | `$aluno->nome` |
| 2 | string `'3'` em propriedade `int` | inteiro `3` |
| 3 | `curso` n?o inicializado | `$aluno->curso = 'ADS'` |
| 4 | `$nome` inexistente dentro do m?todo | `$this->nome` |

## 2. Sa?das do terminal

As mensagens completas variam conforme a vers?o do PHP, mas as mensagens centrais foram:

```text
Warning: Undefined variable $nome
Fatal error: Uncaught Error: Cannot access empty property
```

```text
Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int
```

```text
Fatal error: Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization
```

```text
Warning: Undefined variable $nome
Sou , do 3? semestre.
```

Execu??o final:
```text
Curso: ADS
Sou Carla, do 3? semestre.
```

**3.** O fatal error interrompe o programa; warning ? aviso que normalmente permite continuar. `new Aluno()` n?o l? `curso`; o erro surge no `echo`. `$this->nome` acessa a propriedade do objeto, enquanto `$nome` seria vari?vel local.
