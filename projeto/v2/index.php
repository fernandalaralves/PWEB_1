<?php
class Projeto {
    private string $titulo;
    private string $descricao;
    private string $tecnologias;

    public function __construct(string $titulo, string $descricao, string $tecnologias) {
        // Validação R2: título não pode ser vazio
        if (trim($titulo) === '') {
            throw new Exception('O projeto precisa de um título');
        }
        
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->tecnologias = $tecnologias;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getTecnologias(): string {
        return $this->tecnologias;
    }

    public function paraArray(): array {
        return [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tecnologias' => $this->tecnologias,
        ];
    }
}
// ============================================================
// 2. OS OBJETOS
// ============================================================
$perfil = new Perfil(
    'Fernanda Lara Alves de Oliveira',
    'Análise e Desenvolvimento de Sistemas',
    'IFCE Campus Boa Viagem',
    'Boa Viagem – CE',
    'Sou estudante com interesse em desenvolvimento backend, em cibersegurança e QA. Gosto de construir sistemas que resolvem problemas reais.',
    ['Java', 'Spring Boot', 'PostgreSQL', 'JavaScript', 'C', 'Python', 'Vercel', 'Railway', 'Cypress', 'K6']
);

$perfil->adicionarProjeto(new Projeto(
    'Pure Seduction Lux',
    'Sistema de e-commerce completo — loja virtual e painel administrativo — com API REST, autenticação JWT e banco de dados relacional PostgreSQL.',
    'Node.js, Express, React, Vite, PostgreSQL, JWT, Argon2id'
));

$perfil->adicionarProjeto(new Projeto(
    'A Aventura de Maya na Internet',
    'Jogo educativo de cibersegurança para crianças de 8 a 14 anos, com narrativa interativa em que a personagem Maya restaura a internet completando missões.',
    'Vite 5, Vanilla JS, Web Components, Shadow DOM, Tailwind CSS, LocalStorage'
));

$perfil->adicionarProjeto(new Projeto(
    'LUNETRAS',
    'Plataforma educacional para acompanhamento do processo de alfabetização (psicogênese da língua escrita). Atuei no backend mobile em Java/Spring Boot, com autenticação JWT, rate limiting e integração com IA (LUN.AI).',
    'Java, Spring Boot, Spring Data JPA, Spring Security, JWT, Bucket4j, Lombok, Argon'
));

class Perfil {
    private string $nome;
    private string $curso;
    private string $campus;
    private string $cidade;
    private string $apresentacao;
    private array $habilidades;
    private array $projetos = []; // começa vazio

    public function __construct(
        string $nome, string $curso, string $campus, string $cidade, 
        string $apresentacao, array $habilidades
    ) {
        // Validação R3: pelo menos 5 habilidades
        if (count($habilidades) < 5) {
            throw new Exception('O perfil precisa de pelo menos 5 habilidades');
        }

        $this->nome = $nome;
        $this->curso = $curso;
        $this->campus = $campus;
        $this->cidade = $cidade;
        $this->apresentacao = $apresentacao;
        $this->habilidades = $habilidades;
    }

    public function adicionarProjeto(Projeto $projeto): void {
        // R3: numera a partir de 1
        $this->projetos[count($this->projetos) + 1] = $projeto;
    }

    public function getProjeto(int $id): Projeto {
        if (!isset($this->projetos[$id])) {
            throw new Exception('Projeto não encontrado');
        }
        return $this->projetos[$id];
    }

    // Getters
    public function getNome(): string { return $this->nome; }
    public function getCurso(): string { return $this->curso; }
    public function getCampus(): string { return $this->campus; }
    public function getCidade(): string { return $this->cidade; }
    public function getApresentacao(): string { return $this->apresentacao; }
    public function getHabilidades(): array { return $this->habilidades; }
    public function getProjetos(): array { return $this->projetos; }

    public function paraArray(): array {
        $projetosArray = [];
        foreach ($this->projetos as $id => $projeto) {
            $projetosArray[$id] = $projeto->paraArray();
        }

        return [
            'nome' => $this->nome,
            'curso' => $this->curso,
            'campus' => $this->campus,
            'cidade' => $this->cidade,
            'apresentacao' => $this->apresentacao,
            'habilidades' => $this->habilidades,
            'projetos' => $projetosArray,
        ];
    }
}

$perfilArray = $perfil->paraArray();
$projetos = $perfil->getProjetos();

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
    $dadosPerfil = $perfilArray;
    unset($dadosPerfil['projetos']);
    echo json_encode(
        ['perfil' => $dadosPerfil, 'projetos' => $perfilArray['projetos']],
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
    <title><?= e($perfil->getNome()) ?> — Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="tema-<?= e($tema) ?>">

<!-- menu e cabecalho -->

    <header class="cabecalho">
        <div class="container cabecalho__inner">
            <a href="?pagina=inicio" class="logo"><?= e($perfil->getNome()) ?></a>
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
                <p class="hero__sub">
            <?= e($perfil->getNome()) ?> — <?= e($perfil->getCurso()) ?>
    |       <?= e($perfil->getCampus()) ?>
                </p>

            <!-- sobre mim -->
                <p class="sobre__texto"><?= e($perfil->getApresentacao()) ?></p>
                <p class="sobre__local">Boa Viagem - CE <?= e($perfil->getCidade()) ?></p>

        <?php elseif ($pagina === 'habilidades'): ?>

            <!-- habilidades -->
            <ul class="grid-habilidades">
        <?php foreach ($perfil->getHabilidades() as $h): ?>
             <li class="pill"><?= e($h) ?></li>
        <?php endforeach; ?>
                </ul>

        <?php elseif ($pagina === 'projetos'): ?>

            <!-- projetos -->
            <section class="secao">
                <div class="grid-projetos">
         <?php foreach ($perfil->getProjetos() as $id => $p): ?>
        <article class="card-projeto">
            <h3 class="card-projeto__titulo"><?= e($p->getTitulo()) ?></h3>
            <p class="card-projeto__desc"><?= e($p->getDescricao()) ?></p>
            <ul class="tags">
                <?php foreach (explode(',', $p->getTecnologias()) as $t): ?>
                    <li><?= e(trim($t)) ?></li>
                <?php endforeach; ?>
            </ul>
            <a class="card-projeto__link" href="?pagina=projeto&id=<?= e($id) ?>">
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
                <h2 class="secao__titulo"><?= e($projetoAtual->getTitulo()) ?></h2>
                <p class="detalhe__desc"><?= e($projetoAtual->getDescricao()) ?></p>

                <h3 class="detalhe__sub">Tecnologias</h3>
                <ul class="tags tags--grandes">
                    <?php foreach (explode(', ', $projetoAtual->getTecnologias()) as $tecnologia): ?>
                        <li><?= e($tecnologia) ?></li>
                    <?php endforeach; ?>
                </ul>

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
            <p>© <?= date('Y') ?> <?= e($perfil->getNome()) ?></p>
            <p class="rodape__link">
                <a href="?formato=json">Versão JSON</a>
                <a href="https://github.com/fernandalaralves" target="_blank">GitHub</a>
            </p>
        </div>
    </footer>

</body>
</html>