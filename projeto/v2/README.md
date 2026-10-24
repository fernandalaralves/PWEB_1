# Projeto V2 — Perfil com Classes

**Fernanda Lara Alves de Oliveira** · ADS · IFCE Campus Boa Viagem
Programação Web I — Prof. Dr. Renato William Rodrigues de Souza

Mesmo site da v1, mas reescrito com **classes em PHP**. Arrays associativos
viraram objetos com atributos privados, getters, validação e try/catch.

---

## Como rodar

```bash
cd projeto/v2
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

---

## Telas

**Tema claro**
![Tema claro](prints/claro.png)

**Tema escuro**
![Tema escuro](prints/escuro.png)

---

## As classes

### Classe `Projeto`

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$titulo` | string | private |
| `$descricao` | string | private |
| `$tecnologias` | string | private |

| Método | O que faz |
|---|---|
| `__construct($t,$d,$t)` | Valida título e guarda os dados |
| `getTitulo()` | Retorna o título |
| `getDescricao()` | Retorna a descrição |
| `getTecnologias()` | Retorna as tecnologias |
| `paraArray()` | Devolve os dados em array associativo |

### Classe `Perfil`

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$nome` | string | private |
| `$curso` | string | private |
| `$campus` | string | private |
| `$cidade` | string | private |
| `$apresentacao` | string | private |
| `$habilidades` | array | private |
| `$projetos` | array | private |

| Método | O que faz |
|---|---|
| `__construct(...)` | Valida habilidades e guarda os dados |
| `adicionarProjeto(Projeto)` | Adiciona um projeto, numerando a partir de 1 |
| `getProjeto(int)` | Devolve o projeto ou lança exceção |
| Getters | Para cada atributo |
| `paraArray()` | Devolve tudo em array, com projetos convertidos |

---

## Antes e depois

**V1 — 404 de projeto com `isset`:**
```php
if (isset($projetos[$id])) {
    $projetoAtual = $projetos[$id];
} else {
    $status = 404;
}
```

**V2 — 404 de projeto com `try/catch`:**
```php
try {
    $projetoAtual = $perfil->getProjeto($id);
} catch (Exception $e) {
    http_response_code(404);
    $tituloErro = $e->getMessage();
}
```

**O que melhorou:** agora quem decide se o projeto existe é o próprio
`Perfil` (encapsulamento). O código de fora não sabe onde os projetos estão
guardados — só pede e trata o erro.

---

## As classes se recusam

### Título vazio
```
Fatal error: Uncaught Exception: O projeto precisa de um título
```
Lançado no construtor de `Projeto` quando `trim($titulo) === ''`. O objeto
**não chega a existir**.

### Menos de 5 habilidades
```
Fatal error: Uncaught Exception: O perfil precisa de pelo menos 5 habilidades
```
Lançado no construtor de `Perfil` quando `count($habilidades) < 5`. O objeto
**não chega a existir**.

---

## Saídas do terminal

### Projeto que existe (id=2)
```bash
curl.exe -i "http://localhost:8000/?pagina=projeto&id=2"
```
```
HTTP/1.1 200 OK
Content-Type: text/html; charset=UTF-8
...
<h2 class="secao__titulo">A Aventura de Maya na Internet</h2>
```

### Projeto que não existe (id=99)
```bash
curl.exe -i "http://localhost:8000/?pagina=projeto&id=99"
```
```
HTTP/1.1 404 Not Found
...
<h2 class="secao__titulo">Projeto não encontrado</h2>
```

### API em JSON
```bash
curl.exe -i "http://localhost:8000/?formato=json"
```
```
HTTP/1.1 200 OK
Content-Type: application/json; charset=utf-8

{
    "nome": "Fernanda Lara Alves de Oliveira",
    "projetos": { "1": {...}, "2": {...}, "3": {...} }
}
```

---

## Perguntas

**(a) Por que `json_encode($perfil)` devolve `{}`?**
Porque os atributos são `private`. O `json_encode` só enxerga atributos
públicos. Por isso criamos `paraArray()`.

**(b) Os objetos `$perfil` e `$projeto` continuam na memória depois?**
Não. PHP é *stateless*: cada requisição cria os objetos do zero e, ao final
do script, eles são destruídos. Por isso recriamos tudo toda vez.

**(c) Por que `private`, e não `public`?**
Para encapsular: ninguém de fora pode mexer direto nos atributos. Só
através dos getters e métodos. Isso protege a integridade dos dados e
permite validar no construtor.

---

## Commits

```
chore(projeto-v2): copia a versão 1 como ponto de partida
feat(projeto-v2): cria a classe Projeto com validação
feat(projeto-v2): cria a classe Perfil com a lista de projetos
refactor(projeto-v2): troca os arrays pelos objetos no HTML
refactor(projeto-v2): usa getProjeto com try/catch para o 404
refactor(projeto-v2): gera o JSON com paraArray
docs(projeto-v2): documenta classes, validações e saídas
```