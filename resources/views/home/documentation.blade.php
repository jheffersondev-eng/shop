@extends('components.app.home-app')
@section('heads')
    <link rel="stylesheet" href="{{ asset('assets/css/home/documentation.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
@section('content')
    <header class="docs-hero" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Documentação da API <small class="text-muted">Porto Shop</small></h1>
                    <p class="lead">Guia completo das rotas, autenticação, exemplos e padrões de resposta.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a class="btn btn-outline-primary" href="#indice"><i class="bi bi-journal-text me-2"></i>Índice</a>
                </div>
            </div>
        </div>
    </header>

    <main class="container docs-container" id="indice">
        <div class="row">
            <aside class="col-lg-3 d-none d-lg-block" data-aos="fade-right">
                <div class="sticky-top pt-4">
                    <nav class="docs-nav">
                        <ul>
                            <li><a href="#autenticacao"><i class="bi bi-shield-lock me-2"></i>Autenticação</a></li>
                            <li><a href="#headers"><i class="bi bi-gear me-2"></i>Headers Obrigatórios</a></li>
                            <li><a href="#status-codes"><i class="bi bi-info-circle me-2"></i>Códigos HTTP</a></li>
                            <li><a href="#rotas-publicas"><i class="bi bi-door-open me-2"></i>Rotas Públicas (Auth)</a>
                            </li>
                            <li><a href="#rotas-protegidas"><i class="bi bi-lock-fill me-2"></i>Rotas Protegidas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <section class="col-lg-9">
                <article id="autenticacao" class="docs-section" data-aos="fade-up">
                    <h2><i class="bi bi-shield-check me-2 text-primary"></i>Autenticação</h2>
                    <h5>API Key</h5>
                    <p>Todas as requisições à API <strong>obrigatoriamente</strong> precisam incluir uma API Key no
                        header <code>X-API-KEY</code>.</p>
                    <div class="code-wrap"><button class="btn-copy" data-copy="API_KEY=sua-chave-api-aqui" title="Copiar"><i
                                class="bi bi-clipboard"></i></button>
                        <pre class="code-block"><code>API_KEY=sua-chave-api-aqui</code></pre>
                    </div>

                    <h5 class="mt-3">Token de Autenticação (Bearer Token)</h5>
                    <p>Rotas protegidas requerem um <strong>Bearer Token</strong> enviado no header
                        <code>Authorization</code>.
                    </p>
                    <div class="code-wrap"><button class="btn-copy" data-copy="Authorization: Bearer {seu-token-aqui}"
                            title="Copiar"><i class="bi bi-clipboard"></i></button>
                        <pre class="code-block"><code>Authorization: Bearer {seu-token-aqui}</code></pre>
                    </div>
                </article>

                <article id="headers" class="docs-section" data-aos="fade-up">
                    <h2><i class="bi bi-list-columns me-2 text-primary"></i>Headers Obrigatórios</h2>
                    <p>Todos os requests devem incluir:</p>
                    <div class="code-wrap"><button class="btn-copy"
                            data-copy='-H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {token}" -H "Content-Type: application/json"'
                            title="Copiar"><i class="bi bi-clipboard"></i></button>
                        <pre class="code-block"><code>-H "X-API-KEY: {sua-api-key}"
