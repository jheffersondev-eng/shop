<?php

namespace App\Services\Chatbot;

/**
 * Base de conhecimento do chatbot sobre o sistema Porto Shop
 * Fornece contexto completo sobre a plataforma para melhorar significativamente as respostas
 */
class ChatbotKnowledgeBase
{
    /**
     * Obtém informações sobre Jhefferson Matheus como desenvolvedor
     */
    public static function getDeveloperInfo(): string
    {
        return <<<'DEVINFO'
## 👨‍💻 Sobre o Desenvolvedor - Jhefferson Matheus

**Nome Completo**: Jhefferson Matheus Silva  
**Localização**: Sergipe, Brasil  
**Experiência**: 5+ anos (desde 2017)  
**Formação**: Análise e Desenvolvimento de Sistemas + Técnico em Informática pelo SENAI

### ✨ Sobre Profissionalmente:
Jhefferson é um desenvolvedor full-stack especializado em criar soluções bem estruturadas, escaláveis e preparadas para ambientes complexos. Ele está **aberto a novas oportunidades e colaborações**.

### 🎯 Áreas de Especialidade:

**Backend:**
- PHP/Laravel (96%)
- C#/ASP.NET Core (92%)
- ASP.NET MVC (90%)
- APIs RESTful (94%)
- Injeção de Dependência (93%)
- Task Scheduler (88%)

**Frontend:**
- HTML5 (95%)
- CSS3/SCSS (93%)
- JavaScript (94%)
- TypeScript (85%)
- React (90%)
- Vue.js (88%)
- Bootstrap (92%)
- Responsive Design (95%)

**Banco de Dados:**
- MySQL (94%) - Otimização de queries
- SQL Server (91%) - Procedure e otimização
- Entity Framework Core (90%)
- Query Optimization (89%)

**Arquitetura & Padrões:**
- SOLID Principles (92%)
- Clean Architecture (90%)
- MVC Architecture (94%)
- Clean Code (91%)
- Design Patterns (88%)

**DevOps & Cloud:**
- Docker (89%)
- AWS (Lambda, S3) (85%)
- Git/GitHub (95%)
- CI/CD Pipelines (86%)
- Linux/Windows (90%)

**Metodologias:**
- Scrum (92%)
- Kanban (90%)
- Agile (91%)
- RBAC - Controle de Acesso (90%)

**Conhecimentos Adicionais:**
- Lógica de Programação (95%)
- Multi-tenant (88%)
- Internet Banking (85%)
- Setor Financeiro (87%)
- B2B Systems (89%)
- E-commerce (91%)
- Controle de Estoque (86%)
- JWT Authentication (89%)
- Microsserviços (85%)
- API Integration (92%)
- Arduino (78%)
- C++ (82%)

### 💼 Experiência Profissional:

**1. DEL TECH LTDA (Julho 2024 - Setembro 2025)**
- Desenvolvedor Full-Stack
- Sistemas B2B em ASP.NET MVC com Clean Architecture
- Interfaces dinâmicas com React
- Integração com SQL Server e Entity Framework Core
- APIs RESTful em ASP.NET Core
- Integração AWS (Lambda, S3) com Docker
- Node.js/Express.js

**2. JAV Industria De Alimentos LTDA (Fevereiro 2022 - Junho 2024)**
- Desenvolvedor Full-Stack
- PHP/Laravel com SOLID e Clean Code
- Otimização de queries MySQL
- Interfaces, relatórios e microsserviços
- Domínios: alimentação, controle de acessos, gestão agropecuária, e-commerce, construção civil
- Task Scheduler em Linux
- Ambientes Windows e Linux

**3. MRC Solucoes em TI e Desenvolvimento (Agosto 2019 - Fevereiro 2022)**
- Instrutor de Tecnologia
- Aulas: Informática, Lógica, Low-Code, Arduino, C++
- Técnico de Robótica
- Prêmios em competições de robótica
- Capacitação de 50+ mil professores durante pandemia

**4. IPTI (Agosto 2017 - Novembro 2018)**
- Desenvolvedor PHP
- Manutenção e evolução de plataforma educacional
- Scrum e boas práticas desde o início
- Front-end responsivo

### 📊 Projetos & Realizações:
- **12+ Projetos** com atuação significativa
- Desenvolveu **tudo neste site** (Porto Shop) - arquitetura, backend, frontend, banco de dados
- Experiência com **MySQL, SQL Server, React, Laravel, ASP.NET**
- Trabalhou em **setor financeiro** com sistemas críticos
- Criou **multi-tenant systems** e **B2B solutions**
- Experiência com **e-commerce completo**

### 💡 O Que Jhefferson Fez Neste Site:
**Tudo!** Porto Shop foi desenvolvido completamente por Jhefferson:
- ✅ Arquitetura full-stack (Laravel 12 + React)
- ✅ Banco de dados MySQL com otimizações
- ✅ APIs RESTful seguras (JWT)
- ✅ Frontend responsivo com Bootstrap 5 e TailwindCSS
- ✅ Sistema de permissões (RBAC)
- ✅ Dashboard com analytics
- ✅ Controle de estoque
- ✅ Gerenciamento de produtos, categorias, usuários
- ✅ Integração com Docker
- ✅ Testes com PHPUnit
- ✅ Deploy e CI/CD

### 📬 Contatos:
- **Email**: jhefferson.tec@gmail.com
- **Telefone**: +55 (79) 99641-6903
- **WhatsApp**: [Disponível para conversa]
- **GitHub**: https://github.com/jheffersondev-eng
- **LinkedIn**: https://www.linkedin.com/in/jhefferson-silva-3013031b1/

### 🎁 Currículo:
Se deseja o currículo completo, pode **baixar aqui**: [/download-curriculum](/download-curriculum)

### 🚀 Interesse em Jhefferson:
Se você está interessado em trabalhar com Jhefferson, conhecer mais sobre seus projetos, ou deseja conversar sobre oportunidades, **entre em contato diretamente** via WhatsApp, email ou LinkedIn. Ele está sempre aberto a novas oportunidades!
DEVINFO;
    }

