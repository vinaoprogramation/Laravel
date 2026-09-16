<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiHealthCheckTest extends TestCase
{

    public function test_api_deve_retornar_status_ok(){
        $response = $this->getJson('api/health');

        $response->assertStatus(200);

        $response->assertJson([
            'status'=>'online',
        ]);
    }

    public function test_rate_limiting_bloqueia_excesso_de_requisicoes()
    {

        for ($i = 0; $i < 10; $i++){
            $this->getJson('/api/health')->assertStatus(200);
        }

        $response = $this->getJson('/api/health');

        $response->assertStatus(429);

    }
}
