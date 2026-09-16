<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;

use Tests\TestCase;

class AdminRouteTest extends TestCase
{

    public function test_bloqueia_acesso_sem_token_e_registra_log()
    {

        Log::shouldReceive('warning')
            ->once()
            ->with('Tentativa de invasão detectada (Admin)', \Mockery::type('array'));

        $response = $this->getJson('/api/admin/settings');

        $response->assertStatus(401);


    }
}
