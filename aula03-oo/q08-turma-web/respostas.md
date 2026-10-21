# Quest?o 08: Desafio: a turma na web

## 1. An?lise
`Aluno` possui atributos privados `nome`, `nota1`, `nota2`, construtor, `getNome`, `calcularMedia` e `situacao`. `Disciplina` possui `nome` e `alunos` privados, construtor, getters, `adicionarAluno(Aluno $aluno)`, `calcularMediaTurma` e `contarAprovados`. O tipo `Aluno` exige um objeto dessa classe, n?o uma string.

## 2. Sa?das
A p?gina exibe os quatro alunos em tabela e:
```text
M?dia da turma: 6,00
Aprovados: 2 de 4
```
Com `?teste=1`, exibe `Nota inv?lida para Teste: use valores de 0 a 10.` no topo. O log registra duas requisi??es GET separadas, ambas com status 200. Passar `'Eduardo'` para `adicionarAluno` causa `TypeError` porque o m?todo exige `Aluno`.

## 3. Perguntas
Os objetos s?o recriados a cada requisi??o; n?o permanecem automaticamente entre requests. A checagem de lista vazia evita divis?o por zero e devolve m?dia 0 quando n?o h? alunos.
