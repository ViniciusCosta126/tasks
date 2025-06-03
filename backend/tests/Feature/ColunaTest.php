<?php

namespace Tests\Feature;

use App\Http\Resources\ColunaResource;
use App\Models\Board;
use App\Models\Coluna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColunaTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_list_all_columns()
    {
        $coluns = Coluna::factory()->count(3)->create();
        $response = $this->getJson('/api/colunas');

        $expectedData = (ColunaResource::collection($coluns))->response()->getData(true)['data'];

        $response->assertStatus(200)->assertJson(["data" => $expectedData]);
    }

    public function test_can_create_column()
    {
        $board = Board::factory()->create();
        $payload = [
            "titulo" => "Teste de coluna",
            "board_id" => $board->id,
        ];
        $response = $this->postJson('/api/colunas/', $payload);
        $column = Coluna::first();
        $expectedData = (new ColunaResource($column))->response()->getData(true)['data'];
        $response->assertStatus(201)->assertJson(["data" => $expectedData]);
        $this->assertDatabaseHas('colunas', [
            "titulo" => "Teste de coluna",
            "board_id" => $board->id
        ]);
    }

    public function test_can_show_column()
    {
        $board = Board::factory()->create();
        $payload = [
            "titulo" => "Teste de coluna",
            "board_id" => $board->id
        ];

        $this->postJson('/api/colunas', $payload);

        $coluna = Coluna::first();
        $this->assertEquals($coluna->titulo, $payload['titulo']);
        $this->assertEquals($coluna->board_id, $payload['board_id']);

        $response = $this->getJson("/api/colunas/$coluna->id");
        $expectedData = (new ColunaResource($coluna))->response()->getData(true)['data'];
        $response->assertStatus(200)->assertJson(["data" => $expectedData]);
    }

    public function test_can_delete_column()
    {
        $board = Board::factory()->create();
        $payload = [
            "titulo" => "Teste de coluna",
            "board_id" => $board->id
        ];

        $this->postJson('/api/colunas', $payload);

        $column = Coluna::first();


        $response = $this->delete("/api/colunas/$column->id");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('colunas', [
            "titulo" => "Teste de coluna",
            "board_id" => $board->id
        ]);
    }

    public function test_can_update_board()
    {
        $board = Board::factory()->create();

        $payload = [
            "titulo" => "Nova coluna de teste",
            "board_id" => $board->id,
        ];

        $this->postJson('/api/colunas', $payload);

        $payloadUpdate = [
            "titulo" => "Teste de Update",
            "board_id" => $board->id,
        ];

        $coluna = Coluna::first();

        $response = $this->patchJson("/api/colunas/$coluna->id", $payloadUpdate);
        $response->assertStatus(200)->assertJsonFragment(["message" => "Coluna atualizada com sucesso!"]);
        $coluna->refresh();
        $expectedData = (new ColunaResource($coluna))->response()->getData(true)['data'];
        $response->assertJson(['data' => $expectedData]);
    }
}