    /**
     * Obtém o prompt do sistema que define o comportamento do chatbot
     */
    public static function getSystemPrompt(): string
    {
        return <<<'PROMPT'
Você é um assistente inteligente e especializado na plataforma **Porto Shop**, um sistema moderno de gerenciamento de e-commerce construído com Laravel 12, PHP 8.2 e MySQL 8.0.

## 🛍️ Sobre o Porto Shop:
Porto Shop é uma plataforma completa de gerenciamento de e-commerce com:
- ✅ Gestão de Produtos com múltiplas imagens
- ✅ Gerenciamento de Usuários com autenticação JWT
- ✅ Dashboard Analytics em tempo real
- ✅ Controle de Estoque com alertas
- ✅ Sistema de Perfis com permissões
- ✅ Interface responsiva com Bootstrap 5 e TailwindCSS

## 👨‍💻 IMPORTANTE - Sobre o Desenvolvedor:
Este site foi **completamente desenvolvido por Jhefferson Matheus**, um desenvolvedor full-stack com 5+ anos de experiência (desde 2017).

**Se perguntarem:**
- ❓ "Que tecnologias você usou?" → Responda que Jhefferson usou PHP/Laravel, React, MySQL, Docker, AWS, etc
- ❓ "Você sabe MySQL?" → Sim, este site inteiro foi desenvolvido com MySQL (94% de proficiência)
- ❓ "Como foi feito?" → Tudo aqui foi desenvolvido do zero por Jhefferson seguindo SOLID, Clean Architecture, etc
- ❓ "Você tem currículo?" → Sim, pode baixar em: /download-curriculum
- ❓ "Você está disponível?" → Sim! Jhefferson está aberto a novas oportunidades. Pode contatar:
  - WhatsApp: +55 (79) 99641-6903
  - Email: jhefferson.tec@gmail.com
  - LinkedIn: https://www.linkedin.com/in/jhefferson-silva-3013031b1/

## 🔑 IMPORTANTE - Fluxo de Dependências:
⚠️ **ANTES DE CRIAR PRODUTOS**: Categoria e Unidade devem existir
⚠️ **ANTES DE CRIAR USUÁRIOS**: Perfil deve estar criado
⚠️ **ANTES DE TUDO**: Admin precisa criar as estruturas base

## 📊 Tecnologias Utilizadas:
- Backend: Laravel 12, PHP 8.2, MySQL 8.0, JWT
- Frontend: Bootstrap 5.3, Vite 7.0, TailwindCSS 4.0, JavaScript ES6+
- Desenvolvimento: Docker, Composer, PHPUnit, Laravel Debugbar 

## Sobre a Plataforma:
- É um sistema de gestão de loja online construído com Laravel 11
- Permite gerenciar produtos, categorias, pedidos, usuários e vendas
- Possui integração com API de IA (você mesmo)
- Suporta múltiplos usuários com diferentes permissões
- Funciona com sistema de autenticação seguro

## Funcionalidades Principais:
### 1. Produtos
- Criar, editar e deletar produtos
- Categorizar produtos
- Adicionar imagens e descrições
- Gerenciar estoque e quantidade
- Definir preços e custos
- Controlar disponibilidade (ativo/inativo)

### 2. Categorias
- Criar e organizar categorias
- Atribuir produtos às categorias
- Estruturar a loja por temas

### 3. Pedidos & Vendas
- Visualizar e gerenciar pedidos
- Rastrear status de vendas
- Processar pagamentos
- Gerar relatórios de vendas

### 4. Usuários & Permissões
- Sistema de controle de acesso
- Diferentes papéis e permissões
- Autenticação segura

### 5. Dashboard
- Visualizar estatísticas
- Monitorar desempenho
- Acompanhar vendas

## Recursos da Interface:
- Sidebar com menu de navegação
- Componentes responsivos
- Chat inteligente (você) para suporte

## Como Ajudar:
1. **Dúvidas sobre navegação**: Guie para a seção correta (ex: "Produtos", "Vendas", "Usuários")
2. **Como fazer algo**: Explique o passo a passo
3. **Integração de API**: Forneça detalhes técnicos
4. **Troubleshooting**: Ajude a resolver problemas

## Respostas Esperadas:
- Seja específico e prático
- Forneça exemplos quando possível
- Indique onde encontrar cada funcionalidade
- Se for algo técnico, explique de forma acessível
- Quando apropriado, peça mais detalhes para ajudar melhor

Importante: Mantenha um tom profissional mas amigável!
PROMPT;
    }

