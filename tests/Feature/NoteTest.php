<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_una_nota_valida()
    {
        $payload = [
            'title' => 'Mi nota de prueba',
            'content' => 'Este es el contenido de la nota.'
        ];

        $response = $this->postJson('/api/notes', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => 'Mi nota de prueba',
                     'content' => 'Este es el contenido de la nota.'
                 ]);

        $this->assertDatabaseHas('note', $payload);
    }

    /** @test */
    public function no_puede_crear_nota_sin_titulo()
    {
        $payload = [
            'content' => 'Falta el título aquí.'
        ];

        $response = $this->postJson('/api/notes', $payload);

        $response->assertStatus(400)
                 ->assertJsonValidationErrors(['title']);
    }
}
