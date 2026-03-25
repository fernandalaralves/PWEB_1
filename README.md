#  Programação Web I — Unidade 1 (PHP Procedural)

Repositório criado para armazenar as atividades práticas da Unidade 1 da disciplina Programação Web I, utilizando PHP procedural.

Curso: Análise e Desenvolvimento de Sistemas  
Instituição: Instituto Federal de Educação, Ciência e Tecnologia do Ceará (IFCE)
Disciplina: Programação Web I  
Professor: Renato William Rodrigues de Souza  

---

#  Objetivo

Aplicar os conceitos fundamentais de:

- PHP procedural
- Formulários HTML
- Estruturas condicionais
- Estruturas de repetição
- Sessões (`$_SESSION`)
- Cookies (`$_COOKIE`)
- Validação de dados
- Manipulação de arrays

---

#  Estrutura do Repositório

unidade-1/
│
├── atividade-1-classificacao/
│ └── classificacao.php
│
├── atividade-2-formulario/
│ └── formulario.php
│
├── atividade-3-login/
│ ├── login.php
│ ├── painel.php
│ └── logout.php
│
├── atividade-4-cookies/
│ └── cookies.php
│
├── atividade-5-desafio-integrador/
│ ├── login.php
│ ├── painel.php
│ ├── logout.php
│ └── style.css
│
└── README.md


---

#  Descrição das Atividades

##  Atividade 1 — Classificação Acadêmica

Sistema que recebe a nota de um aluno e informa sua situação:

- Nota ≥ 7 → Aprovado  
- Nota ≥ 5 e < 7 → Recuperação  
- Nota < 5 → Reprovado  

Também exibe todas as notas de 0 até a nota informada utilizando estrutura de repetição.

**Conceitos utilizados:**

- Variáveis  
- Estrutura condicional (`if/else`)  
- Estrutura de repetição (`for`)  
- Função em PHP  
- Saída formatada em HTML  

---

##  Atividade 2 — Cadastro via Formulário

Formulário para coleta de dados de alunos:

- Nome  
- E-mail  
- Curso  
- Turno  

O sistema valida se todos os campos foram preenchidos e exibe os dados organizados na tela.

**Conceitos utilizados:**

- Método POST  
- Validação de campos  
- Estrutura condicional  
- Exibição de dados  

---

##  Atividade 3 — Sistema de Login

Sistema de autenticação com acesso restrito.

Credenciais:

Usuário: **admin**  
Senha: **1234**

Após o login, o usuário acessa uma página protegida.

**Conceitos utilizados:**

- `session_start()`  
- `$_SESSION`  
- Controle de acesso  
- Redirecionamento (`header()`)  
- Logout  

---

##  Atividade 4 — Controle com Cookies

Sistema que memoriza o nome do usuário utilizando cookies.

O cookie permanece armazenado por 7 dias, exibindo mensagem personalizada nos próximos acessos.

**Conceitos utilizados:**

- `setcookie()`  
- `$_COOKIE`  
- Validade de cookie  
- Verificação de existência  

---

##  Atividade 5 — Desafio Integrador

Mini sistema contendo:

- Login com sessão  
- Cadastro via formulário  
- Validação de dados  
- Armazenamento temporário em array  
- Exibição dos registros cadastrados  
- Interface com CSS  

**Conceitos utilizados:**

- Sessões  
- Arrays  
- Funções  
- Formulários  
- Estilização com CSS  

---

#  Tecnologias Utilizadas

- PHP (Procedural)
- HTML5
- CSS3
- XAMPP (Apache + PHP)
- Navegador Web

---

#  Como Executar o Projeto

1. Instalar o **XAMPP**
2. Iniciar o **Apache**
3. Copiar a pasta `unidade-1` para:
