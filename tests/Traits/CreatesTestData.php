<?php

namespace Tests\Traits;

use App\Models\Unit;
use App\Models\User;
use Database\Factories\UnitFactory;
use Illuminate\Support\Facades\Auth;

trait CreatesTestData
{
    /**
     * Cria um usuário de teste autenticado
     */
    protected function createTestUser(): User
    {
        $user = User::factory()->create([
            'owner_id' => 1,
        ]);

        Auth::login($user);

        return $user;
    }

    /**
     * Cria uma unidade de teste
     */
    protected function createTestUnit(array $attributes = []): Unit
    {
        return Unit::factory()->create(array_merge([
            'user_id_created' => Auth::id() ?? 1,
            'owner_id' => 1,
        ], $attributes));
    }

    /**
     * Cria múltiplas unidades de teste
     */
    protected function createTestUnits(int $count = 3, array $attributes = []): \Illuminate\Database\Eloquent\Collection
    {
        return Unit::factory($count)->create(array_merge([
            'user_id_created' => Auth::id() ?? 1,
            'owner_id' => 1,
        ], $attributes));
    }
}