-H "Authorization: Bearer {token}"
-H "Content-Type: application/json"</code></pre>
                    </div>
                </article>

                <article id="status-codes" class="docs-section" data-aos="fade-up">
                    <h2><i class="bi bi-code-square me-2 text-primary"></i>Códigos de Status HTTP</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Significado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>200</td>
                                    <td>OK - Requisição bem-sucedida</td>
                                </tr>
                                <tr>
                                    <td>201</td>
                                    <td>Created - Recurso criado com sucesso</td>
                                </tr>
                                <tr>
                                    <td>400</td>
                                    <td>Bad Request - Dados inválidos</td>
                                </tr>
                                <tr>
                                    <td>401</td>
                                    <td>Unauthorized - API Key ou Token inválido/não fornecido</td>
                                </tr>
                                <tr>
                                    <td>403</td>
                                    <td>Forbidden - Sem permissão para acessar</td>
                                </tr>
                                <tr>
                                    <td>404</td>
                                    <td>Not Found - Recurso não encontrado</td>
                                </tr>
                                <tr>
                                    <td>422</td>
                                    <td>Unprocessable Entity - Validação falhou</td>
                                </tr>
                                <tr>
                                    <td>500</td>
                                    <td>Internal Server Error - Erro no servidor</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </article>

                <article id="rotas-publicas" class="docs-section" data-aos="fade-up">
                    <h2><i class="bi bi-globe2 me-2 text-primary"></i>Rotas Públicas (Auth)</h2>

                    <section class="route" id="login">
                        <h4>🔐 Login <small class="text-muted">POST /api/auth/login</small></h4>
                        <p>Autentica um usuário e retorna um token de acesso (Bearer Token).</p>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Request Body (JSON)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='{"email":"usuario@exemplo.com","password":"sua-senha"}'> <i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>{
    "email": "usuario@exemplo.com",
    "password": "sua-senha"
}</code></pre>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Exemplo em Bash (curl)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='curl -X POST http://localhost:8001/api/auth/login -H "X-API-KEY: {sua-api-key}" -H "Content-Type: application/json" -d '{"email":"usuario@exemplo.com","password":"sua-senha"}''><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>curl -X POST http://localhost:8001/api/auth/login \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Content-Type: application/json" \
    -d '{
        "email": "usuario@exemplo.com",
        "password": "sua-senha"
    }'</code></pre>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="route">
                        <h4>📝 Registrar Usuário <small class="text-muted">POST /api/user/register</small></h4>
                        <p>Cria um novo usuário. O payload pode incluir campos adicionais do formulário (ex.: documento,
                            data de nascimento, telefone, endereço).</p>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Exemplo (JSON)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='{
    "name": "Nome Completo",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "senha-segura",
    "password_confirmation": "senha-segura"
}'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>{
    "name": "Nome Completo",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "senha-segura",
    "password_confirmation": "senha-segura"
}</code></pre>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Exemplo em Bash (form-data)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='curl --location "http://localhost:8001/api/user/register" --header "X-API-KEY: {sua-api-key}" --form "name=Nome Completo" --form "email=usuario@exemplo.com" --form "document=00000000000" --form "birth_date=YYYY-MM-DD" --form "phone=(xx) xxxx-xxxx" --form "address=Endereço" --form "password=senha-segura" --form "password_confirmation=senha-segura"'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/user/register" \
  --header "X-API-KEY: {sua-api-key}" \
  --form "name=Nome Completo" \
  --form "email=usuario@exemplo.com" \
  --form "document=00000000000" \
  --form "birth_date=YYYY-MM-DD" \
  --form "phone=(xx) xxxx-xxxx" \
  --form "address=Endereço" \
  --form "password=senha-segura" \
  --form "password_confirmation=senha-segura"</code></pre>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="route">
                        <h4>✅ Verificar Email <small class="text-muted">POST /api/user/verify</small></h4>
                        <p>Verifica o email do usuário usando o código enviado por e-mail. Use valores de placeholder —
                            não exponha tokens reais.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Payload (JSON)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='{"user_id":56,"email":"usuario@exemplo.com","verification_code":"123456"}'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>{
    "user_id": 56,
    "email": "usuario@exemplo.com",
    "verification_code": "123456"
}</code></pre>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Exemplo em Bash (form-data)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='curl --location "http://localhost:8001/api/user/verify" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "user_id=56" --form "email=usuario@exemplo.com" --form "verification_code=123456"'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/user/verify" \
  --header "X-API-KEY: {sua-api-key}" \
  --header "Authorization: Bearer {seu-token}" \
  --form "user_id=56" \
  --form "email=usuario@exemplo.com" \
  --form "verification_code=123456"</code></pre>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="route">
                        <h4>📧 Reenviar Email de Verificação <small class="text-muted">POST
                                /api/user/resend-verify-email</small></h4>
                        <p>Reenvia o email de verificação. Parâmetros comuns: <code>user_id</code> e <code>email</code>.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Payload (JSON)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='{"user_id":56,"email":"usuario@exemplo.com"}'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>{
    "user_id": 56,
    "email": "usuario@exemplo.com"
}</code></pre>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Exemplo em Bash (form-data)</h6>
                                <div class="code-wrap"><button class="btn-copy"
                                        data-copy='curl --location "http://localhost:8001/api/user/resend-verify-email" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "user_id=56" --form "email=usuario@exemplo.com"'><i
                                            class="bi bi-clipboard"></i></button>
                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/user/resend-verify-email" \
  --header "X-API-KEY: {sua-api-key}" \
  --header "Authorization: Bearer {seu-token}" \
  --form "user_id=56" \
  --form "email=usuario@exemplo.com"</code></pre>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>

                <article id="rotas-protegidas" class="docs-section" data-aos="fade-up">
                    <h2><i class="bi bi-lock-fill me-2 text-primary"></i>Rotas Protegidas</h2>
                    <p>⚠️ Todas as rotas abaixo requerem autenticação com <strong>Token Bearer</strong> além da
                        <strong>API Key</strong>.
                    </p>

                    <div class="accordion accordion-flush accordion-routes mt-4" id="accordionRoutes">
                        <!-- USUÁRIOS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapseUsuarios" aria-expanded="false"
                                    aria-controls="collapseUsuarios">
                                    <i class="bi bi-person-circle me-2 text-primary"></i>
                                    <strong>Usuários</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapseUsuarios" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>👥 Listar Usuários com Filtro <small class="text-muted">GET
                                                /api/user/get-users-by-filter</small></h5>
                                        <p>Query parameters: <code>id, name, email, profile_id, is_active, data_de,
                                                data_ate, page, page_size</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/user/get-users-by-filter?id=&name=&email=&profile_id=&is_active=&data_de=&data_ate=&page=1&page_size=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/user/get-users-by-filter?id=&name=&email=&profile_id=&is_active=&data_de=&data_ate=&page=1&page_size=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request GET "http://localhost:8001/api/user/get-users-by-filter?id=&name=&email=&profile_id=&is_active=&data_de=&data_ate=&page=1&page_size=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request GET "http://localhost:8001/api/user/get-users-by-filter?id=&name=&email=&profile_id=&is_active=&data_de=&data_ate=&page=1&page_size=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":[{"id":1,"email":"admin@portoshop.com","owner":{"id":1,"name":"ARMANDO THIEL"},"isActive":true,"createdAt":"2025-12-31T22:22:48.000000Z"}],"message":"Usuários filtrados com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "email": "admin@portoshop.com",
            "owner": { "id": 1, "name": "ARMANDO THIEL" },
            "isActive": true,
            "createdAt": "2025-12-31T22:22:48.000000Z"
        }
    ],
    "message": "Usuários filtrados com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Usuário <small class="text-muted">POST /api/user/create</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (JSON)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{
    "profile_id": 1,
    "name": "Nome Completo",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "senha-segura",
    "password_confirmation": "senha-segura"
}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "profile_id": 1,
    "name": "Nome Completo",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "senha-segura",
    "password_confirmation": "senha-segura"
}</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/user/create" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "profile_id=1" --form "name=Mae Zulauf" --form "email=Emelia_Osinski@example.net" --form "document=24215507855" --form "birth_date=1946-02-21" --form "phone=758-233-9349" --form "address=565 Schamberger Place" --form "password=admin@321" --form "password_confirmation=admin@321"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/user/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "profile_id=1" \
    --form "name=Mae Zulauf" \
    --form "email=Emelia_Osinski@example.net" \
    --form "document=24215507855" \
    --form "birth_date=1946-02-21" \
    --form "phone=758-233-9349" \
    --form "address=565 Schamberger Place" \
    --form "password=admin@321" \
    --form "password_confirmation=admin@321"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{
    "success": true,
    "data": {
        "id": 58,
        "email": "usuario@exemplo.com",
        "profileId": 1,
        "isActive": true,
        "verificationCode": "XXXXXX",
        "verificationExpiresAt": "2026-01-14T14:58:59.437080Z"
    },
    "message": "Usuário criado com sucesso"
}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 58,
        "email": "usuario@exemplo.com",
        "profileId": 1,
        "isActive": true,
        "verificationCode": "XXXXXX",
        "verificationExpiresAt": "2026-01-14T14:58:59.437080Z"
    },
    "message": "Usuário criado com sucesso"
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Usuário <small class="text-muted">PUT /api/user/{id}</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (JSON)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{
    "profile_id": 1,
    "name": "Nome Atualizado",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "nova-senha",
    "password_confirmation": "nova-senha"
}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "profile_id": 1,
    "name": "Nome Atualizado",
    "email": "usuario@exemplo.com",
    "document": "00000000000",
    "birth_date": "YYYY-MM-DD",
    "phone": "(xx) xxxx-xxxx",
    "address": "Endereço completo",
    "password": "nova-senha",
    "password_confirmation": "nova-senha"
}</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash (form-data com _method)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/user/56" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "profile_id=1" --form "name=Clarence Nader" --form "email=Rudolph_Pouros@example.com" --form "document=43616685664" --form "birth_date=1985-05-10" --form "phone=272-819-1280" --form "address=85311 Darren Light" --form "password=admin@321" --form "password_confirmation=admin@321" --form "_method=PUT"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/user/56" \
  --header "X-API-KEY: {sua-api-key}" \
  --header "Authorization: Bearer {seu-token}" \
  --form "profile_id=1" \
  --form "name=Clarence Nader" \
  --form "email=Rudolph_Pouros@example.com" \
  --form "document=43616685664" \
  --form "birth_date=1985-05-10" \
  --form "phone=272-819-1280" \
  --form "address=85311 Darren Light" \
  --form "password=admin@321" \
  --form "password_confirmation=admin@321" \
  --form "_method=PUT"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{
    "success": true,
    "data": {
        "id": 56,
        "email": "usuario@exemplo.com",
        "profileId": 1,
        "isActive": true
    },
    "message": "Usuário atualizado com sucesso."
}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 56,
        "email": "usuario@exemplo.com",
        "profileId": 1,
        "isActive": true
    },
    "message": "Usuário atualizado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Usuário <small class="text-muted">DELETE /api/user/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/user/59" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE "http://localhost:8001/api/user/59" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success":true,"data":null,"message":"Usuário excluído com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Usuário excluído com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <!-- PRODUTOS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapseProdutos" aria-expanded="false"
                                    aria-controls="collapseProdutos">
                                    <i class="bi bi-box me-2 text-primary"></i>
                                    <strong>Produtos</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapseProdutos" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>📦 Listar Produtos com Filtro <small class="text-muted">GET
                                                /api/product/get-products-by-filter</small></h5>
                                        <p>Query parameters: <code>id, name, category_id, unit_id, barcode, is_active,
                                                user_id_created, date_de, date_ate, page, page_size</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/product/get-products-by-filter?id=20&name=null&category_id=null&unit_id=null&barcode=null&is_active=null&user_id_created=null&date_de=null&date_ate=null&page=1&page_size=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/product/get-products-by-filter?id=20&name=null&category_id=null&unit_id=null&barcode=null&is_active=null&user_id_created=null&date_de=null&date_ate=null&page=1&page_size=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request GET "http://localhost:8001/api/product/get-products-by-filter?id=20&name=null&category_id=null&unit_id=null&barcode=null&is_active=null&user_id_created=null&date_de=null&date_ate=null&page=1&page_size=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request GET "http://localhost:8001/api/product/get-products-by-filter?id=20&name=null&category_id=null&unit_id=null&barcode=null&is_active=null&user_id_created=null&date_de=null&date_ate=null&page=1&page_size=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":[{"id":20,"name":"AUDREY OBERBRUNNER","description":null,"images":[{"id":28,"product_id":20,"image":"products/Ii0JFfMR2tCeSsvulbj5t8y16jC6uKExtALg434u.png","created_at":"2026-01-13 10:44:48","updated_at":"2026-01-13 10:44:48"}],"category":{"id":1,"name":"TECNOLOGIAS"},"unit":{"id":1,"name":"LENA MEDHURST","abbreviation":"SCSI","format":"1"},"barcode":"GB65RFAZ04098873426923","isActive":true,"price":998,"costPrice":799,"stockQuantity":801,"minQuantity":905,"owner":{"id":1,"name":"ARMANDO THIEL"},"userCreated":{"id":1,"name":"ARMANDO THIEL"},"userUpdated":{"id":1,"name":"ARMANDO THIEL"},"userDeleted":null,"createdAt":"2026-01-13T07:44:48.000000Z","updatedAt":"2026-01-14T12:30:58.000000Z","deletedAt":null}],"message":"Produto Filtrado com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": 20,
            "name": "AUDREY OBERBRUNNER",
            "description": null,
            "images": [
                {
                    "id": 28,
                    "product_id": 20,
                    "image": "products/Ii0JFfMR2tCeSsvulbj5t8y16jC6uKExtALg434u.png",
                    "created_at": "2026-01-13 10:44:48",
                    "updated_at": "2026-01-13 10:44:48"
                }
            ],
            "category": { "id": 1, "name": "TECNOLOGIAS" },
            "unit": { "id": 1, "name": "LENA MEDHURST", "abbreviation": "SCSI", "format": "1" },
            "barcode": "GB65RFAZ04098873426923",
            "isActive": true,
            "price": 998,
            "costPrice": 799,
            "stockQuantity": 801,
            "minQuantity": 905,
            "owner": { "id": 1, "name": "ARMANDO THIEL" },
            "userCreated": { "id": 1, "name": "ARMANDO THIEL" },
            "userUpdated": { "id": 1, "name": "ARMANDO THIEL" },
            "userDeleted": null,
            "createdAt": "2026-01-13T07:44:48.000000Z",
            "updatedAt": "2026-01-14T12:30:58.000000Z",
            "deletedAt": null
        }
    ],
    "message": "Produto Filtrado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Produto <small class="text-muted">POST /api/product/create</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Maida