    /**
     * Obtém informações sobre os módulos/seções principais do site
     */
    public static function getSystemModules(): array
    {
        return [
            'dashboard' => [
                'name' => 'Dashboard',
                'path' => '/dashboard',
                'description' => 'Visualizar estatísticas e desempenho em tempo real',
                'features' => [
                    'Vendas totais do mês',
                    'Novos usuários',
                    'Produtos criados',
                    'Receitas',
                    'Gráficos de performance',
                    'Alertas de estoque mínimo'
                ],
            ],
            'categorias' => [
                'name' => 'Categorias de Produtos',
                'path' => '/categorias',
                'description' => 'Criar e organizar categorias para produtos',
                'features' => [
                    'Criar nova categoria',
                    'Editar categorias',
                    'Deletar categorias',
                    'Visualizar subcategorias',
                    'Atribuir produtos'
                ],
                'info' => '⚠️ ESSENCIAL: Criar categorias ANTES de criar produtos',
            ],
            'unidades' => [
                'name' => 'Unidades de Medida',
                'path' => '/unidades',
                'description' => 'Gerenciar unidades de medida (kg, metros, litros, etc)',
                'features' => [
                    'Criar unidade (Nome, Abreviação, Formato)',
                    'Tipos: Peso (kg, g), Comprimento (m, cm), Volume (l, ml)',
                    'Editar unidades existentes',
                    'Deletar unidades'
                ],
                'info' => '⚠️ ESSENCIAL: Criar unidades ANTES de criar produtos',
                'exemplos' => ['Quilograma (kg)', 'Metro (m)', 'Litro (l)', 'Unidade (un)', 'Caixa (cx)']
            ],
            'produtos' => [
                'name' => 'Gerenciar Produtos',
                'path' => '/produtos',
                'description' => 'Criar, editar e gerenciar todos os produtos da loja',
                'features' => [
                    'Nome do produto',
                    'Descrição detalhada',
                    'Selecionar Categoria (obrigatório)',
                    'Selecionar Unidade (obrigatório)',
                    'Preço de Custo',
                    'Preço de Venda',
                    'Quantidade em Estoque',
                    'Quantidade Mínima (para alertas)',
                    'Código de Barras (opcional)',
                    'Upload de múltiplas imagens (até 5MB cada)',
                    'Status (Ativo/Inativo)'
                ],
                'validacoes' => [
                    'Nome: obrigatório, máximo 255 caracteres',
                    'Descrição: até 5000 caracteres',
                    'Preços: números decimais, mínimo 0',
                    'Estoque: números inteiros positivos',
                    'Imagens: PNG, JPG, JPEG, até 5MB'
                ],
                'info' => '⚠️ DEPENDÊNCIAS: Categoria e Unidade devem existir ANTES'
            ],
            'perfis' => [
                'name' => 'Perfis de Usuários',
                'path' => '/perfis',
                'description' => 'Criar e gerenciar perfis com permissões específicas',
                'features' => [
                    'Nome do perfil (Vendedor, Operador, etc)',
                    'Descrição do perfil',
                    'Selecionar permissões (checkboxes)',
                    'Categorias de acesso',
                    'Editar permissões',
                    'Visualizar perfis ativos/inativos'
                ],
                'permissoes' => [
                    'UserController: index, show, store, update, destroy',
                    'ProductController: index, show, store, update, destroy',
                    'CategoryController: index, show, store, update, destroy',
                    'UnitController: index, show, store, update, destroy',
                    'DashboardController: index',
                    'ProfileController: index, show, store, update, destroy'
                ],
                'info' => '⚠️ ESSENCIAL: Criar perfis ANTES de criar usuários'
            ],
            'usuarios' => [
                'name' => 'Gerenciar Usuários',
                'path' => '/usuarios',
                'description' => 'Criar, editar e gerenciar usuários com diferentes permissões',
                'features' => [
                    'Nome completo',
                    'Email único',
                    'Documento (CPF/CNPJ)',
                    'Data de Nascimento',
                    'Telefone',
                    'Endereço completo',
                    'Selecionar Perfil (obrigatório)',
                    'Definir senha temporária',
                    'Status (Ativo/Inativo)',
                    'Dados de verificação de email'
                ],
                'validacoes' => [
                    'Email: formato válido, único no sistema',
                    'Senha: mínimo 8 caracteres',
                    'Telefone: formato (xx) xxxx-xxxx',
                    'CPF/CNPJ: válido e único',
                    'Data: formato YYYY-MM-DD'
                ],
                'info' => '⚠️ DEPENDÊNCIA: Perfil deve existir ANTES de criar usuário',
                'fluxo_pos_criacao' => 'Usuário recebe email para verificação, pode fazer login após ativar conta'
            ],
            'perfil_usuario' => [
                'name' => 'Meu Perfil',
                'path' => '/profile',
                'description' => 'Editar informações pessoais e foto de perfil',
                'features' => [
                    'Alterar foto de perfil',
                    'Editar nome completo',
                    'Alterar email',
                    'Trocar senha',
                    'Visualizar dados pessoais',
                    'Gerenciar preferências'
                ]
            ],
        ];
    }

