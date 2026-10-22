<?php
declare(strict_types=1);

class Aluno
{
    public function __construct(
        private string $nome,
        private float $nota1,
        private float $nota2
    ) {
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
            throw new Exception("Nota inválida para {$this->nome}: use valores de 0 a 10.");
        }
    }

    public function getNome(): string { return $this->nome; }

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $m = $this->calcularMedia();
        if ($m >= 7) return 'Aprovado';
        if ($m >= 4) return 'Recuperação';
        return 'Reprovado';
    }
}

class Disciplina
{
    private array $alunos = [];

    public function __construct(private string $nome) {}

    public function getNome(): string { return $this->nome; }
    public function getAlunos(): array { return $this->alunos; }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function calcularMediaTurma(): float
    {
        if (count($this->alunos) === 0) return 0.0;
        $soma = 0.0;
        foreach ($this->alunos as $a) $soma += $a->calcularMedia();
        return $soma / count($this->alunos);
    }

    public function contarAprovados(): int
    {
        $n = 0;
        foreach ($this->alunos as $a) {
            if ($a->situacao() === 'Aprovado') $n++;
        }
        return $n;
    }
}

// ---- lógica no topo ----
$pweb = new Disciplina('Programação Web I');
$pweb->adicionarAluno(new Aluno('Ana', 8.0, 9.5));
$pweb->adicionarAluno(new Aluno('Bruno', 5.0, 6.0));
$pweb->adicionarAluno(new Aluno('Caio', 2.5, 3.0));
$pweb->adicionarAluno(new Aluno('Daniela', 7.0, 7.0));

$erro = null;
if (isset($_GET['teste']) && $_GET['teste'] === '1') {
    try {
        $pweb->adicionarAluno(new Aluno('Eduardo', 11.0, 9.0));
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><title>Turma</title></head>
<body>
<?php if ($erro !== null): ?>
    <p style="color:red"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>
<h1><?= htmlspecialchars($pweb->getNome()) ?></h1>
<table border="1">
    <tr><th>Aluno</th><th>Média</th><th>Situação</th></tr>
    <?php foreach ($pweb->getAlunos() as $a): ?>
    <tr>
        <td><?= htmlspecialchars($a->getNome()) ?></td>
        <td><?= number_format($a->calcularMedia(), 1, ',', '.') ?></td>
        <td><?= $a->situacao() ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p>Média da turma: <?= number_format($pweb->calcularMediaTurma(), 2, ',', '.') ?></p>
<p>Aprovados: <?= $pweb->contarAprovados() ?> de <?= count($pweb->getAlunos()) ?></p>
</body>
</html>