<?php
// 1. Dados do perfil (arrays)
$perfil = [
    'nome' => 'Ivamilton Júnior',
    'curso' => 'Tecnologia em Análise e Desenvolvimento de Sistemas',
    'campus' => 'IFCE Campus Boa Viagem',
    'cidade' => 'Boa Viagem - CE',
    'apresentacao' => 'Desenvolvedor em formação no curso de Análise e Desenvolvimento de Sistemas, com foco na criação de aplicações web modernas, acessíveis e orientadas a problemas reais. Tenho interesse em transformar ideias em produtos digitais funcionais, unindo boas práticas de frontend, backend e organização de projetos.',
    'habilidades' => [
        'HTML5',
        'CSS3',
        'JavaScript',
        'React',
        'PHP',
        'Python',
        'PostgreSQL',
        'Git & GitHub',
        'Django',
        'Flask',
        'FastAPI',
        'Bootstrap',
        'APIs REST'
    ]
];

$projetos = [
    1 => [
        'titulo' => 'Leite do Futuro',
        'descricao' => 'Plataforma para modernizar a gestão da cadeia produtiva leiteira no semiárido cearense. Reúne dados de ordenha, sanidade do rebanho, custos e produtividade em uma experiência simples para apoiar decisões no campo.',
        'tecnologias' => 'React, Python, APIs REST, PostgreSQL'
    ],
    2 => [
        'titulo' => 'Aprende Mamis',
        'descricao' => 'Plataforma educacional pensada para apoiar mães em sua jornada de aprendizagem. Oferece conteúdos organizados, trilhas de estudo, atividades interativas e acompanhamento da evolução de cada estudante.',
        'tecnologias' => 'React, Python, APIs REST, PostgreSQL'
    ],
    3 => [
        'titulo' => 'Plataforma de Estudos para Concursos',
        'descricao' => 'Aplicação para planejar e otimizar a preparação para concursos públicos. Inclui banco de questões, simulados, ciclo de revisões e indicadores de desempenho por disciplina para tornar os estudos mais consistentes.',
        'tecnologias' => 'React, Python, APIs REST, PostgreSQL'
    ]
];

// 2. Tema claro ou escuro (GET, cookie, validação)
// Prioridade: o que veio na URL; depois, o cookie; por fim, o padrão
$tema_bruto = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

// R6. Validação de segurança: apenas 'claro' ou 'escuro'. Qualquer outro valor (ex: scripts) vira 'claro'
$tema = ($tema_bruto === 'escuro') ? 'escuro' : 'claro';

// Grava o cookie apenas quando o tema vier pela URL (persistência de 30 dias)
if (isset($_GET['tema'])) {
    setcookie('tema', $tema, time() + (30 * 24 * 60 * 60));
}

// 3. Rota JSON (header, json_encode, exit)
if (isset($_GET['formato']) && $_GET['formato'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'perfil' => $perfil,
        'projetos' => $projetos
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

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

$proximo_tema = ($tema === 'escuro') ? 'claro' : 'escuro';
$param_pagina = ($pagina === 'projeto' && $id_projeto) ? "pagina=projeto&id={$id_projeto}" : "pagina={$pagina}";
$link_troca_tema = "?{$param_pagina}&tema={$proximo_tema}";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Estudante - <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-<?= htmlspecialchars($tema, ENT_QUOTES, 'UTF-8') ?>">
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
                <a href="<?= htmlspecialchars($link_troca_tema, ENT_QUOTES, 'UTF-8') ?>" class="btn-tema"><?= $tema === 'escuro' ? '☀️ Modo Claro' : '🌙 Modo Escuro' ?></a>
            </nav>
        </div>
    </header>

    <!-- 6. Conteúdo da página escolhida -->
    <?php if ($pagina === 'inicio'): ?>
        <section class="hero">
            <div class="container">
                <div class="hero-inner">
                    <div class="hero-avatar">🎓</div>
                    <div class="hero-text">
                        <h2><?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <p class="hero-bio"><?= htmlspecialchars($perfil['apresentacao'], ENT_QUOTES, 'UTF-8') ?></p>
                        <div class="hero-tags">
                            <span class="hero-tag">📍 <?= htmlspecialchars($perfil['cidade'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="hero-tag">🏛️ <?= htmlspecialchars($perfil['campus'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="hero-tag">💻 <?= count($perfil['habilidades']) ?> habilidades</span>
                            <span class="hero-tag">🚀 <?= count($projetos) ?> projetos</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <main class="conteudo container">
        <?php if ($pagina === 'inicio'): ?>
            <section class="card apresentacao">
                <h2><span class="icon">👤</span> Sobre Mim</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nome</strong>
                        <span><?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Curso</strong>
                        <span><?= htmlspecialchars($perfil['curso'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Campus</strong>
                        <span><?= htmlspecialchars($perfil['campus'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Cidade</strong>
                        <span><?= htmlspecialchars($perfil['cidade'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                </div>
            </section>

        <?php elseif ($pagina === 'habilidades'): ?>
            <section class="card habilidades">
                <h2><span class="icon">⚡</span> Minhas Habilidades</h2>
                <p class="resumo-habilidades">
                    Atualmente possuo <strong><?= count($perfil['habilidades']) ?></strong> habilidades mapeadas:
                </p>
                <p class="texto-habilidades">
                    <strong>Destaque:</strong>&nbsp;<?= htmlspecialchars(implode(' · ', $perfil['habilidades']), ENT_QUOTES, 'UTF-8') ?>
                </p>
                <div class="skills-grid">
                    <?php foreach ($perfil['habilidades'] as $hab): ?>
                        <div class="skill-tag"><?= htmlspecialchars($hab, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($pagina === 'projetos'): ?>
            <section class="card projetos-secao">
                <h2><span class="icon">🚀</span> Meus Projetos</h2>
                <p>Confira abaixo os principais projetos desenvolvidos e em andamento:</p>
                <div class="projetos-grid">
                    <?php foreach ($projetos as $id => $proj): ?>
                        <article class="card-projeto">
                            <span class="card-projeto-numero">Projeto #<?= $id ?></span>
                            <h3><?= htmlspecialchars($proj['titulo'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="descricao-curta"><?= htmlspecialchars($proj['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                            <span class="tecnologias-tag"><?= htmlspecialchars($proj['tecnologias'], ENT_QUOTES, 'UTF-8') ?></span>
                            <a href="?pagina=projeto&id=<?= $id ?>" class="btn-link">Ver detalhes &rarr;</a>
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
            <p>Tema atual: <strong><?= $tema === 'escuro' ? 'Escuro' : 'Claro' ?></strong></p>
            <p><a href="?formato=json" class="link-api" target="_blank">Versão JSON (API)</a></p>
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?>. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