    /**
     * Obtém FAQ comum sobre o sistema
     */
    public static function getFAQ(): array
    {
        return [
            // Fluxo de Criação
            [
                'question' => 'Qual é a ordem correta para começar a usar o Porto Shop?',
                'answer' => '1️⃣ Admin cria CATEGORIAS → 2️⃣ Admin cria UNIDADES → 3️⃣ Admin cria PERFIS → 4️⃣ Admin cria USUÁRIOS → 5️⃣ Criar PRODUTOS. Cada um desses tem dependências!'
            ],
            [
                'question' => 'Como criar um novo produto?',
                'answer' => 'Pré-requisitos: Categoria e Unidade devem existir. Vá para Produtos → Novo Produto. Preencha: Nome, Descrição, Selecione Categoria, Selecione Unidade, Preço Custo, Preço Venda, Estoque, Mínimo, adicione imagens. Clique em Salvar.'
            ],
            [
                'question' => 'Por que não consigo criar um produto?',
                'answer' => 'Verifique: 1) Existe alguma Categoria? 2) Existe alguma Unidade? 3) Você tem permissão? Se faltam categoria ou unidade, crie-as primeiro em suas respectivas seções.'
            ],
            [
                'question' => 'Como criar um novo usuário?',
                'answer' => 'Pré-requisito: Um Perfil deve existir. Vá para Usuários → Novo Usuário. Preencha: Nome, Email, Documento, Data Nasc., Telefone, Endereço, Selecione Perfil, defina Senha, escolha Status. Clique em Salvar.'
            ],
            [
                'question' => 'Por que não consigo criar um usuário?',
                'answer' => 'Você precisa criar um Perfil primeiro! Vá para Perfis → Novo Perfil, defina o nome e permissões, depois tente criar o usuário novamente.'
            ],
            [
                'question' => 'Como criar uma categoria?',
                'answer' => 'Vá para Categorias → Nova Categoria. Preencha: Nome (obrigatório), Descrição (opcional). Clique em Salvar. Pronto! Agora você pode usar essa categoria ao criar produtos.'
            ],
            [
                'question' => 'Como criar uma unidade de medida?',
                'answer' => 'Vá para Unidades → Nova Unidade. Preencha: Nome (ex: Quilograma), Abreviação (ex: kg), Formato (escolha o tipo: peso, comprimento, volume, etc). Clique em Salvar.'
            ],
            [
                'question' => 'Como criar um perfil de usuário?',
                'answer' => 'Vá para Perfis → Novo Perfil. Preencha: Nome (ex: Vendedor), Descrição. Selecione as Permissões que esse perfil terá (checkboxes). Clique em Salvar. Depois use esse perfil ao criar usuários.'
            ],
            [
                'question' => 'Como adicionar imagens a um produto?',
                'answer' => 'Na página de criação/edição do produto, há uma seção de "Imagens". Você pode fazer upload de múltiplas imagens (PNG, JPG, JPEG). Cada imagem pode ter até 5MB. Clique em "Adicionar" e selecione o arquivo.'
            ],
            [
                'question' => 'Como definir permissões de um usuário?',
                'answer' => 'As permissões vêm do Perfil do usuário. Para mudar: 1) Edite o Perfil e selecione as permissões desejadas, OU 2) Mude o Perfil do usuário para outro que tenha as permissões corretas.'
            ],
            [
                'question' => 'O que fazer quando o estoque de um produto atinge a quantidade mínima?',
                'answer' => 'O Dashboard mostrará um alerta no painel. Vá para Produtos, encontre o produto, e aumente a Quantidade em Estoque. Quando usar a quantidade mínima, o sistema alerta novamente.'
            ],
            [
                'question' => 'Como fazer login no sistema?',
                'answer' => 'Acesse http://localhost:8000/login. Digite seu Email e Senha (definidas pelo admin ao criar seu usuário). Se é primeira vez, você pode precisar verificar seu email. Clique em "Login".'
            ],
            [
                'question' => 'Como resetar minha senha?',
                'answer' => 'Na página de login, clique em "Esqueceu sua senha?". Digite seu email. Você receberá um link para resetar a senha no seu email.'
            ],
            [
                'question' => 'Qual é a diferença entre Preço de Custo e Preço de Venda?',
                'answer' => 'Preço de Custo: o quanto você pagou pelo produto. Preço de Venda: o quanto você cobra do cliente. A diferença é seu lucro/margem.'
            ],
            [
                'question' => 'Posso editar um produto já criado?',
                'answer' => 'Sim! Vá para Produtos, clique no produto desejado, faça as alterações e clique em "Atualizar". Você pode editar nome, preços, estoque, imagens, etc.'
            ],
        ];
    }

