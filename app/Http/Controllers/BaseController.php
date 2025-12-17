<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Throwable;
use Exception;

/**
 * BaseController - Classe auxiliar OPCIONAL
 * 
 * ⚠️ IMPORTANTE: Esta classe deve conter APENAS métodos auxiliares/helpers.
 * NÃO use para criar fluxos complexos ou lógica de negócio.
 * 
 * ✅ BOM USO:
 * - Helpers para respostas padronizadas
 * - Wrappers para transações simples
 * - Métodos utilitários compartilhados
 * 
 * ❌ MAU USO:
 * - Métodos "mágicos" que escondem complexidade (StoreBase, UpdateBase, etc)
 * - Integração com Mediator ou Service dentro do controller base
 * - Forçar todos os controllers a seguirem o mesmo fluxo
 * 
 * 📌 PADRÃO RECOMENDADO:
 * Controller → Service → Repository
 */
abstract class BaseController extends Controller
{
    protected function RedirectResult(callable $callback, string $context = 'operação')
    {
        try {
            DB::beginTransaction();
            
            $result = $callback();
            
            DB::commit();
            return $result;
            
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::critical($e->getMessage(), [
                'url' => url()->current(),
                'method' => request()->method(),
                'params' => request()->all(),
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Erro ao executar {$context}: {$e->getMessage()}");
        }
    }

    protected function execute(
        callable $callback,
        string $defaultSuccessMessage = 'Operação realizada com sucesso',
        ?string $successRedirect = null,
        ?string $errorRedirect = null
    ): RedirectResponse 
    {
        try {
            DB::beginTransaction();

            /** @var ServiceResult $result */
            $result = $callback();

            if (!$result->success) {
                DB::rollBack();

                return redirect()
                    ->to($errorRedirect ?? url()->previous())
                    ->withInput()
                    ->with('error', $result->message);
            }

            DB::commit();

            return redirect()
                ->to($successRedirect ?? url()->previous())
                ->with('success', $result->message ?? $defaultSuccessMessage);

        } catch (Throwable $e) {

            DB::rollBack();
            Log::critical($e->getMessage());

            return redirect()
                ->to($errorRedirect ?? url()->previous())
                ->withInput()
                ->with('error', 'Erro interno: '.$e->getMessage());
        }
    }
}