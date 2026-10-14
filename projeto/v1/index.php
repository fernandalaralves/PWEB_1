<?php
$perfil = [
    'nome'         => 'Fernanda Lara Alves de Oliveira',
    'curso'        => 'Análise e Desenvolvimento de Sistemas',
    'campus'       => 'IFCE Campus Boa Viagem',
    'cidade'       => 'Boa Viagem – CE',
    'apresentacao' => 'Sou estudante com interesse em '
                    . 'desenvolvimento backend, em cibersegurança e QA'
                    . 'Gosto de construir sistemas que resolvem problemas reais. ',
    'habilidades'  => [
        'Java', 'Spring Boot', 'PostgreSQL', 'JavaScript',
        'C', 'Python', 'Vercel', 'Railway', 'Cypress', 'K6',
    ],
];

$projetos = [
    1 => [
        'titulo'      => 'pure_seduction_lux',
        'descricao'   => 'Sistema de e-commerce completo — loja virtual e painel '
                       . 'administrativo — com API REST, autenticação JWT e banco '
                       . 'de dados relacional PostgreSQL.',
        'tecnologias' => 'Node.js, Express, React, Vite, PostgreSQL, JWT, Argon2id',
        'link'        => 'https://pureseductionlux.com.br',
        'privado'     => false,
    ],
    2 => [
        'titulo'      => 'A Aventura de Maya na Internet',
        'descricao'   => 'Jogo educativo de cibersegurança para crianças de 8 a 14 '
                       . 'anos, com narrativa interativa em que a personagem Maya '
                       . 'restaura a internet completando missões.',
        'tecnologias' => 'Vite 5, Vanilla JS, Web Components, Shadow DOM, Tailwind CSS, LocalStorage',
        'link'        => 'https://github.com/fernandalaralves/A-Aventura-de-Maya-na-Internet',
        'privado'     => false,
    ],
    3 => [
        'titulo'      => 'LUNETRAS',
        'descricao'   => 'Plataforma educacional para acompanhamento do processo de '
                       . 'alfabetização (psicogênese da língua escrita). Atuei no '
                       . 'backend mobile em Java/Spring Boot, com autenticação JWT, '
                       . 'rate limiting e integração com IA (LUN.AI).',
        'tecnologias' => 'Java, Spring Boot, Spring Data JPA, Spring Security, JWT, Bucket4j, Lombok, Argon',
        'link'        => null,
        'privado'     => true,
    ],
];


// pagina a mostrar
$pagina = $_GET['pagina'] ?? 'inicio';



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
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-escuro">

//menu e cabecalho 

    <header class="cabecalho">
        <div class="container cabecalho__inner">
            <a href="?pagina=inicio" class="logo"><?= e($perfil['nome']) ?></a>
            <nav class="menu">
                <a href="?pagina=inicio">Início</a>
                <a href="?pagina=habilidades">Habilidades</a>
                <a href="?pagina=projetos">Projetos</a>
            </nav>
        </div>
    </header>

    //conteudo 
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
                <a href="?pagina=projetos" class="btn-primario">CONECTE-SE COMIGO →</a>
            </section>

         //sobre mim
            <section class="sobre">
                <p class="secao__eyebrow">SOBRE MIM</p>
                <h2 class="secao__titulo">Código com propósito.</h2>
                <p class="sobre__texto"><?= e($perfil['apresentacao']) ?></p>
                <p class="sobre__local"><?= e($perfil['cidade']) ?></p>
            </section>

        <?php else: ?>

            //rotas para implementar
            <section class="secao">
                <h2 class="secao__titulo">Em construção</h2>
                <p>A página <code><?= e($pagina) ?></code> ainda será implementada.</p>
            </section>

        <?php endif; ?>

    </main>

    <footer class="rodape">
        <div class="container rodape__inner">
            <p>© <?= date('Y') ?> <?= e($perfil['nome']) ?></p>
            <p class="rodape__links">
                <a href="https://github.com/fernandalaralves" target="_blank">GitHub</a>
            </p>
        </div>
    </footer>

</body>
</html>