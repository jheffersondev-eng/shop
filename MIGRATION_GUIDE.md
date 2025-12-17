# 📘 Guia de Migração - Nova Arquitetura Laravel Clean

## 🎯 Objetivo

Migrar da arquitetura antiga (BaseController + MediatorService) para o padrão Laravel limpo e desacoplado.

---

## ❌ Arquitetura ANTIGA (problema)

```
Controller → BaseController (métodos mágicos) → MediatorService → Service específico → Repository
```

**Problemas identificados:**

1. ❌ **BaseController muito inteligente** - fazendo trabalho que deveria ser do controller específico
2. ❌ **MediatorService desnecessário** - adiciona camada de complexidade sem benefício real
3. ❌ **Acoplamento reverso** - dificulta manutenção e testes
4. ❌ **Falta de clareza** - código "mágico" que esconde o que realmente acontece
5. ❌ **Rigidez** - força todos os módulos a seguirem o mesmo fluxo

---

## ✅ Arquitetura NOVA (solução)

```
Controller → Service → Repository
```

**Benefícios:**

1. ✅ **Padrão Laravel standard** - qualquer dev Laravel entende imediatamente
2. ✅ **Desacoplado** - cada controller tem controle total do seu fluxo
3. ✅ **Flexível** - módulos diferentes podem ter fluxos diferentes
4. ✅ **Testável** - serviços isolados são fáceis de testar
5. ✅ **Legível** - código explícito, sem "mágica"

---

## 🔄 Como Migrar seus Controllers

### ANTES (antiga estrutura)

```php
class UserController extends BaseController
{
    public function __construct(IUserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->setPages(10);
        $this->setName('Usuário');
        $this->setUrl(url("user"));
        $this->setFolderView("user");
    }

    public function Store(CreateUserRequest $request): RedirectResponse
    {
        return parent::StoreBase($request); // ❌ Método "mágico"
    }
}
```

### DEPOIS (nova estrutura)

```php
use App\Services\User\UserService;

class UserController extends Controller
{
    protected UserService $userService;
    protected IUserRepository $userRepository;

    public function __construct(
        UserService $userService,
        IUserRepository $userRepository
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function Store(CreateUserRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Validação e criação de DTOs
            $hashedPassword = $this->userService->validateAndHashPassword(
                $request->input('password'),
                $request->input('password_confirmation')
            );

            $userDto = new CreateUserDto(
                $request->input('email'),
                $hashedPassword
            );
            $userDto->setUserIdCreate(Auth::id());

            $userDetailDto = new UserDetailsDto(
                $request->input('name'),
                $request->input('document'),
                $request->input('phone'),
                $request->input('birth_date'),
                $request->input('address')
            );

            // Chama service diretamente ✅
            $this->userService->create($userDto, $userDetailDto);

            DB::commit();

            return redirect()
                ->route('user.index')
                ->with('message', 'Usuário cadastrado com sucesso');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro: ' . $e->getMessage());
        }
    }
}
```

---

## 📦 Estrutura dos Services

### Service consolidado (novo padrão)

```php
namespace App\Services\User;

class UserService
{
    protected IUserRepository $userRepository;
    protected IUserDetailRepository $userDetailRepository;

    public function __construct(
        IUserRepository $userRepository,
        IUserDetailRepository $userDetailRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    /**
     * Cria usuário com detalhes
     * - Regras de negócio
     * - Orquestração entre repositories
     */
    public function create(CreateUserDto $userDto, UserDetailsDto $userDetailDto): User
    {
        // Cria usuário
        $user = $this->userRepository->store($userDto);

        // Associa detalhes
        $userDetailDto->setUserId($user->id);
        $this->userDetailRepository->store($userDetailDto);

        return $user;
    }

    public function update(UpdateUserDto $userDto, UserDetailsDto $userDetailDto): bool
    {
        $this->userRepository->update($userDto);
        $userDetailDto->setUserId($userDto->getId());
        $this->userDetailRepository->update($userDetailDto);
        return true;
    }

    public function delete(User $user): bool
    {
        return $this->userRepository->delete($user);
    }

    // Helpers específicos
    public function validateAndHashPassword(?string $password, ?string $confirmation): ?string
    {
        if (empty($password) && empty($confirmation)) {
            return null;
        }

        if ($password !== $confirmation) {
            throw new \Exception('Senhas não conferem');
        }

        return Hash::make($password);
    }
}
```

