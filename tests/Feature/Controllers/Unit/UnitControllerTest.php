<?php

namespace Tests\Feature\Controllers\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreatesTestData;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase, CreatesTestData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUser();
    }

    /** @test */
    public function it_can_create_a_new_unit(): void
    {
        $data = [
            'name' => 'Quilograma',
            'abbreviation' => 'KG',
            'format' => 1,
        ];

        $response = $this->post(route('unit.store'), $data);

        $response->assertRedirect(route('unit.index'));
        $this->assertDatabaseHas('units', $data);
    }

    /** @test */
    public function it_validates_required_fields_on_create(): void
    {
        $response = $this->post(route('unit.store'), []);

        $response->assertSessionHasErrors(['name', 'abbreviation', 'format']);
    }

    /** @test */
    public function it_can_update_a_unit(): void
    {
        $unit = $this->createTestUnit([
            'name' => 'Litro',
            'abbreviation' => 'L',
        ]);

        $data = [
            'name' => 'Litros',
            'abbreviation' => 'LT',
            'format' => 2,
        ];

        $response = $this->put(route('unit.update', $unit->id), $data);

        $response->assertRedirect(route('unit.index'));
        $this->assertDatabaseHas('units', array_merge(['id' => $unit->id], $data));
    }

    /** @test */
    public function it_can_delete_a_unit(): void
    {
        $unit = $this->createTestUnit();

        $response = $this->delete(route('unit.destroy', $unit->id));

        $response->assertRedirect(route('unit.index'));
        $this->assertSoftDeleted('units', ['id' => $unit->id]);
    }

    /** @test */
    public function it_requires_authentication_to_access_units(): void
    {
        // Logout para testar sem autenticação
        auth()->logout();

        $response = $this->get(route('unit.index'));

        $response->assertRedirect(route('login'));
    }
}