unit_id=1
category_id=1
is_active=1
description=Ray
barcode=MC590930507740VV58028753384
price=98
cost_price=268
stock_quantity=105
min_quantity=838
images[]=@/caminho/imagem1.png
images[]=@/caminho/imagem2.png'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Maida
unit_id=1
category_id=1
is_active=1
description=Ray
barcode=MC590930507740VV58028753384
price=98
cost_price=268
stock_quantity=105
min_quantity=838
images[]=@/caminho/imagem1.png
images[]=@/caminho/imagem2.png</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/product/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Maida" \
    --form "unit_id=1" \
    --form "category_id=1" \
    --form "is_active=1" \
    --form "images[]=@imagem1.png" \
    --form "images[]=@imagem2.png" \
    --form "description=Ray" \
    --form "barcode=MC590930507740VV58028753384" \
    --form "price=98" \
    --form "cost_price=268" \
    --form "stock_quantity=105" \
    --form "min_quantity=838"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/product/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Maida" \
    --form "unit_id=1" \
    --form "category_id=1" \
    --form "is_active=1" \
    --form "images[]=@imagem1.png" \
    --form "images[]=@imagem2.png" \
    --form "description=Ray" \
    --form "barcode=MC590930507740VV58028753384" \
    --form "price=98" \
    --form "cost_price=268" \
    --form "stock_quantity=105" \
    --form "min_quantity=838"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":24,"name":"COLEMAN","description":null,"categoryId":1,"unitId":1,"barcode":"ME48004609680580469012","isActive":true,"price":164,"costPrice":388,"stockQuantity":746,"minQuantity":967,"ownerId":1,"images":[{"product_id":24,"image":"products/kw7ZQREVpMYBBVlxnakrdx6L5PGsmQ2TO5vRH0Ur.png","updated_at":"2026-01-14T15:30:27.000000Z","created_at":"2026-01-14T15:30:27.000000Z","id":36},{"product_id":24,"image":"products/WgUMPwqfYDjl7MHt3zpmRAzraNpe5cTd6Wh9oBHo.png","updated_at":"2026-01-14T15:30:27.000000Z","created_at":"2026-01-14T15:30:27.000000Z","id":37}],"userIdCreated":1,"userIdUpdated":null,"userIdDeleted":null,"createdAt":"2026-01-14T15:30:26.000000Z","updatedAt":"2026-01-14T15:30:26.000000Z","deletedAt":null},"message":"Produto criado com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 24,
        "name": "COLEMAN",
        "description": null,
        "categoryId": 1,
        "unitId": 1,
        "barcode": "ME48004609680580469012",
        "isActive": true,
        "price": 164,
        "costPrice": 388,
        "stockQuantity": 746,
        "minQuantity": 967,
        "images": [
            {
                "product_id": 24,
                "image": "products/kw7ZQREVpMYBBVlxnakrdx6L5PGsmQ2TO5vRH0Ur.png",
                "updated_at": "2026-01-14T15:30:27.000000Z",
                "created_at": "2026-01-14T15:30:27.000000Z",
                "id": 36
            }
        ],
        "userIdCreated": 1,
        "createdAt": "2026-01-14T15:30:26.000000Z",
        "updatedAt": "2026-01-14T15:30:26.000000Z",
        "deletedAt": null
    },
    "message": "Produto criado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Produto <small class="text-muted">PUT /api/product/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Pam Monahan
