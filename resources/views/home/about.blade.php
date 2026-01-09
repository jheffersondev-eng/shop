<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Sobre - Portfólio de Desenvolvedor</title>
    <link rel="icon" href="{{ asset('assets/img/branding/porto-shop-branding.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Roboto:wght@400;700&family=Montserrat:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home/about.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/about-extras.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- AOS - Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-about" aria-label="Menu principal">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/branding/porto-shop-branding.png') }}" alt="Logo" width="38" height="38">
                <span class="brand-text">Porto Dev</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Início</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/5579996416903?text=Olá%20Jhefferson,%20estou%20entrando%20em%20contato%20para%20conversar%20sobre%20uma%20oportunidade." target="_blank" rel="noopener noreferrer">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero-about">
        <div class="hero-background"></div>
        <div class="container hero-container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 hero-text-content" data-aos="fade-up" data-aos-duration="1000">
                    <div class="badge-hello">
                        <i class="bi bi-hand-index"></i> Olá, eu sou
                    </div>
                    <h1 class="hero-name"><span class="name-white">Jhefferson</span> <span class="gradient-text">Matheus</span></h1>
                    <h2 class="hero-title">Desenvolvedor Full Stack</h2>
                    <p class="hero-description hero-description-custom">
                        Sou desenvolvedor full-stack com atuação desde 2017, formado em Análise e Desenvolvimento de Sistemas e com base técnica pelo SENAI. Trabalho no desenvolvimento de sistemas e APIs escaláveis utilizando PHP (Laravel) e C# (.NET), aplicando princípios como SOLID, Clean Code e arquiteturas bem definidas.

