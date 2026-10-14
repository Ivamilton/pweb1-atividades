<?php
// 1. Dados do perfil (arrays)
$perfil = [
    'nome' => 'Ivamilton Júnior',
    'curso' => 'Tecnologia em Análise e Desenvolvimento de Sistemas',
    'campus' => 'IFCE Campus Boa Viagem',
    'cidade' => 'Boa Viagem - CE',
    'apresentacao' => 'Estudante de Análise e Desenvolvimento de Sistemas no IFCE Campus Boa Viagem. Apaixonado por desenvolvimento web, programação backend e construção de soluções práticas de software para resolver problemas reais.',
    'habilidades' => ['PHP', 'HTML5', 'CSS3', 'JavaScript', 'MySQL', 'Git & GitHub']
];

$projetos = [
    1 => [
        'titulo' => 'Leite do Futuro',
        'descricao' => 'Sistema voltado à modernização e gestão da cadeia produtiva leiteira no semiárido cearense. Permite o controle de ordenha, registro sanitário do rebanho, acompanhamento de custos e análise de produtividade zootécnica.',
        'tecnologias' => 'PHP, MySQL, HTML5, CSS3, JavaScript'
    ],
    2 => [
        'titulo' => 'Aprende Mais',
        'descricao' => 'Plataforma web de suporte educacional e reforço pedagógico. Oferece trilhas de aprendizagem personalizadas, simulados interativos e relatórios de desempenho para estudantes e docentes.',
        'tecnologias' => 'PHP, HTML5, CSS3, JavaScript'
    ],
    3 => [
        'titulo' => 'Plataforma de Estudos para Concursos',
        'descricao' => 'Projeto individual criado para planejamento e otimização de estudos para concursos públicos. Conta com banco de questões comentadas, simulados cronometrados, controle de ciclo de revisões e estatísticas por disciplina.',
        'tecnologias' => 'PHP, MySQL, HTML5, CSS3, JavaScript'
    ]
];

// 4. Qual página mostrar (if/elseif, status 404)
$pagina = $_GET['pagina'] ?? 'inicio';
$id_projeto = null;
$projeto_encontrado = null;
$mensagem_erro_404 = null;

if ($pagina === 'inicio' || $pagina === 'habilidades' || $pagina === 'projetos') {
    // Rotas principais válidas
} elseif ($pagina === 'projeto') {
    $id_projeto = (int)($_GET['id'] ?? 0);
    if (isset($projetos[$id_projeto])) {
        $projeto_encontrado = $projetos[$id_projeto];
    } else {
        http_response_code(404);
        $mensagem_erro_404 = 'Projeto não encontrado';
    }
} else {
    http_response_code(404);
    $mensagem_erro_404 = 'Página não encontrada';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Estudante - <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-claro">
    <!-- 5. Cabeçalho e menu -->
    <header class="cabecalho">
        <div class="container container-header">
            <div class="identificacao">
                <h1><?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="subtitulo"><?= htmlspecialchars($perfil['curso'], ENT_QUOTES, 'UTF-8') ?> &bull; <?= htmlspecialchars($perfil['campus'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <nav class="menu">
                <a href="?pagina=inicio" class="<?= $pagina === 'inicio' ? 'ativo' : '' ?>">Início</a>
                <a href="?pagina=habilidades" class="<?= $pagina === 'habilidades' ? 'ativo' : '' ?>">Habilidades</a>
                <a href="?pagina=projetos" class="<?= $pagina === 'projetos' || $pagina === 'projeto' ? 'ativo' : '' ?>">Projetos</a>
            </nav>
        </div>
    </header>

    <!-- 6. Conteúdo da página escolhida -->
    <main class="conteudo container">
        <?php if ($pagina === 'inicio'): ?>
            <section class="card apresentacao">
                <h2>Sobre Mim</h2>
                <p class="destaque-bio"><?= htmlspecialchars($perfil['apresentacao'], ENT_QUOTES, 'UTF-8') ?></p>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nome:</strong> <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="info-item">
                        <strong>Curso:</strong> <?= htmlspecialchars($perfil['curso'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="info-item">
                        <strong>Campus:</strong> <?= htmlspecialchars($perfil['campus'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="info-item">
                        <strong>Cidade:</strong> <?= htmlspecialchars($perfil['cidade'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                </div>
            </section>

        <?php elseif ($pagina === 'habilidades'): ?>
            <section class="card habilidades">
                <h2>Minhas Habilidades</h2>
                <p class="resumo-habilidades">
                    Atualmente possuo <strong><?= count($perfil['habilidades']) ?></strong> habilidades mapeadas:
                </p>
                <p class="texto-habilidades">
                    <strong>Habilidades em destaque:</strong> <?= htmlspecialchars(implode(', ', $perfil['habilidades']), ENT_QUOTES, 'UTF-8') ?>
                </p>
                <div class="skills-grid">
                    <?php foreach ($perfil['habilidades'] as $hab): ?>
                        <div class="skill-tag"><?= htmlspecialchars($hab, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($pagina === 'projetos'): ?>
            <section class="card projetos-secao">
                <h2>Meus Projetos</h2>
                <p>Confira abaixo os principais projetos desenvolvidos e em andamento:</p>
                <div class="projetos-grid">
                    <?php foreach ($projetos as $id => $proj): ?>
                        <article class="card-projeto">
                            <h3><?= htmlspecialchars($proj['titulo'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="descricao-curta"><?= htmlspecialchars($proj['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                            <p class="tecnologias-tag"><strong>Tecnologias:</strong> <?= htmlspecialchars($proj['tecnologias'], ENT_QUOTES, 'UTF-8') ?></p>
                            <a href="?pagina=projeto&id=<?= $id ?>" class="btn-link">Ver detalhes do projeto &rarr;</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($pagina === 'projeto' && $projeto_encontrado !== null): ?>
            <article class="card projeto-detalhe">
                <div class="breadcrumb">
                    <a href="?pagina=projetos" class="btn-voltar">&larr; Voltar para a lista de projetos</a>
                </div>
                <h2><?= htmlspecialchars($projeto_encontrado['titulo'], ENT_QUOTES, 'UTF-8') ?></h2>
                <div class="projeto-info-completa">
                    <div class="bloco-texto">
                        <h3>Descrição do Projeto</h3>
                        <p class="projeto-descricao-detalhada"><?= htmlspecialchars($projeto_encontrado['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="bloco-tecnologias">
                        <h3>Tecnologias Empregadas</h3>
                        <p class="tecnologias-tag"><?= htmlspecialchars($projeto_encontrado['tecnologias'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            </article>

        <?php elseif ($mensagem_erro_404 !== null): ?>
            <section class="card erro-404">
                <span class="codigo-status">404</span>
                <h2><?= htmlspecialchars($mensagem_erro_404, ENT_QUOTES, 'UTF-8') ?></h2>
                <p>O endereço ou recurso informado não foi localizado no servidor.</p>
                <a href="?pagina=inicio" class="btn-link">&larr; Retornar à Página Inicial</a>
            </section>
        <?php endif; ?>
    </main>

    <!-- 7. Rodapé -->
    <footer class="rodape">
        <div class="container container-rodape">
            <p>Tema atual: <strong>Claro</strong></p>
            <p><a href="?formato=json">Versão JSON (API)</a></p>
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?>. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