unit_id=1
category_id=1
is_active=1
description=Legros, Goldner and Kohler
barcode=SK4402375108127003090045
price=487
cost_price=135
stock_quantity=299
min_quantity=193
images[]=@/caminho/imagem.png
_method=PUT'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Pam Monahan
unit_id=1
category_id=1
is_active=1
description=Legros, Goldner and Kohler
barcode=SK4402375108127003090045
price=487
cost_price=135
stock_quantity=299
min_quantity=193
images[]=@/caminho/imagem.png
_method=PUT</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/product/20" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Pam Monahan" \
    --form "unit_id=1" \
    --form "category_id=1" \
    --form "is_active=1" \
    --form "images[]=@imagem.png" \
    --form "description=Legros, Goldner and Kohler" \
    --form "barcode=SK4402375108127003090045" \
    --form "price=487" \
    --form "cost_price=135" \
    --form "stock_quantity=299" \
    --form "min_quantity=193" \
    --form "_method=PUT"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/product/20" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Pam Monahan" \
    --form "unit_id=1" \
    --form "category_id=1" \
    --form "is_active=1" \
    --form "images[]=@imagem.png" \
    --form "description=Legros, Goldner and Kohler" \
    --form "barcode=SK4402375108127003090045" \
    --form "price=487" \
    --form "cost_price=135" \
    --form "stock_quantity=299" \
    --form "min_quantity=193" \
    --form "_method=PUT"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":20,"name":"AUDREY OBERBRUNNER","description":null,"categoryId":1,"unitId":1,"barcode":"GB65RFAZ04098873426923","isActive":true,"price":998,"costPrice":799,"stockQuantity":801,"minQuantity":905,"ownerId":1,"images":null,"userIdCreated":1,"userIdUpdated":1,"userIdDeleted":null,"createdAt":"2026-01-13T10:44:48.000000Z","updatedAt":"2026-01-14T15:30:58.000000Z","deletedAt":null},"message":"Produto atualizado com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 20,
        "name": "AUDREY OBERBRUNNER",
        "description": null,
        "categoryId": 1,
        "unitId": 1,
        "barcode": "GB65RFAZ04098873426923",
        "isActive": true,
        "price": 998,
        "costPrice": 799,
        "stockQuantity": 801,
        "minQuantity": 905,
        "ownerId": 1,
        "images": null,
        "userIdCreated": 1,
        "userIdUpdated": 1,
        "userIdDeleted": null,
        "createdAt": "2026-01-13T10:44:48.000000Z",
        "updatedAt": "2026-01-14T15:30:58.000000Z",
        "deletedAt": null
    },
    "message": "Produto atualizado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Produto <small class="text-muted">DELETE /api/product/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/product/25" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE "http://localhost:8001/api/product/25" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success":true,"data":null,"message":"Produto excluído com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Produto excluído com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <!-- CATEGORIAS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapseCategorias" aria-expanded="false"
                                    aria-controls="collapseCategorias">
                                    <i class="bi bi-folder me-2 text-primary"></i>
                                    <strong>Categorias</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapseCategorias" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>📂 Listar Categorias com Filtro <small class="text-muted">GET
                                                /api/category/get-categories-by-filter</small></h5>
                                        <p>Query parameters: <code>id, name, page, pageSize</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/category/get-categories-by-filter?id=&name=null&page=1&pageSize=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/category/get-categories-by-filter?id=&name=null&page=1&pageSize=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request GET "http://localhost:8001/api/category/get-categories-by-filter?id=&name=null&page=1&pageSize=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request GET "http://localhost:8001/api/category/get-categories-by-filter?id=&name=null&page=1&pageSize=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":[{"id":1,"owner":{"id":1,"name":"ARMANDO THIEL"},"name":"TECNOLOGIAS TECNOLOGIAS TECNOLOGIAS TECNOLOGIAS TE","description":"itens tecnologicos","userCreated":{"id":1,"name":"ARMANDO THIEL"},"userUpdated":{"id":1,"name":"ARMANDO THIEL"},"userDeleted":null,"createdAt":"2025-12-31T22:24:31.000000Z","updatedAt":"2026-01-09T19:09:25.000000Z","deletedAt":null}],"message":"Categorias filtradas com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "owner": { "id": 1, "name": "ARMANDO THIEL" },
            "name": "TECNOLOGIAS TECNOLOGIAS TECNOLOGIAS TECNOLOGIAS TE",
            "description": "itens tecnologicos",
            "userCreated": { "id": 1, "name": "ARMANDO THIEL" },
            "userUpdated": { "id": 1, "name": "ARMANDO THIEL" },
            "userDeleted": null,
            "createdAt": "2025-12-31T22:24:31.000000Z",
            "updatedAt": "2026-01-09T19:09:25.000000Z",
            "deletedAt": null
        }
    ],
    "message": "Categorias filtradas com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Categoria <small class="text-muted">POST /api/category/create</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Alberta Gerlach PhD
description=voluptatem'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Alberta Gerlach PhD
description=voluptatem</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/category/create" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "name=Alberta Gerlach PhD" --form "description=voluptatem"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/category/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Alberta Gerlach PhD" \
    --form "description=voluptatem"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":12,"ownerId":1,"name":"MARCELLA MURAZIK","description":"molestiae","userIdCreated":1,"userIdUpdated":null,"userIdDeleted":null,"createdAt":"2026-01-14T15:40:14.000000Z","updatedAt":"2026-01-14T15:40:14.000000Z","deletedAt":null},"message":"Categoria criada com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 12,
        "ownerId": 1,
        "name": "MARCELLA MURAZIK",
        "description": "molestiae",
        "userIdCreated": 1,
        "userIdUpdated": null,
        "userIdDeleted": null,
        "createdAt": "2026-01-14T15:40:14.000000Z",
        "updatedAt": "2026-01-14T15:40:14.000000Z",
        "deletedAt": null
    },
    "message": "Categoria criada com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Categoria <small class="text-muted">PUT /api/category/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Julio Frami
