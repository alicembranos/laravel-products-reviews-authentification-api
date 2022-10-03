<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\Sanctum;

class ProductsApiTest extends TestCase
{

    public function test_endpoint_exists()
    {
        Sanctum::actingAs(User::factory()->create());
        $reponse = $this->get('/api/products');
        $reponse->assertStatus(200);
    }

    public function test_response_structure_contains_products()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get('/api/products');
        $response->assertJson([
            'products' => []
        ]);
    }

    public function test_returns_all_products()
    {
        Sanctum::actingAs(User::factory()->create());
        Product::factory(13)->create();
        $response = $this->get('/api/products');
        $response->assertJsonCount(13, 'products');
        $response->assertStatus(200);
    }
}
