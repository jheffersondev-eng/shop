<?php

namespace Tests\Unit\Repositories\Unit;

use App\Http\Dto\Unit\UnitDto;
use App\Models\Unit;
use App\Models\User;
use App\Repositories\Unit\UnitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreatesTestData;

class UnitRepositoryTest extends TestCase
{
    use RefreshDatabase, CreatesTestData;

    private UnitRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUser();
        $this->repository = new UnitRepository();
    }

    /** @test */
    public function it_can_create_a_unit(): void
    {
        $unitDto = new UnitDto(
            name: 'Quilograma',
            abbreviation: 'KG',
            format: 1
        );

        $result = $this->repository->create($unitDto);

        $this->assertNotNull($result);
        $this->assertDatabaseHas('units', [
            'name' => 'Quilograma',
            'abbreviation' => 'KG',
            'format' => 1,
        ]);
    }

    /** @test */
    public function it_can_retrieve_a_unit_by_id(): void
    {
        $unit = $this->createTestUnit([
            'name' => 'Metro',
            'abbreviation' => 'M',
            'format' => 1,
        ]);

        $found = $this->repository->getUnitById($unit->id);

        $this->assertEquals($found->id, $unit->id);
        $this->assertEquals($found->name, 'Metro');
        $this->assertEquals($found->abbreviation, 'M');
    }

    /** @test */
    public function it_can_update_a_unit(): void
    {
        $unit = $this->createTestUnit([
            'name' => 'Litro',
            'abbreviation' => 'L',
        ]);

        $unitDto = new UnitDto(
            name: 'Litros',
            abbreviation: 'LT',
            format: 2
        );

        $this->repository->update($unitDto, $unit->id);

        $updated = Unit::find($unit->id);
        $this->assertEquals($updated->name, 'Litros');
        $this->assertEquals($updated->abbreviation, 'LT');
    }

    /** @test */
    public function it_can_delete_a_unit(): void
    {
        $unit = $this->createTestUnit();
        $unitId = $unit->id;

        $this->repository->delete($unitId);

        $this->assertSoftDeleted('units', ['id' => $unitId]);
    }

    /** @test */
    public function it_can_list_units_for_logged_user(): void
    {
        $this->createTestUnits(5);

        $units = $this->repository->getUnits();

        $this->assertCount(5, $units->items());
    }

    /** @test */
    public function it_returns_only_units_created_by_logged_user(): void
    {
        // Cria unidades para o usuário logado
        $this->createTestUnits(3);

        // Cria outro usuário
        $otherUser = User::factory()->create(['owner_id' => 1]);

        // Cria unidades para o outro usuário
        Unit::factory(2)->create(['user_id_created' => $otherUser->id, 'owner_id' => 1]);

        // Busca unidades do usuário logado
        $units = $this->repository->getUnits();

        $this->assertCount(3, $units->items());
    }
}
