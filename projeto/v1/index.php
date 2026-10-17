<?php
$perfil = [
    'nome'         => 'Fernanda Lara Alves de Oliveira',
    'curso'        => 'Análise e Desenvolvimento de Sistemas',
    'campus'       => 'IFCE Campus Boa Viagem',
    'cidade'       => 'Boa Viagem – CE',
    'apresentacao' => 'Sou estudante com interesse em '
                    . 'desenvolvimento backend,'
                    . ' em cibersegurança e QA. '
                    . 'Gosto de construir sistemas que resolvem problemas reais. ',
    'habilidades'  => [
        'Java', 'Spring Boot', 'PostgreSQL', 'JavaScript',
        'C', 'Python', 'Vercel', 'Railway', 'Cypress', 'K6',
    ],
];

$projetos = [
    1 => [
        'titulo'      => 'Pure Seduction Lux',
        'descricao'   => 'Sistema de e-commerce completo — loja virtual e painel '
                       . 'administrativo — com API REST, autenticação JWT e banco '
                       . 'de dados relacional PostgreSQL.',
        'tecnologias' => ['Node.js', 'Express', 'React', 'Vite', 'PostgreSQL', 'JWT', 'Argon2id'],
        'link'        => 'https://pureseductionlux.com.br',
        'privado'     => false,
    ],
    2 => [
        'titulo'      => 'A Aventura de Maya na Internet',
        'descricao'   => 'Jogo educativo de cibersegurança para crianças de 8 a 14 '
                       . 'anos, com narrativa interativa em que a personagem Maya '
                       . 'restaura a internet completando missões.',
        'tecnologias' => ['Vite 5', 'Vanilla JS', 'Web Components', 'Shadow DOM', 'Tailwind CSS', 'LocalStorage'],
        'link'        => 'https://github.com/fernandalaralves/A-Aventura-de-Maya-na-Internet',
        'privado'     => false,
    ],
    3 => [
        'titulo'      => 'LUNETRAS',
        'descricao'   => 'Plataforma educacional para acompanhamento do processo de '
                       . 'alfabetização (psicogênese da língua escrita). Atuei no '
                       . 'backend mobile em Java/Spring Boot, com autenticação JWT, '
                       . 'rate limiting e integração com IA (LUN.AI).',
        'tecnologias' => ['Java', 'Spring Boot', 'Spring Data JPA', 'Spring Security', 'JWT', 'Bucket4j', 'Lombok', 'Argon'],
        'link'        => null,
        'privado'     => true,
    ],
];

//tema: claro ou escuro (R6)
$tema = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'escuro';

// R6: validação — só aceita 'claro' ou 'escuro'
if ($tema !== 'claro' && $tema !== 'escuro') {
    $tema = 'escuro';
}