    /**
     * Obtém documentação completa de API
     */
    public static function getAPIDocumentation(): string
    {
        return <<<'DOC'
## 📚 Documentação Completa da API

### 🔐 Autenticação
Todos os endpoints requerem autenticação via JWT Bearer Token ou X-API-KEY

**Headers Padrão:**
```
Authorization: Bearer {seu_token_jwt}
X-API-KEY: {sua-api-key}
Content-Type: application/json
```

### 👥 USUÁRIOS - Endpoints

#### 1. Listar Usuários
```
GET /api/users?page=1&limit=10
Resposta: Array de usuários com paginação
```

#### 2. Obter Usuário por ID
```
GET /api/users/{id}
Resposta: Dados completos do usuário
```

#### 3. Criar Novo Usuário (REQUER Perfil existente!)
```
POST /api/users
Body: {
  "profile_id": 1,           // ⚠️ OBRIGATÓRIO - perfil deve existir
  "name": "Nome Completo",   // Obrigatório
  "email": "email@exemplo.com", // Único, obrigatório
  "document": "12345678900", // CPF/CNPJ
  "birth_date": "1990-01-15", // YYYY-MM-DD
  "phone": "(11) 99999-9999",
  "address": "Rua X, nº 123",
  "password": "senha123",    // Mínimo 8 caracteres
  "password_confirmation": "senha123" // Deve confirmar
}
Resposta: Dados do novo usuário criado
Validações:
- Email deve ser único
- Documento deve ser único
- Senha mínimo 8 caracteres
- Perfil deve existir no banco
```

#### 4. Atualizar Usuário
```
PUT /api/users/{id}
Body: Mesmo formato do POST, com campos a atualizar
Resposta: Dados atualizados
```

#### 5. Deletar Usuário
```
DELETE /api/users/{id}
Resposta: Confirmação de exclusão
```

### 📦 PRODUTOS - Endpoints (REQUER Categoria e Unidade!)

#### 1. Listar Produtos
```
GET /api/products?page=1&limit=10&category_id=1&is_active=1
Resposta: Array de produtos com filtros opcionais
```

#### 2. Obter Produto por ID
```
GET /api/products/{id}
Resposta: Dados completos do produto com imagens
```

#### 3. Criar Novo Produto (REQUER Categoria e Unidade existentes!)
```
POST /api/products
Body (form-data):
{
  "name": "Produto XYZ",     // Obrigatório
  "description": "Descrição", // Até 5000 caracteres
  "category_id": 1,          // ⚠️ OBRIGATÓRIO - categoria deve existir
  "unit_id": 1,              // ⚠️ OBRIGATÓRIO - unidade deve existir
  "price": 99.99,            // Preço de venda
  "cost_price": 50.00,       // Preço de custo
  "stock_quantity": 100,     // Quantidade em estoque
  "min_quantity": 10,        // Quantidade mínima (alerta)
  "barcode": "1234567890",   // Opcional
  "is_active": 1,            // 1 = ativo, 0 = inativo
  "images[]": [file1, file2] // Até 5MB cada, múltiplas imagens
}
Validações:
- Nome: máximo 255 caracteres
- Preços: números decimais >= 0
- Estoque: números inteiros >= 0
- Imagens: PNG, JPG, JPEG até 5MB
- Categoria e Unidade devem existir!
```

#### 4. Atualizar Produto
```
PUT /api/products/{id}
Body: Mesmo formato do POST
Resposta: Dados atualizados
```

#### 5. Deletar Produto
```
DELETE /api/products/{id}
Resposta: Confirmação
```

### 📂 CATEGORIAS - Endpoints

#### 1. Listar Categorias
```
GET /api/categories
Resposta: Array de todas as categorias
```

#### 2. Criar Categoria
```
POST /api/categories
Body: {
  "name": "Nome Categoria",  // Obrigatório
  "description": "Descrição" // Opcional
}
Resposta: Dados da categoria criada
```

#### 3. Atualizar Categoria
```
PUT /api/categories/{id}
Body: Mesmo formato do POST
```

#### 4. Deletar Categoria
```
DELETE /api/categories/{id}
Nota: Só deleta se não tiver produtos
```

### 📏 UNIDADES DE MEDIDA - Endpoints

#### 1. Listar Unidades
```
GET /api/units
Resposta: Array de unidades (kg, m, l, etc)
```

#### 2. Criar Unidade
```
POST /api/units
Body: {
  "name": "Quilograma",      // Obrigatório
  "abbreviation": "kg",      // Obrigatório, máximo 10 caracteres
  "format": 1                // 1=peso, 2=comprimento, 3=volume, etc
}
Resposta: Dados da unidade criada
```

#### 3. Atualizar Unidade
```
PUT /api/units/{id}
Body: Mesmo formato do POST
```

#### 4. Deletar Unidade
```
DELETE /api/units/{id}
Nota: Só deleta se não tiver produtos usando
```

### 🎭 PERFIS - Endpoints

#### 1. Listar Perfis
```
GET /api/profiles
Resposta: Array de perfis com suas permissões
```

#### 2. Criar Perfil
```
POST /api/profiles
Body: {
  "name": "Vendedor",        // Obrigatório
  "description": "Descrição",
  "permissions": [           // Array de permissões
    "productcontroller@index",
    "productcontroller@show",
    "usercontroller@index"
  ]
}
Resposta: Dados do perfil criado
Permissões Disponíveis:
- UserController: index, show, store, update, destroy
- ProductController: index, show, store, update, destroy
- CategoryController: index, show, store, update, destroy
- UnitController: index, show, store, update, destroy
- ProfileController: index, show, store, update, destroy
- DashboardController: index
```

#### 3. Atualizar Perfil
```
PUT /api/profiles/{id}
Body: Mesmo formato do POST
```

#### 4. Deletar Perfil
```
DELETE /api/profiles/{id}
Nota: Só deleta se não tiver usuários usando
```

### 📊 DASHBOARD - Endpoints

#### 1. Estatísticas Gerais
```
GET /api/dashboard/stats
Resposta: {
  "total_vendas": 5000.00,
  "novos_usuarios": 10,
  "produtos_criados": 25,
  "estoque_baixo": 5,
  "receita_mes": 15000.00
}
```

### ✅ Status Codes
- 200: Sucesso
- 201: Criado com sucesso
- 400: Erro de validação
- 401: Não autenticado
- 403: Sem permissão
- 404: Não encontrado
- 422: Dados inválidos
- 500: Erro do servidor

### 📋 Formato de Resposta Padrão
```
{
  "success": true/false,
  "data": {...},
  "message": "Mensagem descritiva",
  "errors": {
    "field_name": ["Erro de validação"]
  }
}
```
DOC;
    }

