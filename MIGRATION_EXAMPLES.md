# 📖 Exemplos de Migração - Controllers Restantes

Este documento mostra exemplos práticos de como migrar cada um dos controllers restantes.

---

## 1️⃣ CategoryController

### Service a criar: `CategoryService.php`

```php
<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\ICategoryRepository;

class CategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $data): Category
    {
        return $this->categoryRepository->store($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    public function getAll()
    {
        return $this->categoryRepository->getCategories();
    }
}
```

### Controller refatorado:

```php
<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function Index(Request $request): View
    {
        $categories = Category::query()
            ->orderBy('id', 'asc')
            ->paginate(10);
        $categories->appends($request->except('page'));

        return view('category.index', [
            'url' => url('category'),
            'title' => 'Categorias',
            'categories' => $categories,
        ]);
    }

    public function Create(): View
    {
        return view('category.create', [
            'url' => url('category'),
        ]);
    }

    public function Store(CategoryRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['user_id_create'] = Auth::id();

            $this->categoryService->create($data);

            DB::commit();

            return redirect()
                ->route('category.index')
                ->with('message', 'Categoria cadastrada com sucesso');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar categoria: ' . $e->getMessage());
        }
    }

    public function Edit(Category $category): View
    {
        return view('category.edit', [
            'url' => url('category'),
            'category' => $category,
        ]);
    }

    public function Update(CategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['user_id_update'] = Auth::id();

            $this->categoryService->update($category->id, $data);

            DB::commit();

            return redirect()
                ->back()
                ->with('message', 'Categoria atualizada');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar categoria: ' . $e->getMessage());
        }
    }

    public function Destroy(Request $request, Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $this->categoryService->delete($category);

            DB::commit();

            return redirect()
                ->back()
                ->with('message', 'Categoria removida');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Erro ao remover categoria: ' . $e->getMessage());
        }
    }
}
```

---

## 2️⃣ UnitController

### Service a criar: `UnitService.php`

```php
<?php

namespace App\Services\Unit;

use App\Models\Unit;
use App\Repositories\Unit\IUnitRepository;

class UnitService
{
    protected IUnitRepository $unitRepository;

    public function __construct(IUnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function create(array $data): Unit
    {
        return $this->unitRepository->store($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->unitRepository->update($id, $data);
    }

    public function delete(Unit $unit): bool
    {
        return $unit->delete();
    }

    public function getAll()
    {
        return $this->unitRepository->getUnits();
    }
}
```

### Controller (similar ao CategoryController)

```php
class UnitController extends Controller
{
    protected UnitService $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    // Métodos Index, Create, Store, Edit, Update, Destroy
    // (seguir mesmo padrão do CategoryController)
}
```

---

## 3️⃣ ProfileController

### Service a criar: `ProfileService.php`

```php
<?php

namespace App\Services\Profile;

use App\Models\Profile;
use App\Repositories\Profile\IProfileRepository;

class ProfileService
{
    protected IProfileRepository $profileRepository;

    public function __construct(IProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function create(array $data): Profile
    {
        return $this->profileRepository->store($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->profileRepository->update($id, $data);
    }

    public function delete(Profile $profile): bool
    {
        return $profile->delete();
    }

    public function getAll()
    {
        return $this->profileRepository->getAll();
    }

    /**
     * Sincroniza permissões de um perfil
     */
    public function syncPermissions(Profile $profile, array $permissionIds): void
    {
        $profile->permissions()->sync($permissionIds);
    }
}
```

---

## 4️⃣ LoginController

### Service a criar: `AuthService.php`

```php
<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Tenta fazer login
     */
    public function attemptLogin(string $email, string $password): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
    }

    /**
     * Faz logout
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Verifica se usuário existe e senha está correta
     */
    public function validateCredentials(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }
}
```

### Controller refatorado:

```php
<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\UserLoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function Index(): View
    {
        return view('login.index');
    }

    public function Login(UserLoginRequest $request): RedirectResponse
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');

            if ($this->authService->attemptLogin($email, $password)) {
                $request->session()->regenerate();

                return redirect()
                    ->intended('/dashboard')
                    ->with('message', 'Login realizado com sucesso');
            }

            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with('error', 'Credenciais inválidas');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with('error', 'Erro ao fazer login: ' . $e->getMessage());
        }
    }

    public function Logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('message', 'Logout realizado com sucesso');
    }
}
```

---

## 5️⃣ RegisterController

### Usa o mesmo `AuthService` + `UserService`

```php
<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Services\User\UserService;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisterController extends Controller
{
    protected UserService $userService;
    protected AuthService $authService;

    public function __construct(
        UserService $userService,
        AuthService $authService
    ) {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function Index(): View
    {
        return view('register.index');
    }

    public function Register(UserRegisterRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Valida e faz hash da senha
            $hashedPassword = $this->userService->validateAndHashPassword(
                $request->input('password'),
                $request->input('password_confirmation')
            );

            // Cria DTOs
            $userDto = new CreateUserDto(
                $request->input('email'),
                $hashedPassword
            );

            $userDetailDto = new UserDetailsDto(
                $request->input('name'),
                $request->input('document'),
                $request->input('phone'),
                $request->input('birth_date'),
                $request->input('address')
            );

            // Cria usuário
            $user = $this->userService->create($userDto, $userDetailDto);

            // Faz login automático
            $this->authService->attemptLogin(
                $request->input('email'),
                $request->input('password')
            );

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('message', 'Registro realizado com sucesso');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Erro ao registrar: ' . $e->getMessage());
        }
    }
}
```

---

## 6️⃣ DashboardController

Este é mais simples, geralmente só exibe dados:

```php
<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function Index(): View
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('dashboard.index', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
        ]);
    }
}
```

**Observação:** Dashboard geralmente não precisa de Service, a menos que tenha lógica de negócio complexa.

---

## 🎯 Checklist para cada migração

Para cada controller que você for migrar:

- [ ] Criar Service (se necessário)
- [ ] Remover `extends BaseController`
- [ ] Adicionar `extends Controller`
- [ ] Injetar Service no `__construct`
- [ ] Remover chamadas a métodos `Base`
- [ ] Implementar métodos diretamente
- [ ] Adicionar tratamento de transação
- [ ] Adicionar tratamento de erros
- [ ] Testar funcionalidade
- [ ] Commit das mudanças

---

## 💡 Dicas importantes

### Quando criar Service?

✅ **CRIE Service quando:**
- Houver regras de negócio
- Precisar orquestrar múltiplos repositories
- Houver validações complexas
- O controller ficaria muito grande

❌ **NÃO CRIE Service quando:**
- Controller só lista dados (ex: Dashboard)
- Operação é trivial (1 linha)
- Não há lógica de negócio

### Exemplo: Controller sem Service

```php
public function Index(): View
{
    $categories = Category::all();
    return view('category.index', compact('categories'));
}
```

Se é só isso, não precisa de Service.

---

## 📚 Ordem recomendada de migração

1. ✅ **UserController** (já feito) ← mais complexo
2. ✅ **ProductController** (já feito) ← upload de arquivo
3. **CategoryController** ← simples, bom pra praticar
4. **UnitController** ← similar ao Category
5. **ProfileController** ← tem relacionamentos
6. **LoginController** ← autenticação
7. **RegisterController** ← usa User + Auth
8. **DashboardController** ← mais simples

---

**Boa sorte com as migrações! 🚀**
