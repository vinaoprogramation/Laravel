<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class StoreProductTest extends TestCase
{

    use RefreshDatabase;
    public function test_rejeita_dados_ausentes_ou_invalidos()
    {
        $response = $this->postJson('/api/products', [
            'name'=> '',
            'sku'=> 'sku invalido com espaco',
            'price' => -10
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'sku', 'price']);

    }       

    public function test_higieniza_e_aceita_dados_validos()
    {
        $response = $this->postJson('/api/products', [
            'name' => '<h1>Teclado Gamer</h1>',
            'sku' => 'kb-123 ',
            'price' => 250.00,
        ]);

        $response->assertStatus(201);
            
        $this->assertDatabaseHas('products', [
            'name' => 'Teclado Gamer',
            'sku' => 'KB-123',
            'price' => 250.00,
        ]);
    }


}
