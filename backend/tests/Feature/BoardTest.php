<?php

namespace Tests\Feature;

use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_boards()
    {
        $user = User::factory()->create();
        $boards = Board::factory()->count(3)->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->getJson('/api/boards');
        $expectedData = (BoardResource::collection($boards))->response()->getData(true)['data'];
        $response->assertStatus(200)->assertJson(["data" => $expectedData]);
    }

    public function test_user_can_create_board()
    {
        $user = User::factory()->create();
        $payload = [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ];

        $response = $this->actingAs($user)->postJson('/api/boards', $payload);

        $response->assertStatus(201)->assertJsonFragment(["message" => "Board criada com sucesso!"]);
        $this->assertDatabaseHas('boards', [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ]);

        $board = Board::first();
        $expectedData = (new BoardResource($board))->response()->getData(true)['data'];

        $response->assertJson([
            "data" => $expectedData
        ]);
    }

    public function test_user_can_show_board()
    {
        $user = User::factory()->create();
        $payload = [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ];

        $this->actingAs($user)->postJson('/api/boards', $payload);
        $board = Board::first();

        $this->assertEquals($board->titulo, $payload['titulo']);
        $this->assertEquals($board->user_id, $payload['user_id']);
        $this->assertEquals($board->ativo, $payload['ativo']);

        $response = $this->actingAs($user)->getJson('/api/boards/' . $board->id);
        $expectedData = (new BoardResource($board))->response()->getData(true)['data'];
        $response->assertStatus(200)->assertJson(['data' => $expectedData]);
    }

    public function test_can_delete_board()
    {
        $user = User::factory()->create();

        $payload = [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ];

        $this->actingAs($user)->postJson('/api/boards', $payload);
        $board = Board::first();

        $response = $this->actingAs($user)->delete('/api/boards/' . $board->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('boards', [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ]);
    }

    public function test_can_update_board()
    {
        $user = User::factory()->create();

        $payload = [
            "titulo" => "Nova board de teste",
            "user_id" => $user->id,
            "ativo" => true
        ];

        $this->actingAs($user)->postJson('/api/boards', $payload);

        $payloadUpdate = [
            "titulo" => "Teste de Update",
            "user_id" => $user->id,
            "ativo" => false
        ];

        $board = Board::first();

        $response = $this->actingAs($user)->patchJson("/api/boards/$board->id", $payloadUpdate);
        $response->assertStatus(200)->assertJsonFragment(["message" => "Board atualizada com sucesso!"]);
        $board->refresh();
        $expectedData = (new BoardResource($board))->response()->getData(true)['data'];
        $response->assertJson(['data' => $expectedData]);

    }
}
