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

<?php
/* ── Snippets de SVG (Lucide Icons, stroke-only, 20×20) ─────────────────── */
$ico_sun = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>';
$ico_moon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>';
$ico_user = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>';
$ico_zap  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>';
$ico_grid = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>';
$ico_mappin = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>';
$ico_building = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M16 6h.01M12 6h.01M12 10h.01M12 14h.01M16 10h.01M16 14h.01M8 10h.01M8 14h.01"/></svg>';
$ico_code = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>';
$ico_rocket = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/></svg>';
$ico_arrow_left = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>';
$ico_arrow_right = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>';
$ico_home = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>';
$ico_tag = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"/><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"/></svg>';
$ico_search_x = '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/><path d="m13.5 8.5-5 5"/><path d="m8.5 8.5 5 5"/></svg>';
$ico_json = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M10 9H8"/><path d="M16 9h-2"/><path d="M13 15H8"/><path d="M14 2l6 6v1"/></svg>';
$ico_grad = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>';
?>

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
                <a href="<?= htmlspecialchars($link_troca_tema, ENT_QUOTES, 'UTF-8') ?>" class="btn-tema">
                    <?= $tema === 'escuro' ? $ico_sun . ' Modo Claro' : $ico_moon . ' Modo Escuro' ?>
                </a>
            </nav>
        </div>
    </header>

    <!-- 6. Conteúdo da página escolhida -->
    <?php if ($pagina === 'inicio'): ?>
        <section class="hero">
            <div class="container">
                <div class="hero-inner">
                    <div class="hero-avatar"><?= $ico_grad ?></div>
                    <div class="hero-text">
                        <h2><?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <p class="hero-bio"><?= htmlspecialchars($perfil['apresentacao'], ENT_QUOTES, 'UTF-8') ?></p>
                        <div class="hero-tags">
                            <span class="hero-tag"><?= $ico_mappin ?> <?= htmlspecialchars($perfil['cidade'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="hero-tag"><?= $ico_building ?> <?= htmlspecialchars($perfil['campus'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="hero-tag"><?= $ico_code ?> <?= count($perfil['habilidades']) ?> habilidades</span>
                            <span class="hero-tag"><?= $ico_rocket ?> <?= count($projetos) ?> projetos</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <main class="conteudo container">
        <?php if ($pagina === 'inicio'): ?>
            <section class="card apresentacao">
                <h2><span class="icon"><?= $ico_user ?></span> Sobre Mim</h2>
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
                <h2><span class="icon"><?= $ico_zap ?></span> Minhas Habilidades</h2>
                <p class="resumo-habilidades">
                    Atualmente possuo <strong><?= count($perfil['habilidades']) ?></strong> habilidades mapeadas:
                </p>
                <p class="texto-habilidades">
                    <strong>Destaque:</strong>&nbsp;<?= htmlspecialchars(implode(' · ', $perfil['habilidades']), ENT_QUOTES, 'UTF-8') ?>
                </p>
                <div class="skills-grid">
                    <?php foreach ($perfil['habilidades'] as $hab): ?>
                        <div class="skill-tag"><?= $ico_tag ?><?= htmlspecialchars($hab, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($pagina === 'projetos'): ?>
            <section class="card projetos-secao">
                <h2><span class="icon"><?= $ico_grid ?></span> Meus Projetos</h2>
                <p>Confira abaixo os principais projetos desenvolvidos e em andamento:</p>
                <div class="projetos-grid">
                    <?php foreach ($projetos as $id => $proj): ?>
                        <article class="card-projeto">
                            <span class="card-projeto-numero">Projeto #<?= $id ?></span>
                            <h3><?= htmlspecialchars($proj['titulo'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="descricao-curta"><?= htmlspecialchars($proj['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                            <span class="tecnologias-tag"><?= $ico_tag ?> <?= htmlspecialchars($proj['tecnologias'], ENT_QUOTES, 'UTF-8') ?></span>
                            <a href="?pagina=projeto&id=<?= $id ?>" class="btn-link">Ver detalhes <?= $ico_arrow_right ?></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($pagina === 'projeto' && $projeto_encontrado !== null): ?>
            <article class="card projeto-detalhe">
                <div class="breadcrumb">
                    <a href="?pagina=projetos" class="btn-voltar"><?= $ico_arrow_left ?> Voltar para Projetos</a>
                </div>
                <h2><?= htmlspecialchars($projeto_encontrado['titulo'], ENT_QUOTES, 'UTF-8') ?></h2>
                <div class="projeto-info-completa">
                    <div class="bloco-texto">
                        <h3>Descrição do Projeto</h3>
                        <p class="projeto-descricao-detalhada"><?= htmlspecialchars($projeto_encontrado['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="bloco-tecnologias">
                        <h3>Tecnologias Empregadas</h3>
                        <p class="tecnologias-tag"><?= $ico_tag ?> <?= htmlspecialchars($projeto_encontrado['tecnologias'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            </article>

        <?php elseif ($mensagem_erro_404 !== null): ?>
            <section class="card erro-404">
                <div class="icon-404"><?= $ico_search_x ?></div>
                <span class="codigo-status">404</span>
                <h2><?= htmlspecialchars($mensagem_erro_404, ENT_QUOTES, 'UTF-8') ?></h2>
                <p>O endereço ou recurso informado não foi localizado no servidor.</p>
                <a href="?pagina=inicio" class="btn-link"><?= $ico_home ?> Página Inicial</a>
            </section>
        <?php endif; ?>
    </main>

    <!-- 7. Rodapé -->
    <footer class="rodape">
        <div class="container container-rodape">
            <p>Tema atual: <strong><?= $tema === 'escuro' ? 'Escuro' : 'Claro' ?></strong></p>
            <p><a href="?formato=json" class="link-api" target="_blank"><?= $ico_json ?> Versão JSON (API)</a></p>
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil['nome'], ENT_QUOTES, 'UTF-8') ?>. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