description=Ratione quas debitis asperiores consequatur autem perferendis vero omnis.
_method=PUT'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Julio Frami
description=Ratione quas debitis asperiores...
_method=PUT</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/category/10" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "_method=PUT" --form "name=Julio Frami" --form "description=Ratione quas debitis asperiores consequatur autem perferendis vero omnis."'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/category/10" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "_method=PUT" \
    --form "name=Julio Frami" \
    --form "description=Ratione quas debitis asperiores..."</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Categoria <small class="text-muted">DELETE
                                                /api/category/{id}</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/category/13" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE "http://localhost:8001/api/category/13" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success":true,"data":null,"message":"Categoria excluída com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Categoria excluída com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <!-- UNIDADES -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapseUnidades" aria-expanded="false"
                                    aria-controls="collapseUnidades">
                                    <i class="bi bi-rulers me-2 text-primary"></i>
                                    <strong>Unidades</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapseUnidades" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>📏 Listar Unidades com Filtro <small class="text-muted">GET
                                                /api/unit/get-units-by-filter</small></h5>
                                        <p>Query parameters: <code>name, abbreviation, format, page, page_size</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/unit/get-units-by-filter?name=null&abbreviation=null&format=null&page=1&page_size=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/unit/get-units-by-filter?name=null&abbreviation=null&format=null&page=1&page_size=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/unit/get-units-by-filter?name=null&abbreviation=null&format=null&page=1&page_size=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/unit/get-units-by-filter?name=null&abbreviation=null&format=null&page=1&page_size=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":[{"id":1,"owner":{"id":1,"name":"ARMANDO THIEL"},"name":"LENA MEDHURST","abbreviation":"SCSI","format":1,"userCreated":{"id":1,"name":"ARMANDO THIEL"},"userUpdated":{"id":1,"name":"ARMANDO THIEL"},"userDeleted":null,"createdAt":"2025-12-31T22:25:52.000000Z","updatedAt":"2026-01-05T15:11:00.000000Z","deletedAt":null}],"message":"Unidades filtradas com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "owner": { "id": 1, "name": "ARMANDO THIEL" },
            "name": "LENA MEDHURST",
            "abbreviation": "SCSI",
            "format": 1,
            "userCreated": { "id": 1, "name": "ARMANDO THIEL" },
            "userUpdated": { "id": 1, "name": "ARMANDO THIEL" },
            "userDeleted": null,
            "createdAt": "2025-12-31T22:25:52.000000Z",
            "updatedAt": "2026-01-05T15:11:00.000000Z",
            "deletedAt": null
        }
    ],
    "message": "Unidades filtradas com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Unidade <small class="text-muted">POST /api/unit/create</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Harvey Crona
abbreviation=PCI
format=1'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Harvey Crona
abbreviation=PCI
format=1</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/unit/create" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "name=Harvey Crona" --form "abbreviation=PCI" --form "format=1"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/unit/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Harvey Crona" \
    --form "abbreviation=PCI" \
    --form "format=1"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":16,"ownerId":1,"name":"ERIK SAWAYN III","abbreviation":"COM","format":1,"userIdCreated":1,"userIdUpdated":null,"userIdDeleted":null,"createdAt":"2026-01-14T15:45:20.000000Z","updatedAt":"2026-01-14T15:45:20.000000Z","deletedAt":null},"message":"Unidade criada com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 16,
        "ownerId": 1,
        "name": "ERIK SAWAYN III",
        "abbreviation": "COM",
        "format": 1,
        "userIdCreated": 1,
        "userIdUpdated": null,
        "userIdDeleted": null,
        "createdAt": "2026-01-14T15:45:20.000000Z",
        "updatedAt": "2026-01-14T15:45:20.000000Z",
        "deletedAt": null
    },
    "message": "Unidade criada com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Unidade <small class="text-muted">PUT /api/unit/{id}</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Victoria Dietrich III
abbreviation=COM
format=1
_method=PUT'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Victoria Dietrich III
abbreviation=COM
format=1
_method=PUT</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/unit/5" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "_method=PUT" --form "name=Victoria Dietrich III" --form "abbreviation=COM" --form "format=1"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/unit/5" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "_method=PUT" \
    --form "name=Victoria Dietrich III" \
    --form "abbreviation=COM" \
    --form "format=1"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":5,"ownerId":1,"name":"BEATRICE LITTEL","abbreviation":"RAM","format":1,"userIdCreated":1,"userIdUpdated":1,"userIdDeleted":null,"createdAt":"2026-01-05T01:59:00.000000Z","updatedAt":"2026-01-14T15:47:11.000000Z","deletedAt":null},"message":"Unidade atualizada com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 5,
        "ownerId": 1,
        "name": "BEATRICE LITTEL",
        "abbreviation": "RAM",
        "format": 1,
        "userIdCreated": 1,
        "userIdUpdated": 1,
        "userIdDeleted": null,
        "createdAt": "2026-01-05T01:59:00.000000Z",
        "updatedAt": "2026-01-14T15:47:11.000000Z",
        "deletedAt": null
    },
    "message": "Unidade atualizada com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Unidade <small class="text-muted">DELETE /api/unit/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/unit/17" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE "http://localhost:8001/api/unit/17" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success":true,"data":null,"message":"Unidade excluída com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Unidade excluída com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <!-- PERFIS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapsePerfis" aria-expanded="false"
                                    aria-controls="collapsePerfis">
                                    <i class="bi bi-people me-2 text-primary"></i>
                                    <strong>Perfis</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapsePerfis" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>👤 Listar Perfis com Filtro <small class="text-muted">GET
                                                /api/profile/get-profiles-by-filter</small></h5>
                                        <p>Query parameters: <code>id, name, page, page_size</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/profile/get-profiles-by-filter?id=null&name=null&page=1&page_size=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/profile/get-profiles-by-filter?id=null&name=null&page=1&page_size=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/profile/get-profiles-by-filter?id=null&name=null&page=1&page_size=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/profile/get-profiles-by-filter?id=null&name=null&page=1&page_size=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":[{"id":1,"owner":{"id":1,"name":"ARMANDO THIEL"},"name":"VENDEDOR","description":"Criar produtos e gerenciar","permission":"dashboardcontroller@index,productcontroller@index,productcontroller@show,productcontroller@store,productcontroller@update,productcontroller@destroy,userprofilecontroller@edit,userprofilecontroller@update","userCreated":{"id":1,"name":"ARMANDO THIEL"},"userUpdated":{"id":1,"name":"ARMANDO THIEL"},"userDeleted":null,"createdAt":"2025-12-31T22:24:09.000000Z","updatedAt":"2025-12-31T23:07:25.000000Z","deletedAt":null}],"message":"Perfis filtrados com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "owner": { "id": 1, "name": "ARMANDO THIEL" },
            "name": "VENDEDOR",
            "description": "Criar produtos e gerenciar",
            "permission": "dashboardcontroller@index,productcontroller@index,productcontroller@show,productcontroller@store,productcontroller@update,productcontroller@destroy,userprofilecontroller@edit,userprofilecontroller@update",
            "userCreated": { "id": 1, "name": "ARMANDO THIEL" },
            "userUpdated": { "id": 1, "name": "ARMANDO THIEL" },
            "userDeleted": null,
            "createdAt": "2025-12-31T22:24:09.000000Z",
            "updatedAt": "2025-12-31T23:07:25.000000Z",
            "deletedAt": null
        }
    ],
    "message": "Perfis filtrados com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Perfil <small class="text-muted">POST /api/profile/create</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Robin Mante