Tenho experiência em ambientes ágeis, integração com MySQL e SQL Server, uso de Docker e AWS, além do desenvolvimento de interfaces modernas com React. Meu foco é criar soluções bem estruturadas, fáceis de manter e preparadas para crescer.
                    </p>
                    <div class="social-links">
                        <a href="https://github.com/jheffersondev-eng" target="_blank" class="social-btn" aria-label="GitHub">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/jhefferson-silva-3013031b1/" target="_blank" class="social-btn" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="mailto:jhefferson@example.com" class="social-btn" aria-label="Email">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                    <div class="cta-buttons">
                        <a href="https://github.com/jheffersondev-eng" class="btn btn-outline-light btn-lg btn-cta">Ver Meus Projetos</a>
                        <a href="#contact" class="btn btn-outline-light btn-lg btn-cta">Entrar em Contato</a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-content" data-aos="fade-left" data-aos-duration="1000">
                    <div class="hero-image-wrapper">
                        <div class="floating-shapes">
                            <div class="shape shape-1"></div>
                            <div class="shape shape-2"></div>
                            <div class="shape shape-3"></div>
                        </div>
                        <img src="{{ asset('assets/img/application/jhefferson.png') }}" 
                             alt="jhefferson" class="profile-image" loading="lazy">
                        <div class="image-badge">
                            <span class="badge-text">5+ Anos de Exp.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i>
        </div>
    </section>
    <!-- About Story Section -->
    <section class="about-story" id="about">
        <div class="container">
            <div class="section-title-wrapper" data-aos="fade-up">
                <h2 class="section-title">Minha <span class="gradient-text">História</span></h2>
                <div class="title-underline"></div>
            </div>

            <div class="row align-items-center story-content">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="story-image-wrapper">
                        <img src="{{ asset('assets/img/application/jhefferson-senai.png') }}" 
                             alt="Jhefferson trabalhando" class="story-image" loading="lazy">
                        <div class="story-card">
                            <h3>Desde 2017</h3>
                            <p class="hero-description-custom">Desenvolvendo soluções web de impacto</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="story-text">
                        <p class="story-paragraph">
                            Minha história na programação começou ainda durante o ensino médio, quando cursei o técnico em Informática pelo SENAI e tive meu primeiro contato com desenvolvimento de software. Foi nesse período que percebi como a tecnologia poderia ir além do código, atuando diretamente na solução de problemas reais e na construção de sistemas com impacto direto nos negócios.
                        </p>
                        <p class="story-paragraph">
                            Desde 2017, atuo profissionalmente no desenvolvimento de sistemas web, passando por diferentes cenários técnicos, desde sistemas legados até plataformas robustas e sistemas complexos voltados ao setor financeiro, incluindo soluções B2B e aplicações com alto nível de responsabilidade e regras de negócio críticas. Ao longo dessa trajetória, trabalhei principalmente com PHP e C#, desenvolvendo APIs, integrações e funcionalidades que exigem segurança, performance e escalabilidade.
                        </p>
                        <p class="story-paragraph">
                            Com o tempo, também atuei como instrutor de tecnologia, experiência que fortaleceu minha capacidade de comunicação e visão sistêmica. Hoje, sigo evoluindo como desenvolvedor, buscando unir arquitetura bem definida, boas práticas e entendimento de negócio, com foco na construção de soluções confiáveis, escaláveis e preparadas para ambientes complexos.
                        </p>
                        <div class="story-stats">
                            <div class="stat-item">
                                <div class="stat-number">12+</div>
                                <div class="stat-label">Projetos Atuados</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">5+</div>
                                <div class="stat-label">Anos de Exp.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Skills Section -->
    <section class="skills-section" id="skills">
        <div class="container">
            <div class="section-title-wrapper" data-aos="fade-up">
                <h2 class="section-title">Habilidades & <span class="gradient-text">Tecnologias</span></h2>
                <div class="title-underline"></div>
            </div>
            <!-- Skills Categories -->
            <div class="skills-grid">
                <!-- Frontend -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="0">
                    <div class="skill-header">
                        <i class="bi bi-code-slash"></i>
                        <h3>Frontend</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>HTML5</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>CSS3 / SCSS</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 93%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>JavaScript</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 94%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>TypeScript</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>React</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Vue.js</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Bootstrap</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>jQuery</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Responsive Design</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Backend -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                    <div class="skill-header">
                        <i class="bi bi-server"></i>
                        <h3>Backend</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>PHP / Laravel</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 96%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>C# / ASP.NET Core</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>ASP.NET MVC</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>REST API</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 94%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Injeção de Dependência</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 93%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Task Scheduler</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banco de Dados -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                    <div class="skill-header">
                        <i class="bi bi-database"></i>
                        <h3>Banco de Dados</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>MySQL</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 94%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>SQL Server</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 91%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Entity Framework Core</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Stored Procedures</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Query Optimization</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 89%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Arquitetura & Padrões -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                    <div class="skill-header">
                        <i class="bi bi-gear"></i>
                        <h3>Arquitetura</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>SOLID Principles</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Clean Architecture</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>MVC Architecture</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 94%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Clean Code</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 91%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Design Patterns</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DevOps & Infraestrutura -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="400">
                    <div class="skill-header">
                        <i class="bi bi-cloud"></i>
                        <h3>DevOps & Cloud</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>Docker</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 89%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>AWS (Lambda, S3)</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Linux / Windows</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Git / GitHub</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>CI/CD Pipelines</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 86%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Testes & QA -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="500">
                    <div class="skill-header">
                        <i class="bi bi-check-circle"></i>
                        <h3>Testes & QA</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>PHPUnit</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 87%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Testes Funcionais</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 89%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>UI/UX Testing</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Performance Testing</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 86%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Metodologias -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="600">
                    <div class="skill-header">
                        <i class="bi bi-clipboard-check"></i>
                        <h3>Metodologias</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>Scrum</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Kanban</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Agile</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 91%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>RBAC (Controle de Acesso)</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Conhecimentos Adicionais -->
                <div class="skill-category" data-aos="fade-up" data-aos-delay="700">
                    <div class="skill-header">
                        <i class="bi bi-lightbulb"></i>
                        <h3>Conhecimentos Adicionais</h3>
                    </div>
                    <div class="skill-list">
                        <div class="skill-tag">
                            <span>Lógica de Programação</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Multi-tenant</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 88%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Internet Banking</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Setor Financeiro</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 87%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>B2B Systems</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 89%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>E-commerce</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 91%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Controle de Estoque</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 86%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Upload de Imagens</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>JWT Authentication</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 89%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Arduino</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 78%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>C++</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 82%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>Microsserviços</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="skill-tag">
                            <span>API Integration</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experience Section -->
    <section class="experience-section" id="experience">
        <div class="container">
            <div class="section-title-wrapper" data-aos="fade-up">
                <h2 class="section-title">Experiência <span class="gradient-text">Profissional</span></h2>
                <div class="title-underline"></div>
            </div>
            <div class="timeline">
                <!-- Job 1 -->
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="job-card">
                            <div class="job-header-row">
                                <div class="job-image-wrapper">
                                    <img src="{{ asset('assets/img/application/jhefferson-deltech.jpg') }}" 
                                         alt="DEL TECH LTDA" class="job-image" loading="lazy">
                                </div>
                                <div class="job-info">
                                    <div class="job-top">
                                        <div>
                                            <h3 class="job-title">Desenvolvedor Full-Stack</h3>
                                            <h4 class="company-name">DEL TECH LTDA</h4>
                                        </div>
                                    </div>
                                    <div class="job-period">
                                        <i class="bi bi-calendar-event"></i>
                                        Julho 2024 - Setembro 2025
                                    </div>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Desenvolvedor fullstack atuando em um ambiente colaborativo e ágil, seguindo práticas das metodologias Scrum e Kanban. Responsável pela manutenção e evolução de sistemas B2B com arquitetura robusta, aplicando princípios SOLID e Clean Architecture.</p>
                                <div class="job-achievements">
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Desenvolveu sistemas B2B em ASP.NET MVC com arquitetura em camadas e injeção de dependência</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Criou interfaces dinâmicas com React, desenvolvendo componentes reutilizáveis e otimizados</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Integrou SQL Server com Entity Framework Core, desenvolvendo consultas otimizadas e stored procedures</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Desenvolveu APIs RESTful em ASP.NET Core e integrou serviços AWS (Lambda, S3) com Docker</span>
                                    </div>
                                </div>
                                <div class="job-tech-stack">
                                    <span class="tech-pill">ASP.NET MVC</span>
                                    <span class="tech-pill">ASP.NET Core</span>
                                    <span class="tech-pill">React</span>
                                    <span class="tech-pill">Vue.js</span>
                                    <span class="tech-pill">SQL Server</span>
                                    <span class="tech-pill">Entity Framework Core</span>
                                    <span class="tech-pill">AWS</span>
                                    <span class="tech-pill">Docker</span>
                                    <span class="tech-pill">Clean Architecture</span>
                                    <span class="tech-pill">Node.js</span>
                                    <span class="tech-pill">Express.js</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job 2 -->
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="job-card">
                            <div class="job-header-row">
                                <div class="job-image-wrapper">
                                    <img src="{{ asset('assets/img/application/jhefferson-marata.png') }}" 
                                         alt="Digital Agency" class="job-image" loading="lazy">
                                </div>
                                <div class="job-info">
                                    <div class="job-top">
                                        <div>
                                            <h3 class="job-title">Desenvolvedor Full-Stack </h3>
                                            <h4 class="company-name">JAV Industria De Alimentos LTDA </h4>
                                        </div>
                                    </div>
                                    <div class="job-period">
                                        <i class="bi bi-calendar-event"></i>
                                        Fevereiro 2022 - Junho 2024
                                    </div>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Desenvolvedor full-stack utilizando PHP com Laravel, seguindo arquitetura MVC com injeção de dependência, princípios SOLID e Clean Code, APIs para consumo móvel. Atuei em metodologia Scrum, participando de reuniões diárias com equipe e clientes.</p>
                                <div class="job-achievements">
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Otimizou desempenho de consultas MySQL, melhorando significativamente a performance do sistema</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Desenvolveu interfaces, relatórios e microsserviços para alimentação, controle de acessos, gestão agropecuária, e-commerce, construção civil e gestão de projetos</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Criou Jobs e Workers com Task Scheduler em ambientes Linux para automação de tarefas</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Trabalhou em ambientes Windows e Linux, garantindo compatibilidade multiplataforma</span>
                                    </div>
                                </div>
                                <div class="job-tech-stack">
                                    <span class="tech-pill">PHP/Laravel</span>
                                    <span class="tech-pill">Clean Architecture</span>
                                    <span class="tech-pill">MySQL</span>
                                    <span class="tech-pill">Microsserviços</span>
                                    <span class="tech-pill">APIs</span>
                                    <span class="tech-pill">Task Scheduler</span>
                                    <span class="tech-pill">Scrum</span>
                                    <span class="tech-pill">Linux</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job 3 -->
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="job-card">
                            <div class="job-header-row">
                                <div class="job-image-wrapper">
                                    <img src="{{ asset('assets/img/application/jhefferson-margi.png') }}" 
                                         alt="MRC Solucoes em TI" class="job-image" loading="lazy">
                                </div>
                                <div class="job-info">
                                    <div class="job-top">
                                        <div>
                                            <h3 class="job-title">Instrutor de Tecnologia</h3>
                                            <h4 class="company-name">MRC Solucoes em TI e Desenvolvimento de Programas LTDA</h4>
                                        </div>
                                    </div>
                                    <div class="job-period">
                                        <i class="bi bi-calendar-event"></i>
                                        Agosto 2019 - Fevereiro 2022
                                    </div>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Responsável por ministrar aulas em Informática, Lógica de Programação, Programação Low-Code, Arduino e C++ utilizando plataforma Microsoft Hacking STEM. Atuou como Técnico de Robótica, liderando equipe à conquista de prêmios em competições.</p>
                                <div class="job-achievements">
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Ministrou aulas em múltiplas áreas (Informática, Lógica, Low-Code, Arduino, C++) para centenas de alunos</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Liderou equipe de Robótica conquistando dois prêmios consecutivos em competições antes da pandemia</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Adaptou metodologias para ensino remoto, capacitando mais de 50 mil professores em todo Brasil durante pandemia</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Implementou metodologias ativas e ferramentas tecnológicas aplicadas à educação, promovendo inovação escolar</span>
                                    </div>
                                </div>
                                <div class="job-tech-stack">
                                    <span class="tech-pill">Arduino</span>
                                    <span class="tech-pill">C++</span>
                                    <span class="tech-pill">Lógica de Programação</span>
                                    <span class="tech-pill">Low-Code</span>
                                    <span class="tech-pill">Microsoft Hacking STEM</span>
                                    <span class="tech-pill">Robótica</span>
                                    <span class="tech-pill">Educação</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job 4 -->
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="job-card">
                            <div class="job-header-row">
                                <div class="job-image-wrapper">
                                    <img src="{{ asset('assets/img/application/jhefferson-IPTI.jpeg') }}" 
                                         alt="IPTI" class="job-image" loading="lazy">
                                </div>
                                <div class="job-info">
                                    <div class="job-top">
                                        <div>
                                            <h3 class="job-title">Desenvolvedor PHP</h3>
                                            <h4 class="company-name">IPTI</h4>
                                        </div>
                                    </div>
                                    <div class="job-period">
                                        <i class="bi bi-calendar-event"></i>
                                        Agosto 2017 - Novembro 2018
                                    </div>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Primeiro contato profissional com desenvolvimento, conciliando estudos com trabalho de meio período. Responsável pela manutenção e evolução de um sistema legado — plataforma educacional utilizada por escolas em comunidades locais.</p>
                                <div class="job-achievements">
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Realizou manutenção e evolução de plataforma educacional legada utilizada em múltiplas escolas</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Aplicou metodologias ágeis (Scrum) e boas práticas de desenvolvimento desde o início da carreira</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Desenvolveu habilidades técnicas e comportamentais em ambiente colaborativo</span>
                                    </div>
                                    <div class="achievement">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Trabalhou com front-end responsivo e integração de funcionalidades educacionais</span>
                                    </div>
                                </div>
                                <div class="job-tech-stack">
                                    <span class="tech-pill">PHP</span>
                                    <span class="tech-pill">HTML5</span>
                                    <span class="tech-pill">CSS3</span>
                                    <span class="tech-pill">JavaScript</span>
                                    <span class="tech-pill">Scrum</span>
                                    <span class="tech-pill">MySQL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="contact-background"></div>
        <div class="container">
            <div class="section-title-wrapper" data-aos="fade-up">
                <h2 class="section-title">Vamos <span class="gradient-text">Conversar?</span></h2>
                <p class="contact-subtitle">Estou sempre aberto a novos projetos e oportunidades de colaboração</p>
                <div class="title-underline"></div>
            </div>

            <div class="contact-content" data-aos="fade-up">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p><a href="mailto:jhefferson.tec@gmail.com">jhefferson.tec@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Telefone</h4>
                            <p><a href="tel:+5579996416903">+55 (79) 99641-6903</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Localização</h4>
                            <p>Sergipe, Brasil</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('about.sendMail') }}" class="contact-form" id="contactForm">
                    @csrf
					@method('POST')
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Seu Nome" required>
                        <div class="form-line"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Seu Email" required>
                        <div class="form-line"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto" required>
                        <div class="form-line"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Sua Mensagem" required></textarea>
                        <div class="form-line"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">
                        <span>Enviar Mensagem</span>
                        <i class="bi bi-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Voltar ao topo">
        <i class="bi bi-chevron-up"></i>
    </button>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/js/about.js') }}"></script>
    <script>
        // Back to Top Button Logic
        const backToTopBtn = document.getElementById('backToTop');
        const aboutSection = document.getElementById('about');

        // Intersection Observer para mostrar botão quando chegar na seção "Minha História"
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    backToTopBtn.classList.add('show');
                } else if (entry.boundingClientRect.top > 0) {
                    backToTopBtn.classList.remove('show');
                }
            });
        }, {
            threshold: 0.1
        });

        if (aboutSection) {
            observer.observe(aboutSection);
        }

        // Scroll suave para o topo
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
