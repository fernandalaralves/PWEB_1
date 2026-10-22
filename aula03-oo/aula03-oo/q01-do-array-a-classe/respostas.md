# Questão 01: Do array à classe

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `livro-array.php` | Fornecido: o livro em array associativo |
| `livro.php` | Você cria: a classe `Livro` e dois objetos |

## 1. Análise do código

**1.1 Explique a declaração `public float $preco;`: o que é cada uma das três partes?**

public = visibilidade (acessível de fora da classe); float = tipo do valor (número decimal); $preco = nome do atributo. Assim, o PHP (com strict_types=1) aceita só valores float nesse atributo.

**1.2 Compare `$livro['titulo']` (array) e `$livro1->titulo` (objeto). O que muda na escrita e o que muda no que o PHP garante?**

No array, a chave é uma string 'titulo' e qualquer valor cabe ali. No objeto, ->titulo é um atributo tipado: o PHP garante o tipo declarado (por exemplo, int no ano) e recusa string quando strict_types está ligado. Ou seja: a escrita muda (['chave'] vs ->prop) e a segurança de tipos muda.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q01-do-array-a-classe/livro.php`

```text
(cole aqui a saída do terminal)
```

**Explicação:**

 Explicação: cada echo interpola os atributos do objeto com ->; var_dump mostra o tipo do objeto, o nome da classe e os valores dos atributos.

**2.2 Erro ao atribuir o ano como texto (item 5)**

```text
Fatal error: Uncaught TypeError: Cannot assign string to property Livro::$ano of type int
```

**Explicação:**

Explicação: strict_types=1 impede conversão automática. Sem ele, '1938' viraria 1938 silenciosamente.

## 3. Perguntas

**a) Quantas classes e quantos objetos existem no seu `livro.php`?**

 1 classe (Livro) e 2 objetos ($livro1 e $livro2)

**b) No `var_dump`, o que significam `object(Livro)#2` e o `(5)`?**

object(Livro)#2 = o valor é um objeto da classe Livro e é o 2º objeto criado na execução (o #2 é o ID interno do objeto). (5) = o objeto tem 5 atributos declarados

**c) O que o `declare(strict_types=1)` mudou no resultado do item 5?**

Sem strict_types=1, '1938' seria coagido (conversão automática) para 1938 e não daria erro. Com strict_types=1, o PHP recusa e lança TypeError, obrigando a passar o tipo correto
