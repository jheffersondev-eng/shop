<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Login\UserRegisterRequest;
use App\Services\User\IUserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterController extends BaseController
{
    protected IUserService $userService;

    public function __construct(
        IUserService $userService
    ) 
    {
        $this->userService = $userService;
    }

    public function SignUp(): View
    {
        return view('register.create', [
            'url' => route('register.create'),
            'title' => 'Cadastre-se',
        ]);
    }

    public function Register(UserRegisterRequest $userRegisterRequest): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $dto = $userRegisterRequest->getDto();
            $result = $this->userService->create($dto);

            DB::commit();

            $user = $result->data;
 
            return redirect()->route('register.verify-email-view', ['user_id' => $user->id, 'email' => $user->email]);
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao criar usuário: ' . $e->getMessage());
        }
    }

    public function verifyEmailView(Request $request): View
    {
        return view('register.verify-email', [
            'userId' => $request->user_id,
            'email' => $request->email,
        ]);
    }

    public function verifyEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'verification_code' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        // Verificar se o código existe
        if (!$user || $user->verification_code !== $request->verification_code) {
            return redirect()->back()->with('error', 'Código de verificação inválido');
        }

        // Verificar se o código expirou
        if ($user->verification_expires_at < now()) {
            return redirect()->back()->with('error', 'Código de verificação expirado');
        }

        // Atualizar o email como verificado
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_expires_at' => null,
        ]);

        return redirect()->to(route('user.index'))->with('success', 'Email verificado com sucesso!');
    }
}