---

## 🗑️ O que foi REMOVIDO/DEPRECATED

### 1. MediatorService
**Status:** `@deprecated` - Marcado como obsoleto

**Motivo:** Adiciona complexidade sem benefício. Controllers devem chamar services diretamente.

**Como migrar:**
```php
// ❌ ANTES
$result = $this->getMediator()->handle($request);

// ✅ DEPOIS
$user = $this->userService->create($dto);
```

---

### 2. Métodos "Base" do BaseController
**Status:** REMOVIDOS

**Métodos removidos:**
- `IndexBase()`
- `CreateBase()`
- `StoreBase()`
- `EditBase()`
- `UpdateBase()`
- `DestroyBase()`

**Motivo:** Forçam todos os controllers a seguirem o mesmo fluxo, impedindo flexibilidade.

**Como migrar:** Implemente diretamente no seu controller específico.

---

### 3. BaseController como "cérebro"
**Status:** Simplificado para apenas helpers

**O que sobrou (opcional):**
```php
// Helpers úteis (uso opcional)
protected function executeInTransaction(callable $callback, string $errorContext)
protected function successResponse(string $message, string $route = null)
protected function errorResponse(string $message, array $input = [])
protected function logCriticalError(\Exception $e, array $extraContext = [])
```

---

## 🎯 Checklist de Migração

Para cada controller antigo:

- [ ] Remover extends `BaseController`
- [ ] Adicionar extends `Controller`
- [ ] Injetar `Service` específico no `__construct`
- [ ] Remover chamadas a métodos `Base` (StoreBase, UpdateBase, etc)
- [ ] Implementar métodos diretamente com chamada ao service
- [ ] Remover `setPages()`, `setName()`, `setUrl()`, etc
- [ ] Adicionar tratamento de transação e erro localmente
- [ ] Testar funcionalidade

---

## 📂 Módulos já migrados (exemplos)

✅ **UserController** - Migrado completamente  
✅ **ProductController** - Migrado completamente

Use esses como referência para migrar outros controllers.

---

## 🚀 Próximos passos

1. **Migrar controllers restantes** um por vez:
   - CategoryController
   - UnitController
   - ProfileController
   - LoginController
   - RegisterController
   - DashboardController

2. **Criar services consolidados** quando necessário:
   - CategoryService
   - UnitService
   - ProfileService
   - AuthService (para Login/Register)

3. **Remover completamente** (após todos migrarem):
   - MediatorService
   - Services fragmentados antigos (*RequestService)

4. **Testes**: Adicionar testes unitários para os services

---

## 💡 Boas práticas

### ✅ Controller limpo

```php
public function store(ProductRequest $request): RedirectResponse
{
    $dto = ProductDTO::fromRequest($request);
    $image = $request->file('image');
    
    $product = $this->productService->create($dto, $image);
    
    return redirect()
        ->route('product.index')
        ->with('success', 'Produto criado');
}
```

**Características:**
- Recebe request tipado
- Cria DTO
- Chama service
- Retorna resposta
- Simples, direto, legível

---

### ✅ Service focado

```php
class ProductService
{
    public function create(ProductDTO $dto, ?UploadedFile $image): Product
    {
        // Regras de negócio
        $this->validatePrice($dto);
        
        // Upload se necessário
        if ($image) {
            $dto->image = $this->uploadImage($image);
        }
        
        // Chama repository
        return $this->productRepository->create($dto);
    }
}
```

**Características:**
- Regras de negócio isoladas
- Orquestra operações
- Não conhece Request ou Response
- Testável

---

### ✅ Repository minimalista

```php
class ProductRepository
{
    public function create(ProductDTO $dto): Product
    {
        return Product::create($dto->toArray());
    }
}
```

**Características:**
- Só banco
- Nada além disso

---

## 🆘 Precisa de ajuda?

Se tiver dúvida ao migrar algum controller específico, consulte:

1. **UserController** - Exemplo completo de CRUD com relacionamento
2. **ProductController** - Exemplo com upload de arquivo
3. Este guia

---

**Última atualização:** Dezembro 2025  
**Branch:** `hotfix/04-standardize-base-and-back-end-classes`
