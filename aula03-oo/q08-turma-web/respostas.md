# Questão 08: Desafio: a turma na web

## 1. Análise
`Aluno` possui atributos privados `nome`, `nota1`, `nota2`, construtor, `getNome`, `calcularMedia` e `situacao`. `Disciplina` possui `nome` e `alunos` privados, construtor, getters, `adicionarAluno(Aluno $aluno)`, `calcularMediaTurma` e `contarAprovados`. O tipo `Aluno` exige um objeto dessa classe, não uma string.

## 2. Saídas
A página exibe os quatro alunos em tabela e:
```text
Média da turma: 6,00
Aprovados: 2 de 4
```
Com `?teste=1`, exibe `Nota inválida para Teste: use valores de 0 a 10.` no topo. O log registra duas requisições GET separadas, ambas com status 200. Passar `'Eduardo'` para `adicionarAluno` causa `TypeError` porque o método exige `Aluno`.

## 3. Perguntas
Os objetos são recriados a cada requisição; não permanecem automaticamente entre requests. A checagem de lista vazia evita divisão por zero e devolve média 0 quando não há alunos.
