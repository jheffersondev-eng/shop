# 🛍️ Porto Shop

Um sistema moderno de gerenciamento de e-commerce construído com **Laravel 12**, **PHP 8.2** e **MySQL 8.0**. Desenvolvido para oferecer uma experiência intuitiva e performance otimizada.

---

## 📋 Índice

- [🎯 Visão Geral](#-visão-geral)
- [🏗️ Arquitetura](#-arquitetura)
- [🔧 Tecnologias](#-tecnologias)
- [⚙️ Pré-requisitos](#️-pré-requisitos)
- [🚀 Guia de Instalação](#-guia-de-instalação)
- [📁 Estrutura do Projeto](#-estrutura-do-projeto)
- [🎮 Como Usar](#-como-usar)
- [🐳 Docker](#-docker)
- [📚 Endpoints Principais](#-endpoints-principais)
- [🤝 Contribuindo](#-contribuindo)

---

## 🎯 Visão Geral

**Porto Shop** é uma plataforma completa de gerenciamento de e-commerce que inclui:

✅ **Gestão de Produtos** - Cadastro com múltiplas imagens, descrições e preços  
✅ **Gerenciamento de Usuários** - Sistema de autenticação com JWT  
✅ **Dashboard Analytics** - Visualização de estatísticas em tempo real  
✅ **Controle de Estoque** - Rastreamento de quantidades e alertas  
✅ **Sistema de Perfis** - Associação de permissões e categorias  
✅ **Interface Responsiva** - Design moderno com Bootstrap 5

---

## 🏗️ Arquitetura

O projeto segue o padrão **Service-Repository-DTO** para melhor organização e manutenibilidade:

```
app/
├── Modules/              # Módulos isolados por funcionalidade
│   ├── Product/
│   ├── Category/
│   ├── User/
│   └── Dashboard/
├── Services/             # Camada de negócio
├── Repositories/         # Camada de dados
├── Http/
│   ├── Controllers/
│   ├── Requests/        # Validação de entrada
│   └── Dto/             # Transfer Objects
├── Models/              # Modelos Eloquent
└── Helpers/             # Funções auxiliares
```

---

## 🔧 Tecnologias

### Backend
| Tecnologia | Versão | Descrição |
|-----------|--------|-----------|
| ![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?logo=laravel) | 12.0 | Framework PHP moderno |
| ![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php) | 8.2 | Linguagem backend |
| ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql) | 8.0 | Banco de dados |
| ![JWT](https://img.shields.io/badge/JWT-Auth-000000?logo=jsonwebtokens) | * | Autenticação segura |

### Frontend
| Tecnologia | Versão | Descrição |
|-----------|--------|-----------|
| ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap) | 5.3 | Framework CSS |
| ![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?logo=vite) | 7.0 | Build tool moderno |
| ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.0-06B6D4?logo=tailwindcss) | 4.0 | Utilidades CSS |
| ![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?logo=javascript) | ES6+ | Interatividade |

### Desenvolvimento
| Ferramentas | Descrição |
|----------|-----------|
| 🐳 Docker | Containerização do banco de dados |
| 📦 Composer | Gerenciador de dependências PHP |
| 🧪 PHPUnit | Testes unitários |
| 🔍 Laravel Debugbar | Debugging avançado |

---

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.2+** ([Download](https://www.php.net/downloads))
- **Composer** ([Download](https://getcomposer.org/))
- **Docker** ([Download](https://www.docker.com/))
- **Docker Compose** (incluído no Docker Desktop)
- **Git** ([Download](https://git-scm.com/))

### Verificar instalações:
```bash
php --version          # Deve mostrar PHP 8.2+
composer --version     # Deve mostrar Composer 2.x
docker --version       # Deve estar instalado
docker-compose --version
```

---

## 🚀 Guia de Instalação

### 1️⃣ Clonar o Repositório
```bash
git clone https://github.com/seu-usuario/porto-shop.git
cd porto-shop
```

### 2️⃣ Instalar Dependências PHP
```bash
composer install
```

### 3️⃣ Configurar Variáveis de Ambiente
```bash
cp .env.example .env
```

Edite o arquivo `.env` e configure:
```env
APP_NAME="Porto Shop"
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de dados (Docker)
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_shop
DB_USERNAME=root
DB_PASSWORD=shoppassword

# JWT
JWT_SECRET=seu_secret_aqui
```

### 4️⃣ Gerar Chave da Aplicação
```bash
php artisan key:generate
```

### 5️⃣ Instalar Dependências Frontend
```bash
npm install
```

### 6️⃣ Iniciar o Docker
```bash
docker-compose up -d
```

Aguarde 10-15 segundos para o MySQL estar totalmente pronto.

### 7️⃣ Executar Migrações do Banco
```bash
php artisan migrate
```

### 8️⃣ Seeding (Opcional - Dados de Teste)
```bash
php artisan db:seed
```

### 9️⃣ Build Frontend
```bash
npm run build
```

Para desenvolvimento com hot reload:
```bash
npm run dev
```

### 🔟 Iniciar o Servidor Laravel
```bash
php artisan serve
```

A aplicação estará disponível em: **http://localhost:8000**

---

## 📁 Estrutura do Projeto

```
porto-shop/
├── app/
│   ├── Enums/              # Enumerações (Status, Formatos)
│   ├── Helpers/            # Funções auxiliares
│   ├── Http/
│   │   ├── Controllers/    # Controllers da aplicação
│   │   ├── Requests/       # Validação de requisições
│   │   └── Dto/            # Data Transfer Objects
│   ├── Interfaces/         # Contratos de serviços
│   ├── Mapper/             # Mapeadores de dados
│   ├── Models/             # Modelos Eloquent
│   ├── Modules/            # Módulos de negócio
│   ├── Repositories/       # Camada de persistência
│   ├── Services/           # Lógica de negócio
│   └── Traits/             # Traits reutilizáveis
├── bootstrap/              # Bootstrap da aplicação
├── config/                 # Configurações
├── database/
│   ├── migrations/         # Migrações de banco
│   ├── seeders/            # Seeds de dados
│   └── factories/          # Factories para testes
├── docker/                 # Configurações Docker
├── public/
│   ├── assets/             # Imagens, CSS, JS
│   └── storage/            # Uploads de usuários
├── resources/
│   ├── css/                # Estilos CSS
│   ├── js/                 # Scripts JavaScript
│   └── views/              # Templates Blade
├── routes/                 # Definição de rotas
├── storage/                # Cache, logs, uploads
├── tests/                  # Testes automatizados
├── .env.example            # Variáveis de exemplo
├── artisan                 # CLI do Laravel
├── composer.json           # Dependências PHP
├── docker-compose.yml      # Configuração Docker
├── Dockerfile              # Imagem Docker
├── package.json            # Dependências Node
├── phpunit.xml             # Configuração de testes
└── vite.config.js          # Configuração Vite

```

---

## 🎮 Como Usar

### � Primeiros Passos

#### 1. **Registrar-se**
1. Acesse a página inicial: **http://localhost:8000**
2. Clique em **"Registre-se"**
3. Preencha os dados:
   - Nome completo
   - Email
   - Senha (mínimo 8 caracteres)
4. Clique em **"Criar Conta"**
5. ✅ Você se torna um **Administrador**!

#### 2. **Dashboard**
- Ao fazer login, você acessa o dashboard
- Visualize estatísticas de:
  - 📊 Novos usuários do mês
  - 📦 Produtos criados
  - 💰 Receitas
  - 📈 Gráficos de performance

#### 3. **Gerenciar Categorias**
1. Vá para **Categorias** → **Nova Categoria**
2. Preencha:
   - Nome da categoria
   - Descrição (opcional)
3. Clique em **Salvar**
4. Categorias são essenciais para organizar produtos

#### 4. **Gerenciar Unidades**
1. Acesse **Unidades** → **Nova Unidade**
2. Configure:
   - Nome (ex: Quilograma, Metro, Litro)
   - Abreviação (ex: kg, m, l)
   - Formato (unidade, peso, volume)
3. Clique em **Salvar**
4. Unidades são usadas para produtos (ex: 5kg, 10m)

#### 5. **Gerenciar Perfis**
1. Vá para **Perfis** → **Novo Perfil**
2. Defina:
   - Nome do perfil (ex: Vendedor, Operador)
   - Permissões associadas
   - Categorias de acesso
3. Clique em **Salvar**
4. Perfis controlam o acesso de usuários

#### 6. **Gerenciar Usuários**
1. Acesse **Usuários** → **Novo Usuário**
2. Preencha os dados:
   - Nome completo
   - Email
   - Senha temporária
   - Perfil (Vendedor, Operador, etc)
   - Status (Ativo/Inativo)
3. Clique em **Criar Usuário**
4. ✅ Novo usuário pode fazer login!

#### 7. **Criar Produtos**
1. Vá para **Produtos** → **Novo Produto**
2. Preencha as informações:
   - **Nome** do produto
   - **Descrição** detalhada
   - **Categoria** (criada anteriormente)
   - **Unidade** (kg, metros, etc)
   - **Preço de Custo**
   - **Preço de Venda**
   - **Quantidade em Estoque**
   - **Quantidade Mínima** (para alertas)
   - **Código de Barras** (opcional)
3. **Faça upload de múltiplas imagens** (até 5MB cada)
4. Clique em **Salvar**
5. ✅ Produto aparece na lista!

#### 8. **Editar Seu Perfil**
1. Clique na sua foto/avatar (canto superior direito)
2. Selecione **Meu Perfil**
3. Atualize seus dados:
   - Foto de perfil
   - Nome completo
   - Email
   - Senha
4. Clique em **Salvar**

### 📋 Fluxo Completo

```
┌─────────────────┐
│  Página Inicial │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│   Registre-se   │
└────────┬────────┘
         │
         ▼
    ✅ Admin User
         │
         ├─────────────────────┬──────────────────┬─────────────────┐
         │                     │                  │                 │
         ▼                     ▼                  ▼                 ▼
    Categorias            Unidades            Perfis          Usuários
         │                     │                  │                 │
         └─────────────────────┴──────────────────┴─────────────────┘
                                 │
                                 ▼
                            Criar Produtos
                                 │
                                 ▼
                            Dashboard
```

---

## 🐳 Docker

### Iniciar o Docker
```bash
docker-compose up -d
```

### Parar o Docker
```bash
docker-compose down
```

### Visualizar Logs
```bash
docker-compose logs -f db
```

### Acessar MySQL via CLI
```bash
docker exec -it mysql_db mysql -u root -p
# Senha: shoppassword
```

### Reiniciar Serviços
```bash
docker-compose restart
```

---

## 📚 Endpoints Principais

### Autenticação
```
POST   /api/auth/login          # Login
POST   /api/auth/logout         # Logout
POST   /api/auth/refresh        # Renovar token
```

### Produtos
```
GET    /api/products            # Listar produtos
GET    /api/products/{id}       # Obter produto específico
POST   /api/products            # Criar novo produto
PUT    /api/products/{id}       # Atualizar produto
DELETE /api/products/{id}       # Deletar produto
```

### Usuários
```
GET    /api/users               # Listar usuários
GET    /api/users/{id}          # Obter usuário
POST   /api/users               # Criar usuário
PUT    /api/users/{id}          # Atualizar usuário
DELETE /api/users/{id}          # Deletar usuário
```

### Categorias
```
GET    /api/categories          # Listar categorias
POST   /api/categories          # Criar categoria
```

---

## 🧪 Testes

### Executar Testes
```bash
php artisan test
```

### Teste Específico
```bash
php artisan test --filter=NomeDoTeste
```

### Com Coverage
```bash
php artisan test --coverage
```

---

## 🔐 Variáveis de Ambiente

```env
# Aplicação
APP_NAME=Porto Shop
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_shop
DB_USERNAME=root
DB_PASSWORD=shoppassword

# Autenticação JWT
JWT_SECRET=seu_secret_aqui_gerado
JWT_ALGORITHM=HS256

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
```

---

## 🐛 Troubleshooting

### ❌ "SQLSTATE[HY000] [2002] Connection refused"
```bash
# Restart Docker
docker-compose restart db
```

### ❌ "No such file or directory: .env"
```bash
# Copiar arquivo de exemplo
cp .env.example .env
```

### ❌ Permissões de storage
```bash
# No XAMPP/Windows, normalmente não há problema
# No Linux/Mac, execute:
chmod -R 775 storage bootstrap/cache
```

### ❌ Composer com memória insuficiente
```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

---

## 📖 Documentação Adicional

- 🔗 [Laravel Documentation](https://laravel.com/docs)
- 🔗 [Bootstrap Documentation](https://getbootstrap.com/docs)
- 🔗 [Vite Documentation](https://vitejs.dev/)
- 🔗 [Docker Documentation](https://docs.docker.com/)

---

## 📞 Suporte

Encontrou um problema? Crie uma **Issue** no repositório:
- [Reportar Bug](https://github.com/seu-usuario/porto-shop/issues/new)
- [Solicitar Feature](https://github.com/seu-usuario/porto-shop/issues/new)

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 👨‍💻 Desenvolvido com ❤️

Construído com tecnologias modernas e melhores práticas de desenvolvimento.

**Versão:** 1.0.0  
**Última atualização:** 31 de Dezembro de 2025

---

<div align="center">

⭐ Se gostou, deixe uma star! ⭐

</div>
