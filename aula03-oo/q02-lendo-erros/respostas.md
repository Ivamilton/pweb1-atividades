# Questão 02: Lendo erros de objetos

## 1. Análise do código

| Rodada | Erro | Correção |
|---|---|---|
| 1 | `$aluno->$nome`: variável inexistente e propriedade dinâmica vazia | `$aluno->nome` |
| 2 | string `'3'` em propriedade `int` | inteiro `3` |
| 3 | `curso` não inicializado | `$aluno->curso = 'ADS'` |
| 4 | `$nome` inexistente dentro do método | `$this->nome` |

## 2. Saídas do terminal

As mensagens completas variam conforme a versão do PHP, mas as mensagens centrais foram:

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
Sou , do 3º semestre.
```

Execução final:
```text
Curso: ADS
Sou Carla, do 3º semestre.
```

**3.** O fatal error interrompe o programa; warning é aviso que normalmente permite continuar. `new Aluno()` não lê `curso`; o erro surge no `echo`. `$this->nome` acessa a propriedade do objeto, enquanto `$nome` seria variável local.