description=Brazilian Real
permissions=["unitcontroller@index","productcontroller@update","categorycontroller@destroy","categorycontroller@store","userprofilecontroller@update"]'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Robin Mante
description=Brazilian Real
permissions=["unitcontroller@index","productcontroller@update",
  "categorycontroller@destroy","categorycontroller@store",
  "userprofilecontroller@update"]</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/profile/create" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "name=Robin Mante" --form "description=Brazilian Real" --form "permissions=[\"unitcontroller@index\",\"productcontroller@update\",\"categorycontroller@destroy\"]"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/profile/create" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Robin Mante" \
    --form "description=Brazilian Real" \
    --form "permissions=[\"unitcontroller@index\",\"productcontroller@update\"]"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":9,"ownerId":1,"name":"MR. KELLY DICKENS","description":"Vatu","permission":"unitcontroller@store,productcontroller@index,userprofilecontroller@update,productcontroller@update,categorycontroller@update","userIdCreated":1,"userIdUpdated":null,"userIdDeleted":null,"createdAt":"2026-01-14T15:52:09.000000Z","updatedAt":"2026-01-14T15:52:09.000000Z","deletedAt":null},"message":"Perfil criado com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 9,
        "ownerId": 1,
        "name": "MR. KELLY DICKENS",
        "description": "Vatu",
        "permission": "unitcontroller@store,productcontroller@index,userprofilecontroller@update,productcontroller@update,categorycontroller@update",
        "userIdCreated": 1,
        "userIdUpdated": null,
        "userIdDeleted": null,
        "createdAt": "2026-01-14T15:52:09.000000Z",
        "updatedAt": "2026-01-14T15:52:09.000000Z",
        "deletedAt": null
    },
    "message": "Perfil criado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Perfil <small class="text-muted">PUT /api/profile/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='name=Ricky Corwin
description=Kroon
permissions=["usercontroller@update","usercontroller@index","productcontroller@update","productcontroller@show","profilecontroller@update"]
_method=PUT'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>name=Ricky Corwin
description=Kroon
permissions=["usercontroller@update","usercontroller@index",
  "productcontroller@update","productcontroller@show",
  "profilecontroller@update"]
_method=PUT</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/profile/5" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "name=Ricky Corwin" --form "description=Kroon" --form "permissions=[\"usercontroller@update\",\"usercontroller@index\"]" --form "_method=PUT"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/profile/5" \
    --header "X-API-KEY: {sua-api-key}" \
    --header "Authorization: Bearer {seu-token}" \
    --form "name=Ricky Corwin" \
    --form "description=Kroon" \
    --form "permissions=[\"usercontroller@update\",\"usercontroller@index\"]" \
    --form "_method=PUT"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":5,"ownerId":1,"name":"lynn champlin","description":"Paanga","permission":"profilecontroller@store,categorycontroller@update,profilecontroller@index,productcontroller@update,userprofilecontroller@update","userIdCreated":1,"userIdUpdated":1,"userIdDeleted":null,"createdAt":"2026-01-13T19:35:35.000000Z","updatedAt":"2026-01-14T15:52:31.000000Z","deletedAt":null},"message":"Perfil
                                                atualizado com sucesso."}'><i class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": 5,
        "ownerId": 1,
        "name": "lynn champlin",
        "description": "Paanga",
        "permission": "profilecontroller@store,categorycontroller@update,profilecontroller@index,productcontroller@update,userprofilecontroller@update",
        "userIdCreated": 1,
        "userIdUpdated": 1,
        "userIdDeleted": null,
        "createdAt": "2026-01-13T19:35:35.000000Z",
        "updatedAt": "2026-01-14T15:52:31.000000Z",
        "deletedAt": "2026-01-14T15:52:31.000000Z"
    },
    "message": "Perfil atualizado com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Perfil <small class="text-muted">DELETE /api/profile/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/profile/10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE "http://localhost:8001/api/profile/10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success":true,"data":null,"message":"Perfil excluído com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Perfil excluído com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <!-- Empresas -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-target="#collapseEmpresas" aria-expanded="false"
                                    aria-controls="collapseEmpresas">
                                    <i class="bi bi-people me-2 text-primary"></i>
                                    <strong>Empresas</strong>
                                    <span class="badge bg-secondary ms-auto me-2">4 rotas</span>
                                </button>
                            </h2>
                            <div id="collapseEmpresas" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <section class="route">
                                        <h5>👤 Listar Empresas com Filtro <small class="text-muted">GET
                                                /api/company/get-companies-by-filter</small></h5>
                                        <p>Query parameters: <code>id, fantasyName, page, page_size</code></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo de URL</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='http://localhost:8001/api/company/get-companies-by-filter?id=null&fantasyName=null&page=1&page_size=10'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>http://localhost:8001/api/company/get-companies-by-filter?id=null&fantasyName=null&page=1&page_size=10</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/company/get-companies-by-filter?id=null&fantasyName=null&page=1&page_size=10" -H "X-API-KEY: {sua-api-key}" -H "Authorization: Bearer {seu-token}"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location "http://localhost:8001/api/company/get-companies-by-filter?id=null&fantasyName=null&page=1&page_size=10" \
    -H "X-API-KEY: {sua-api-key}" \
    -H "Authorization: Bearer {seu-token}"</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                            data-copy='{"success": true, "data": {"id": "019c15dd-4c0f-707e-8322-dd45e7f52411", "ownerId": 6, "fantasyName": "Gregory Paucek", "description": "vel", "legalName": "Ruth Lindgren III", "document": "23141882339", "email": "Holden9@gmail.com", "image": "companies/2eJXPDvbgP3wt8j3POrFN2nR74A3wNMwhYOrudcf.png", "primaryColor": "#547f17", "secondaryColor": "#464f7d", "domain": "shaniya.net", "zipCode": "969", "state": "TN", "city": "Lincoln", "neighborhood": "Clemens Causeway", "street": "Marks Trail", "number": "657", "complement": "Enim voluptatem quibusdam minima ut et sint et.\nNobis nesciunt molestiae totam ut amet doloremque placeat.\nLaborum ut vel natus dolorem.", "isActive": true, "userIdCreated": 6, "userIdUpdated": null, "userIdDeleted": null}, "message": "Empresa criada com sucesso."}'><i
                                            class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": [
        {
            "id": "019c15d6-db91-73f4-b410-2ff477ec8745",
            "owner": {
                "id": 1,
                "name": "MS. ARNOLD HARTMANN"
            },
            "fantasyName": "Shawna Abernathy",
            "description": "Praesentium deleniti quos laudantium ea ab corrupti magni voluptatem.",
            "legalName": "Laura Durgan",
            "document": "23141882339",
            "email": "Nils31@hotmail.com",
            "phone": "7274644227",
            "image": "companies/yJr3xAVd105mJ5Z6Yo546lPsVnRg718VmYmaaKZv.png",
            "primaryColor": "#405109",
            "secondaryColor": "#3f6e3b",
            "domain": "jamie.info",
            "zipCode": "848",
            "state": "LY",
            "city": "Powlowskiberg",
            "neighborhood": "Jedidiah Cliffs",
            "street": "Aracely Centers",
            "number": "768",
            "complement": "Reiciendis quis assumenda omnis dolor temporibus ex dolorem omnis.\nId nihil qui amet aperiam atque tempore.\nIure qui placeat voluptas pariatur.",
            "isActive": true,
            "userCreated": {
                "id": 1,
                "name": "MS. ARNOLD HARTMANN"
            },
            "userUpdated": null,
            "userDeleted": null,
            "createdAt": "2026-01-31T17:55:28.000000Z",
            "updatedAt": "2026-01-31T17:55:28.000000Z",
            "deletedAt": null
        }
    ],
    "message": "Empresas filtradas com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>➕ Criar Company <small class="text-muted">POST /api/company/create</small></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                    data-copy='fantasy_name="Nichole Wehner DDS"\ndescription="Alias quibusdam quia quaerat. Ad ipsa voluptatem sed quis quae aperiam. Voluptas quo quasi. Maiores possimus exercitationem quia repellendus nesciunt nulla. Sed eum dolorum qui magnam ut."\nlegal_name="Max Nikolaus"\ndocument="23141882339"\nemail="Fidel_Kohler77@gmail.com"\nphone="283-701-9012"\nimage=@"/caminho/da/imagem.png"\nprimary_color="#2d271a"\nsecondary_color="#32574f"\ndomain="kelley.biz"\nzip_code="133"\nstate="EE"\ncity="Armandoton"\nneighborhood="Velva Prairie"\nstreet="Jeanette Flats"\nnumber="280"\ncomplement="nisi asperiores"\nis_active="true"'><i
                                                        class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>fantasy_name="Nichole Wehner DDS",