    /**
     * Monta o contexto completo para enviar ao chatbot
     */
    public static function buildContextualPrompt(string $userMessage): string
    {
        $systemPrompt = self::getSystemPrompt();
        $developerInfo = self::getDeveloperInfo();
        $modules = self::getSystemModules();
        $faq = self::getFAQ();
        $api = self::getAPIDocumentation();

        $modulesInfo = "## 📍 Módulos Disponíveis:\n";
        foreach ($modules as $key => $module) {
            $info = isset($module['info']) ? " [{$module['info']}]" : "";
            $modulesInfo .= "- **{$module['name']}** ({$module['path']}): {$module['description']}{$info}\n";
        }

        $faqInfo = "## ❓ FAQ Rápido (Perguntas Mais Comuns):\n";
        foreach (array_slice($faq, 0, 5) as $item) {
            $faqInfo .= "- Q: {$item['question']}\n";
        }

        return <<<CONTEXT
$systemPrompt

$developerInfo

$modulesInfo

$faqInfo

$api

---

**Pergunta do usuário**: $userMessage

## 📌 Instruções Especiais para Responder:
1. Se a pergunta é sobre criar algo, sempre verifique se mencionou as dependências
2. Para PRODUTOS: mencione que precisa de Categoria + Unidade
3. Para USUÁRIOS: mencione que precisa de Perfil
4. Para CATEGORIAS/UNIDADES/PERFIS: explique que são o "alicerce" antes de criar usuários/produtos
5. Se pergunta é sobre API: forneça detalhes completos de endpoint, body, validações
6. Se pergunta é sobre Jhefferson/desenvolvedor: use as informações da seção "Sobre o Desenvolvedor"
7. Se pedir currículo: indique o link /download-curriculum
8. Se perguntar sobre disponibilidade/oportunidades: mencione contatos (WhatsApp, Email, LinkedIn)
9. Se pergunta é técnica sobre tecnologias: responda com base nas habilidades de Jhefferson
10. Seja sempre PRÁTICO: exemplo específico > explicação genérica
11. Indique o CAMINHO EXATO: "Vá para Menu > Submenu > Ação"

Responda sendo específico, prático e sempre lembrando as dependências!
CONTEXT;
    }
}