// Se veio pela URL, grava cookie de 30 dias.
// (setcookie não aparece em $_COOKIE na mesma requisição — só na próxima.)
if (isset($_GET['tema'])) {
    setcookie('tema', $tema, [
        'expires'  => time() + (30 * 24 * 60 * 60),
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

if (($_GET['formato'] ?? null) === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        ['perfil' => $perfil, 'projetos' => $projetos],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
    exit;
}

header('Content-Type: text/html; charset=utf-8');

$proximoTema = $tema === 'escuro' ? 'claro' : 'escuro';



// pagina a mostrar
$pagina = $_GET['pagina'] ?? 'inicio';
// Status HTTP padrão; pode virar 404 mais abaixo
$status = 200;

// Rota de detalhe de projeto (R4)
$projetoAtual = null;
$projetoId = null;
if ($pagina === 'projeto') {
    $projetoId = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
    if (is_int($projetoId) && isset($projetos[$projetoId])) {
        $projetoAtual = $projetos[$projetoId];
    } else {
        $status = 404;
    }
}

// Rota desconhecida → 404 (R3)
if (!in_array($pagina, ['inicio', 'habilidades', 'projetos', 'projeto'], true)) {
    $status = 404;
}

// Define o status ANTES de qualquer HTML
http_response_code($status);



// htmlspecialchars em toda saída (R6)
function e($texto) {
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($perfil['nome']) ?> — Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="tema-<?= e($tema) ?>">

<!-- menu e cabecalho -->

    <header class="cabecalho">
        <div class="container cabecalho__inner">
            <a href="?pagina=inicio" class="logo"><?= e($perfil['nome']) ?></a>
            <nav class="menu">
                <a href="?pagina=inicio">Início</a>
                <a href="?pagina=habilidades">Habilidades</a>
                <a href="?pagina=projetos">Projetos</a>
                 </nav>
            <div class="cabecalho__acoes">
                <a class="btn-tema"
                         href="?pagina=<?= e($pagina) ?><?= $projetoId !== null && $projetoAtual !== null ? '&id=' . e($projetoId) : '' ?>&tema=<?= e($proximoTema) ?>">
                    Trocar Tema
                </a>
          </div> 
        </div>
    </header>

    <!-- conteudo -->
    <main class="container">

        <?php if ($pagina === 'inicio'): ?>

            <!-- ---------- HERO ---------- -->
            <section class="hero">
                <span class="badge">
                    <span class="pulso"></span> Disponível para estágio
                </span>
                <h1 class="hero__titulo">
                    Desenvolvendo sistemas,<br>
                    aprendendo <span class="grad">todos os dias.</span>
                </h1>
                <p class="hero__sub">
                    <?= e($perfil['nome']) ?> — <?= e($perfil['curso']) ?>
                    | <?= e($perfil['campus']) ?>
                </p>
                <a href="https://github.com/fernandalaralves" class="btn-primario" target="_blank" rel="noopener noreferrer">CONECTE-SE COMIGO →</a>
            </section>

            <!-- sobre mim -->
            <section class="sobre">
                <p class="secao__eyebrow">SOBRE MIM</p>
                <img
                    src="foto-perfil.jpeg"
                    alt="Foto de Fernanda"
                    class="sobre__foto"
                >
                <p class="sobre__texto"><?= e($perfil['apresentacao']) ?></p>
            </section>

        <?php elseif ($pagina === 'habilidades'): ?>

            <!-- habilidades -->
            <section class="secao">
                <p class="secao__eyebrow">EXPERIÊNCIA & FERRAMENTAS</p>
                <h2 class="secao__titulo">Habilidades</h2>
                <p class="secao__sub"> <?= count($perfil['habilidades']) ?> habilidades</p>

                <ul class="grid-habilidades">
                    <?php foreach ($perfil['habilidades'] as $habilidade): ?>
                        <li class="pill"><?= e($habilidade) ?></li>
                    <?php endforeach; ?>
                </ul>

            </section>

        <?php elseif ($pagina === 'projetos'): ?>

            <!-- projetos -->
            <section class="secao">
                <p class="secao__eyebrow">PORTFÓLIO</p>
                <h2 class="secao__titulo">Projetos</h2>

                <div class="grid-projetos">
                    <?php foreach ($projetos as $id => $projeto): ?>
                        <article class="card-projeto">
                            <h3 class="card-projeto__titulo"><?= e($projeto['titulo']) ?></h3>
                            <p class="card-projeto__desc"><?= e($projeto['descricao']) ?></p>
                            <p class="card-projeto__tecnologias">
                                Tecnologias: <?= e(implode(' · ', array_slice($projeto['tecnologias'], 0, 3))) ?>
                            </p>
                            <a class="card-projeto__link"
                               href="?pagina=projeto&id=<?= e($id) ?>">
                                Ver detalhes →
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
                    <?php elseif ($pagina === 'projeto' && $projetoAtual !== null): ?>

            <!-- ---------- detalhes de um projetoo (R4) ---------- -->
            <section class="secao detalhe">
                <p class="secao__eyebrow">PROJETO</p>
                <h2 class="secao__titulo"><?= e($projetoAtual['titulo']) ?></h2>
                <p class="detalhe__desc"><?= e($projetoAtual['descricao']) ?></p>

                <h3 class="detalhe__sub">Tecnologias</h3>
                <ul class="tags tags--grandes">
                    <?php foreach ($projetoAtual['tecnologias'] as $tecnologia): ?>
                        <li><?= e($tecnologia) ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if ($projetoAtual['privado']): ?>
                    <p class="aviso-privado"> Repositório privado</p>
                <?php elseif ($projetoAtual['link']): ?>
                    <a class="btn-primario" target="_blank"
                       href="<?= e($projetoAtual['link']) ?>">
                        Abrir projeto →
                    </a>
                <?php endif; ?>

                <p class="voltar">
                    <a href="?pagina=projetos">← Voltar para projetos</a>
                </p>
            </section>

        <?php elseif ($pagina === 'projeto'): ?>

            <!-- ---------- projeto nao encontrado (404) ---------- -->
            <section class="secao erro-404">
                <p class="secao__eyebrow">ERRO 404</p>
                <h2 class="secao__titulo">Projeto não encontrado</h2>
                <p>O projeto <code>#<?= e($_GET['id'] ?? '?') ?></code> não existe.</p>
                <a href="?pagina=projetos" class="btn-primario">Ver todos os projetos</a>
            </section>

        <?php else: ?>

            <!-- ---------- pagina nao encontrada (404) ---------- -->
            <section class="secao erro-404">
                <p class="secao__eyebrow">ERRO 404</p>
                <h2 class="secao__titulo">Página não encontrada</h2>
                <p>A rota <code><?= e($pagina) ?></code> não existe neste site.</p>
                <a href="?pagina=inicio" class="btn-primario">Voltar para o início</a>
            </section>

        <?php endif; ?>

    </main>

    <footer class="rodape">
        <div class="container rodape__inner">
            <p>© <?= date('Y') ?> <?= e($perfil['nome']) ?></p>
            <p class="rodape__link">
                <a href="?formato=json">Versão JSON</a>
                <a href="https://github.com/fernandalaralves" target="_blank">GitHub</a>
            </p>
        </div>
    </footer>

</body>
</html>