description="Sed eum dolorum qui magnam ut.",
legal_name="Max Nikolaus",
document="23141882339",
email="Fidel_Kohler77@gmail.com",
phone="283-701-9012",
image=@"/caminho/da/imagem.png",
primary_color="#2d271a",
secondary_color="#32574f",
domain="kelley.biz",
zip_code="133",
state="EE",
city="Armandoton",
neighborhood="Velva Prairie",
street="Jeanette Flats",
number="280",
complement="nisi asperiores",
is_active="true"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/company/create" --header "X-API-KEY: shop_api_123" --header "Authorization: Bearer 6|GXYEjjoXJ8siyDwtI3yKbW9XHRnOfGdnX4puUZlm1e9a7a00" --form "fantasy_name="Lonnie Robel" --form "description="Corporis et quia minus similique."" --form "legal_name="Herbert Funk"" --form "document="23141882339"" --form "email="Emilio41@gmail.com"" --form "phone="840-713-2964"" --form "image=@"postman-cloud:///1f0eae9a-5776-4430-b07f-b649a6156af6"" --form "primary_color="\#696858"" --form "secondary_color="\#133f04"" --form "domain="al.org"" --form "zip_code="754"" --form "state="TD"" --form "city="Parma"" --form "neighborhood="Lebsack Locks"" --form "street="Luz View"" --form "number="31"" --form "complement="Est atque magnam quibusdam et impedit nesciunt."" --form "is_active="true""'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location 'http://localhost:8001/api/company/create' \
--header 'X-API-KEY: shop_api_123' \
--header 'Authorization: Bearer 6|GXYEjjoXJ8siyDwtI3yKbW9XHRnOfGdnX4puUZlm1e9a7a00' \
--form 'fantasy_name="Lynette Schuppe"' \
--form 'description="Corrupti aut ad est facilis qui est consequatur sapiente."' \
--form 'legal_name="Glenn Kshlerin"' \
--form 'document="23141882339"' \
--form 'email="Norma_Kuhn64@gmail.com"' \
--form 'phone="414-766-3196"' \
--form 'image=@"postman-cloud:///1f0eae9a-5776-4430-b07f-b649a6156af6"' \
--form 'primary_color="\#5b2e76"' \
--form 'secondary_color="\#7b5471"' \
--form 'domain="dorris.info"' \
--form 'zip_code="777"' \
--form 'state="NO"' \
--form 'city="Port Riverstad"' \
--form 'neighborhood="Ernser Radial"' \
--form 'street="Greenfelder Circle"' \
--form 'number="998"' \
--form 'complement="Non nobis earum sapiente ut tempora. Blanditiis consequuntur repellat dolorum. Qui illum magni. Nobis amet nemo cupiditate sapiente ad."' \
--form 'is_active="true"'</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success":true,"data":{"id":9,"ownerId":1,"name":"MR. KELLY DICKENS","description":"Vatu","permission":"unitcontroller@store,productcontroller@index,userprofilecontroller@update,productcontroller@update,categorycontroller@update","userIdCreated":1,"userIdUpdated":null,"userIdDeleted":null,"createdAt":"2026-01-14T15:52:09.000000Z","updatedAt":"2026-01-14T15:52:09.000000Z","deletedAt":null},"message":"Perfil criado com sucesso."}'><i
                                                    class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": "019c15dd-4c0f-707e-8322-dd45e7f52411",
        "ownerId": 6,
        "fantasyName": "Gregory Paucek",
        "description": "vel",
        "legalName": "Ruth Lindgren III",
        "document": "23141882339",
        "email": "Holden9@gmail.com",
        "image": "companies/2eJXPDvbgP3wt8j3POrFN2nR74A3wNMwhYOrudcf.png",
        "primaryColor": "#547f17",
        "secondaryColor": "#464f7d",
        "domain": "shaniya.net",
        "zipCode": "969",
        "state": "TN",
        "city": "Lincoln",
        "neighborhood": "Clemens Causeway",
        "street": "Marks Trail",
        "number": "657",
        "complement": "Enim voluptatem quibusdam minima ut et sint et.\nNobis nesciunt molestiae totam ut amet doloremque placeat.\nLaborum ut vel natus dolorem.",
        "isActive": true,
        "userIdCreated": 6,
        "userIdUpdated": null,
        "userIdDeleted": null
    },
    "message": "Empresa criada com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>📝 Atualizar Empresa <small class="text-muted">PUT /api/company/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Payload (form-data)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='fantasy_name="Nichole Wehner DDS"\ndescription="Alias quibusdam quia quaerat. Ad ipsa voluptatem sed quis quae aperiam. Voluptas quo quasi. Maiores possimus exercitationem quia repellendus nesciunt nulla. Sed eum dolorum qui magnam ut."\nlegal_name="Max Nikolaus"\ndocument="23141882339"\nemail="Fidel_Kohler77@gmail.com"\nphone="283-701-9012"\nimage=@"/caminho/da/imagem.png"\nprimary_color="#2d271a"\nsecondary_color="#32574f"\ndomain="kelley.biz"\nzip_code="133"\nstate="EE"\ncity="Armandoton"\nneighborhood="Velva Prairie"\nstreet="Jeanette Flats"\nnumber="280"\ncomplement="nisi asperiores"\nis_active="true"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>fantasy_name="Nichole Wehner DDS",
