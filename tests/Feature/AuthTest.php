<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_rejeita_login_com_credenciais_invalidas()
    {
        $user = User::factory()->create([
            'email' => 'teste@api.com',
            'password' => bcrypt('senha123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@api.com',
            'password' => 'senha_errada',
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Credenciais inválidas']);
    }

    public function test_realiza_login_e_retorna_token_sanctum()
    {
        
        $user = User::factory()->create([
            'email' => 'teste@api.com',
            'password' => bcrypt('senha123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'teste@api.com',
            'password' => 'senha123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);

    }

    public function test_bloqueia_acesso_a_rota_protegida_sem_token()
    {

        $response = $this->getJson('/api/user');

        $response->assertStatus(401);

    }
}