description="Sed eum dolorum qui magnam ut.",
legal_name="Max Nikolaus",
document="23141882339",
email="Fidel_Kohler77@gmail.com",
phone="283-701-9012",
image=@"/caminho/da/imagem.png",
primary_color="#2d271a",
secondary_color="#32574f",
domain="kelley.biz",
zip_code="133",
state="EE",
city="Armandoton",
neighborhood="Velva Prairie",
street="Jeanette Flats",
number="280",
complement="nisi asperiores",
is_active="true"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location "http://localhost:8001/api/company/019c15dd-4c0f-707e-8322-dd45e7f52411" --header "X-API-KEY: {sua-api-key}" --header "Authorization: Bearer {seu-token}" --form "name=Ricky Corwin" --form "description=Kroon" --form "permissions=[\"usercontroller@update\",\"usercontroller@index\"]" --form "_method=PUT"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location 'http://localhost:8001/api/company/019c157f-162f-7064-956c-261e3613ad80' \
--header 'X-API-KEY: shop_api_123' \
--header 'Authorization: Bearer 6|GXYEjjoXJ8siyDwtI3yKbW9XHRnOfGdnX4puUZlm1e9a7a00' \
--form 'fantasy_name="Margarita Waelchi"' \
--form 'description="Sint id sunt corporis suscipit officiis veritatis. Vitae id maxime quidem similique exercitationem velit sapiente laboriosam."' \
--form 'legal_name="Roland Schroeder"' \
--form 'document="23141882339"' \
--form 'email="Jesse_Zemlak3@yahoo.com"' \
--form 'phone="345-522-8749"' \
--form 'image=@"postman-cloud:///1f0eae9a-5776-4430-b07f-b649a6156af6"' \
--form 'primary_color="\#69173b"' \
--form 'secondary_color="\#78414b"' \
--form 'domain="graham.info"' \
--form 'zip_code="757"' \
--form 'state="IO"' \
--form 'city="Morgan Hill"' \
--form 'neighborhood="Volkman Ports"' \
--form 'street="Crist Points"' \
--form 'number="756"' \
--form 'complement="Quaerat et qui et et neque cum. Labore et et expedita. At qui pariatur dolores ut ipsam ratione qui dolor voluptatum. Et sed enim et."' \
--form 'is_active="true"' \
--form '_method="PUT"'</code></pre>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mt-3">Resposta (exemplo)</h6>
                                        <div class="code-wrap"><button class="btn-copy"
                                                data-copy='{"success": true,"data": {"id": "019c15dd-4c0f-707e-8322-dd45e7f52411","ownerId": 6,"fantasyName": "Kevin Kohler","description": "Dicta beatae aperiam aliquam commodi voluptates molestiae et id rerum.\nFugit dolorem illum fugiat velit velit voluptatem neque ea.\nNisi quod assumenda culpa quam voluptate tempore quia et.\nOccaecati qui facere quibusdam.\nQuam sunt laboriosam nihil.","legalName": "Rhonda Rohan MD","document": "23141882339","email": "Torey.Beer@hotmail.com","image": "companies/9aNun5exznmI6Kt0R0sDHwis5McMg73oN5KDOtMH.png","primaryColor": "#382a28","secondaryColor": "#62650c","domain": "giovanny.org","zipCode": "949","state": "MM","city": "Littelville","neighborhood": "Samara Prairie","street": "Cullen Points","number": "883","complement": "Magnam enim reprehenderit inventore earum.","isActive": true,"userIdCreated": 6,"userIdUpdated": 6,"userIdDeleted": null},"message": "Empresa atualizada com sucesso."}'><i class="bi bi-clipboard"></i></button>
                                            <pre class="code-block"><code>{
    "success": true,
    "data": {
        "id": "019c15dd-4c0f-707e-8322-dd45e7f52411",
        "ownerId": 6,
        "fantasyName": "Kevin Kohler",
        "description": "Dicta beatae aperiam aliquam commodi voluptates molestiae et id rerum.\nFugit dolorem illum fugiat velit velit voluptatem neque ea.\nNisi quod assumenda culpa quam voluptate tempore quia et.\nOccaecati qui facere quibusdam.\nQuam sunt laboriosam nihil.",
        "legalName": "Rhonda Rohan MD",
        "document": "23141882339",
        "email": "Torey.Beer@hotmail.com",
        "image": "companies/9aNun5exznmI6Kt0R0sDHwis5McMg73oN5KDOtMH.png",
        "primaryColor": "#382a28",
        "secondaryColor": "#62650c",
        "domain": "giovanny.org",
        "zipCode": "949",
        "state": "MM",
        "city": "Littelville",
        "neighborhood": "Samara Prairie",
        "street": "Cullen Points",
        "number": "883",
        "complement": "Magnam enim reprehenderit inventore earum.",
        "isActive": true,
        "userIdCreated": 6,
        "userIdUpdated": 6,
        "userIdDeleted": null
    },
    "message": "Empresa atualizada com sucesso."
}</code></pre>
                                        </div>
                                    </section>

                                    <hr class="my-3">

                                    <section class="route">
                                        <h5>🗑️ Deletar Empresa <small class="text-muted">DELETE /api/company/{id}</small>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Exemplo em Bash</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='curl --location --request DELETE "http://localhost:8001/api/company/019c15dd-4c0f-707e-8322-dd45e7f52411" --header "X-API-KEY: shop_api_123" --header "Authorization: Bearer 6|GXYEjjoXJ8siyDwtI3yKbW9XHRnOfGdnX4puUZlm1e9a7a00"'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>curl --location --request DELETE 'http://localhost:8001/api/company/019c15dd-4c0f-707e-8322-dd45e7f52411' \
--header 'X-API-KEY: shop_api_123' \
--header 'Authorization: Bearer 6|GXYEjjoXJ8siyDwtI3yKbW9XHRnOfGdnX4puUZlm1e9a7a00'"</code></pre>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Resposta (exemplo)</h6>
                                                <div class="code-wrap"><button class="btn-copy"
                                                        data-copy='{"success": true,"data": null,"message": "Empresa excluída com sucesso."}'><i
                                                            class="bi bi-clipboard"></i></button>
                                                    <pre class="code-block"><code>{
    "success": true,
    "data": null,
    "message": "Empresa excluída com sucesso."
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>    
                    </div>
                </article>
            </section>
        </div>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true
        });

        // Copy button functionality
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-copy');
            if (!btn) return;
            e.stopPropagation();
            const text = btn.getAttribute('data-copy') || '';
            navigator.clipboard.writeText(text).then(() => {
                const icon = btn.querySelector('i');
                const original = icon.className;
                icon.className = 'bi bi-check2';
                setTimeout(() => icon.className = original, 1200);
            });
        });

        // Accordion toggle functionality
        document.querySelectorAll('.accordion-routes .accordion-button').forEach(button => {
            button.addEventListener('click', function(e) {
                if (e.target.closest('.btn-copy')) return;
                
                const collapseElement = document.querySelector(this.getAttribute('data-bs-target'));
                if (!collapseElement) return;
                
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                // Close all other accordions in the same parent
                const parent = this.closest('.accordion');
                parent.querySelectorAll('.accordion-button').forEach(btn => {
                    if (btn !== this) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                        document.querySelector(btn.getAttribute('data-bs-target')).classList.remove('show');
                    }
                });
                
                // Toggle current accordion
                if (isExpanded) {
                    this.classList.add('collapsed');
                    this.setAttribute('aria-expanded', 'false');
                    collapseElement.classList.remove('show');
                } else {
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                    collapseElement.classList.add('show');
                }
            });
        });
    </script>
@endsection
